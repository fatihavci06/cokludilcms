<?php

namespace App\Http\Controllers\admin\slider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Language;
use App\Models\SliderContent;
use App\Models\User;
 use Illuminate\Support\Facades\Storage;
use DataTables;
class IndexController extends Controller
{
    //
    public function index(Request $request){
         $data = SliderContent::with('language_name')->get();

        if ($request->ajax()) {
            $data = SliderContent::with('language_name')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('image', function($data){
     
                           $btn = '<img src="'.Storage::url($data->image) .'" height="30px" width="30px" />';
    
                            return $btn;
                    })
                    ->addColumn('language_name', function($data){
     
                           $btn = $data->language_name->name;
    
                            return $btn;
                    })
                    ->addColumn('edit', function($data){
     
                           $btn = '<a href="'.route('slider.edit',$data->id).'" class="edit btn btn-primary btn-sm">Edit</a>';
    
                            return $btn;
                    })
                    ->addColumn('delete', function($data){
                       
                           $btn = '<a  onclick="silmedenSor('."'".route('slider.delete',$data->id)."'".');return false" class="edit btn btn-danger btn-sm">Sil</a>';
    
                            return $btn;
                    })
                    ->rawColumns(['edit','delete','image','language_name'])
                    ->make(true);
        }
        
        
        return view('admin.slider.index');
    }
    public function create()
    {
            $language=Language::all();
            
            return view('admin.slider.create',['language'=>$language]);
    }
    public function store(Request $request)
    {   

         $request->validate([
            'title.*'=>'required',
            'url.*'=>'required',
            'description.*'=>'required',
             'image' => 'required|array',
             
           ]);

            
            $language=Language::all();

           // return response()->json($language[0]->id);
            foreach ($language as  $value) {
                    
                   
                   /* if($request->title[$value->id]=='' || $request->description[$value->id]=='' || $request->url[$value->id]=='' || $request->image[$value->id]==''  ){
                        
                        return redirect()->back()->with('status','Tüm inputları doldurunuz');
                    }*/

                    $varmi=SliderContent::where('language_id',$value->id)->count();
                    if($varmi>0){
                        $sl=SliderContent::where('language_id',$value->id)->first();
                        Storage::delete($sl->image);
                        $sl->delete();
                    }
                    $slidercontent=new SliderContent;
                    $slidercontent->language_id=$value->id;
                    $slidercontent->title=$request->title[$value->id];
                    $slidercontent->description=$request->description[$value->id];
                    $slidercontent->url=$request->url[$value->id];
                  
                    if(!empty($request->file('image'))){

                       $slidercontent->image=Storage::putFile('images', $request->image[$value->id]);  //storage burda
                        
                    }
                     $slidercontent->save();

                 
          }
         
          return redirect()->back()->with('status','Kayıt Başarılı');
    }

    public function edit($id){
           
           $edit=SliderContent::findOrFail($id);
          
           return view('admin.slider.edit',['edit'=>$edit]);
    }
    public function update(Request $request,$id,$language_id){
                     $request->validate([
                    'title'=>'required',
                    'url'=>'required',
                    'description'=>'required',
                     
                     
                   ]);
           
                    $slidercontent=SliderContent::findOrFail($id);

                    $slidercontent->language_id=$language_id;
                    $slidercontent->title=$request->title;
                    $slidercontent->description=$request->description;
                    $slidercontent->url=$request->url;
                    
                    if(!empty($request->file('image'))){
                         Storage::delete($slidercontent->image);
                       $slidercontent->image=Storage::putFile('images', $request->image);  //storage burda
                        
                    }
                     $slidercontent->save();
                     return redirect()->back()->with('status','Güncelleme Başarılı');



    }
    public function delete($id){
           $sl=SliderContent::findOrFail($id);
           Storage::delete($sl->image);
           $sl->delete();
           return redirect()->back()->with('status','Silindi');
    }

    public function data(){

       /* $query=SliderContent::all();
        //return response()->json($query);
        $data=Datatables::of($query)->addColumn('edit',function($query){
            return '<a href="'.route('admin.slider.edit',['id'=>$query->id]).'">Düzenle</a>';
        })->addColumn('delete',function($query){
            return '<a href="'.route('admin.slider.delete',['id'=>$query->id]).'">Sil</a>';
        })->rawColumns(['edit','delete'])->make(true);
        return $data;*/
    }
}
