<?php

namespace App\Http\Controllers\admin\services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Services;
use App\Models\SliderContent;
use App\Models\Language;
 use Illuminate\Support\Facades\Storage;
 use DataTables;
class IndexController extends Controller
{
    //
     public function index(Request $request){
        

        if ($request->ajax()) {
            $data = Services::with('language_name')->get();
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
                     ->addColumn('isAktive', function($data){
     
                          

                           if($data->isAktive==1){
                                 $btn ='Aktif';
                            }
                            else{
                                $btn ='Pasif'; 
                            }
                            return $btn;
                    })
                    ->addColumn('edit', function($data){
     
                           $btn = '<a href="'.route('services.edit',$data->id).'" class="edit btn btn-primary btn-sm">Edit</a>';
    
                            return $btn;
                    })
                    ->addColumn('delete', function($data){
                       
                           $btn = '<a  onclick="silmedenSor('."'".route('services.delete',$data->id)."'".');return false" class="edit btn btn-danger btn-sm">Sil</a>';
    
                            return $btn;
                    })
                    ->rawColumns(['edit','delete','image','language_name','isAktive'])
                    ->make(true);
        }
        
        
        return view('admin.services.index');
    }
     public function create(Request $request)
     {
        $language=Language::get();
       // return response()->json($language);
        return view('admin.services.create',['language'=>$language]);
     }
     public function store(Request $request)
     {
      
     $request->validate([
            'title'=>'required',
            'language_id'=>'required',
            'editor1'=>'required',
             'image' => 'required',
             'mini_image'=>'required',
             'mini_desc'=>'required',
             'isAktive'=>'required'
             
           ]);
      if(trim($request->language_id)==0 || trim($request->isAktive)==0){
        return redirect()->back()->with('status','Dil/Durum seçiniz');
      }
     
      $services=new Services;
      $services->language_id=$request->language_id;
      $services->order_number=$request->order_number;
      $services->isAktive=$request->isAktive;
      $services->title=$request->title;
      $services->mini_desc=$request->mini_desc;
      $services->description=$request->editor1;
      if(!empty($request->file('image'))){

         $services->image=Storage::putFile('images', $request->image);  //storage burda
                        
       }
       if(!empty($request->file('mini_image'))){

         $services->mini_image=Storage::putFile('images', $request->mini_image);  //storage burda
                        
       }
       $services->save();
       return redirect()->back()->with('status','Kayıt başarılı');



      return $request->editor1;
     
     }
     public function delete($id)
     {
        $services=Services::findOrFail($id);
        Storage::delete($services->image);
        $services->delete();
          return redirect()->back()->with('status','Silindi');

     }
     public function edit($id){
        $language=Language::get();
        $services=Services::findOrFail($id);
        return view('admin.services.edit',['services'=>$services,'language'=>$language]);
     }
      public function update(Request $request,$id)
     {
      
     $request->validate([
            'title'=>'required',
            'language_id'=>'required',
            'editor1'=>'required',
             
             'mini_desc'=>'required',
             'isAktive'=>'required'
             
           ]);
      
     
      $services=Services::findOrFail($id);
      $services->language_id=$request->language_id;
      $services->order_number=$request->order_number;
      $services->isAktive=$request->isAktive;
      $services->title=$request->title;
      $services->mini_desc=$request->mini_desc;
      $services->description=$request->editor1;
      if(!empty($request->file('image'))){
          Storage::delete($services->image);
         $services->image=Storage::putFile('images', $request->image);  //storage burda
                        
       }
       if(!empty($request->file('mini_image'))){
         Storage::delete($services->mini_image);
         $services->mini_image=Storage::putFile('images', $request->mini_image);  //storage burda
                        
       }
       $services->save();
       return redirect()->back()->with('status','Kayıt başarılı');



      return $request->editor1;
     
     }
}
