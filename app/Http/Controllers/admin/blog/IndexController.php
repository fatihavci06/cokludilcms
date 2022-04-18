<?php

namespace App\Http\Controllers\admin\blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Language;
use App\Models\blog;
use App\Models\blogCategory;
use App\Models\blogandCategory;
use Illuminate\Support\Facades\Storage;
use DataTables;
 use Illuminate\Support\Str;
class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        if ($request->ajax()) {
            $data = blog::with('language_name')->with('categories.category_name')->get();
            return Datatables::of($data) 
                    ->addIndexColumn()
                    ->addColumn('edit', function($data){ // harici bir column dönderdik
                        $btn = '<a href="'.route('blog.edit',$data->id).'" class="edit btn btn-primary btn-sm">Edit</a>';
    
                          
                        return $btn;
                    })
                    ->addColumn('delete', function($data){ // harici bir column dönderdik
                        $btn = '<a  onclick="silmedenSor('."'".route('blog.delete',$data->id)."'".');return false" class="edit btn btn-danger btn-sm">Sil</a>'; 
                        return $btn;
                    })
                    ->addColumn('language_name', function($data){ // harici bir column dönderdik
                        $btn = $data->language_name->name;
    
                          
                        return $btn;
                    })
                    ->addColumn('image', function($data){ // harici bir column dönderdik
                        $btn = '<img src="'.Storage::url($data->image) .'" height="30px" width="30px" />';
    
                          
                        return $btn;
                    })
                    ->addColumn('isAktive', function($data){ // harici bir column dönderdik
                        if($data->isAktive==1){
                             $btn='Aktif';
                        }
                        else{
                            $btn='Pasif';
                        }
    
                          
                        return $btn;
                    })
                    ->addColumn('category', function($data){ // harici bir column dönderdik
                           $kategoriler=[];
                             
                                foreach($data->categories as $c){
                                    array_push($kategoriler,$c->category_name->name);
                                }
                                
                            
    
                          
                        return  $kategoriler;
                    })
                    ->rawColumns(['edit','delete','language_name','image','isAktive','category'])//action sutunu viewe gönderdik
                    ->make(true);
        }
        return view('admin.blog.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $language=Language::all();
        $category=blogCategory::all();
        return view('admin.blog.create',['language'=>$language,'category'=>$category]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function kategoricek(Request $request){
        $category=blogCategory::where('language_id',$request->id)->get();
        
         $array=[];
        foreach($category as $c){
                $option='<option value="'.$c->id.'">'.$c->name.'</option>';
                array_push($array,$option);
        }
        return response()->json($array);
    } 
    public function kategoricekupdate(Request $request){
        $category=blogCategory::where('language_id',$request->id)->get();
        $blogaitkategoriler=blogandCategory::where('blog_id',$request->blog_id)->get();
        $blogarray=[];
        $array=[];
         foreach($blogaitkategoriler as $b){
             
               array_push($blogarray,$b->category_id);
         }
         
        foreach($category as $c){
            if (in_array($c->id,$blogarray)){
                $option='<option selected value="'.$c->id.'">'.$c->name.'</option>';
                
            }else{
                $option='<option  value="'.$c->id.'">'.$c->name.'</option>';
                
            }
            
                array_push($array,$option);
        }
        return response()->json($array);
    }
    public function store(Request $request)
    {
        //
        
        
   
          $request->validate([
            'title'=>'required',
            'language_id'=>'required',
            'editor1'=>'required',
             'image' => 'required',
             'isAktive'=>'required',
             'description'=>'required',
             'category'=>'required',
             'date'=>'required',
             'keywords'=>'required'

             
           ]);

          $blog=new blog;
          $blog->title=$request->title;
          $blog->language_id=$request->language_id;
          $blog->content=$request->editor1;
          $blog->isAktive=$request->isAktive;
          $blog->description=$request->description;
          $blog->date=$request->date;
          $blog->slug=Str::slug($request->title);
          $blog->keywords=$request->keywords;
             if(!empty($request->file('image'))){
                $blog->image=Storage::putFile('images', $request->file('image'));  //storage burda
                
            }
        $blog->save();
        $blogid=$blog->id;
        
        foreach($request->category as $c){
            $blogCategory=new blogandCategory;
            $blogCategory->category_id=$c;
            $blogCategory->blog_id=$blogid;
            $blogCategory->save();
        }
        
        return redirect()->back()->with('status','Kayıt başarılı');






    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $language=Language::all();
        $data = blog::where('id',$id)->with('language_name')->with('categories.category_name')->first();
        $category=blogCategory::where('language_id',$data->language_id)->get();
        //return $data;
        return view('admin.blog.edit',['language'=>$language,'data'=>$data,'category'=>$category]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'=>'required',
            'language_id'=>'required',
            'editor1'=>'required',
             'isAktive'=>'required',
             'description'=>'required',
             'category'=>'required',
             'date'=>'required',
             'keywords'=>'required'

             
           ]);

          $blog=blog::findOrFail($id);
          $blog->title=$request->title;
          $blog->language_id=$request->language_id;
          $blog->content=$request->editor1;
          $blog->isAktive=$request->isAktive;
          $blog->description=$request->description;
          $blog->date=$request->date;
          $blog->slug=Str::slug($request->title);
          $blog->keywords=$request->keywords;
             if(!empty($request->file('image'))){
                Storage::delete($blog->image);
                $blog->image=Storage::putFile('images', $request->file('image'));  //storage burda
                
            }
        $blog->save();
        
        $categorysil=blogandCategory::where('blog_id',$id)->get();
        foreach($categorysil as $s){
            $s->delete();
        }
        foreach($request->category as $c){
            $blogCategory=new blogandCategory;
            $blogCategory->category_id=$c;
            $blogCategory->blog_id=$id;
            $blogCategory->save();
        }
        return redirect()->back()->with('status','Güncelleme Başarılı');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $data=blog::findOrFail($id);
        $data->delete();
        return redirect()->back()->with('status','silindi');
    }
    public function data($id=8){
         $data = $blogaitkategoriler=blogandCategory::where('blog_id',$id)->get();
         $array=[];

         foreach($data as $d){
             
               array_push($array,$d->blog_id);
         }
         return response()->json($array);
    }
}
