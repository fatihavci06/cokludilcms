<?php

namespace App\Http\Controllers\admin\page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Language;
 use Illuminate\Support\Str;
 use Illuminate\Support\Facades\Storage;
 use DataTables;
 use DB;
class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data=Page::with('language_name')->orderBy('order_number', 'ASC')->get();
        
        return view('admin.page.index',['data'=>$data]);
        if ($request->ajax()) {
            $data = Page::with('language_name')->get();
            return Datatables::of($data) 
                    ->addIndexColumn()
                    ->addColumn('edit', function($data){ // harici bir column dönderdik
                        $btn = '<a href="'.route('page.edit',$data->id).'" class="edit btn btn-primary btn-sm">Edit</a>';
    
                          
                        return $btn;
                    })
                    ->addColumn('delete', function($data){ // harici bir column dönderdik
                        $btn = '<a  onclick="silmedenSor('."'".route('page.delete',$data->id)."'".');return false" class="edit btn btn-danger btn-sm">Sil</a>'; 
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
                   
                    ->rawColumns(['edit','delete','language_name','image','isAktive'])//action sutunu viewe gönderdik
                    ->make(true);
        }
        return view('admin.page.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $language=Language::all();
        return view('admin.page.create',['language'=>$language]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'language_id'=>'required',
            'editor1'=>'required',
             'image' => 'required',
             'isAktive'=>'required',
             'description'=>'required',
             'name'=>'required',
             'keywords'=>'required',

             
           ]);
        $page=new Page;
        $page->language_id=$request->language_id;
        $page->name=$request->name;
        $page->title=$request->title;
        $page->isAktive=$request->isAktive;
        $page->order_number=$request->order_number;
        $page->slug=Str::slug($request->title);
        $page->description=$request->description;
        $page->content=$request->editor1;
        $page->keywords=$request->keywords;
        if(!empty($request->file('image'))){
                $page->image=Storage::putFile('images', $request->file('image'));  //storage burda
                
            }
        $page->save();

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
        $data=Page::with('language_name')->where('id',$id)->first();
        return view('admin.page.edit',['language'=>$language,'data'=>$data]);
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
        //
        $request->validate([
            'title'=>'required',
            'language_id'=>'required',
            'editor1'=>'required',
             'isAktive'=>'required',
             'description'=>'required',
             'name'=>'required',
             'keywords'=>'required',

             
           ]);
        $page=Page::findOrfail($id);
        $page->language_id=$request->language_id;
        $page->name=$request->name;
        $page->title=$request->title;
        $page->isAktive=$request->isAktive;
        $page->order_number=$request->order_number;
        $page->slug=Str::slug($request->title);
        $page->description=$request->description;
        $page->content=$request->editor1;
        $page->keywords=$request->keywords;
        if(!empty($request->file('image'))){
                Storage::delete($page->image);
                $page->image=Storage::putFile('images', $request->file('image'));  //storage burda
                
            }
        $page->save();

        return redirect()->back()->with('status','Kayıt başarılı');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $data=Page::findOrfail($id);
        $data->delete();
        return redirect()->back();
    }
    public function sortable(Request $request){
        
          
           foreach ($request->get('page') as $key => $value) {
              
              $data=Page::findOrfail($value);
              $data->order_number=$key;
              $data->save();

           }
                    
    }
}
