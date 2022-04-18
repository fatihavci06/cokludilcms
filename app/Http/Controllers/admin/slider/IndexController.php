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

        
        //return response()->json($data);
        
        return view('admin.slider.index',['data'=>$data]);
    }
    public function create()
    {
            $language=Language::all();
            
            return view('admin.slider.create',['language'=>$language]);
    }
    public function store(Request $request)
    {   

         $request->validate([
            'title'=>'required',
            'url'=>'required',
            'description'=>'required',
             'image' => 'required',
             'language_id'=>'required'
             
           ]);

            
         $data=new SliderContent;
         $data->language_id=$request->language_id;
         $data->title=$request->title;
         $data->url=$request->url;
         $data->description=$request->description;
         if(!empty($request->file('image'))){
            
            $data->image=Storage::putFile('images', $request->file('image'));  //storage burda
            
        }
         $saved=$data->save();
         if(!$saved){
            App::Abort(500,'Error');
         }
         else{
         
          return redirect()->back()->with('status','Kayıt Başarılı');
        }
    }

    public function edit($id){
           
           $edit=SliderContent::findOrFail($id);
            $language=Language::all();
           return view('admin.slider.edit',['data'=>$edit,'language'=>$language]);
    }
    public function sortable(Request $request){
        
          
           foreach ($request->get('slider') as $key => $value) { //bladeden gelen page (blade ne yazarsan o gelir tablo içerine bak)
              
              $data=SliderContent::findOrfail($value);
              $data->order_number=$key;
              $data->save();

           }
                    
    }
    public function update(Request $request,$id){
                     $request->validate([
                    'title'=>'required',
                    'url'=>'required',
                    'description'=>'required',
                     
                     
                   ]);
           
                    $slidercontent=SliderContent::findOrFail($id);

                    $slidercontent->language_id=$request->language_id;
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
