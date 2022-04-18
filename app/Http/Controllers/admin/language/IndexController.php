<?php

namespace App\Http\Controllers\admin\language;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\language;
 use Illuminate\Support\Facades\Storage;
class IndexController extends Controller
{
    //
    public function index(){
        $data=Language::all();
        return view('admin.language.index',['data'=>$data]);
    }
    public function create()
    {
            return view('admin.language.create');
    }
    public function edit($id){
        $data=Language::findOrFail($id);
        return view('admin.language.edit',['data'=>$data]);
    }
    public function update(Request $request,$id)
    {
        $request->validate([
        'name'=>'required',
            'code'=>'required'
       ]);
        $data=Language::findOrFail($id);
        $data->name=$request->name;
        $data->code=$request->code;
        $saved=$data->save();
        if(!$saved){
            App::abort(500,'Error');
        }
        else{
            return redirect()->back()->with('status','Güncelleme Başarılı...');
        }

       
       

    }
    public function store(Request $request)
    {
        $request->validate([
        'name'=>'required',
            'code'=>'required'
       ]);
        $insert=new Language;
        $insert->name=$request->name;
        $insert->code=$request->code;
        
        $insert->save();
        if($insert){
            return redirect()->back()->with('status','Başarıyla eklendi');
        }
        else{
             return redirect()->back()->with('status','Eklenemedi');
        }


            
        
        
    }
    public function delete($id){
        $data=Language::findOrFail($id);
        $data->delete();
        return redirect()->back()->with('status','silindi');

    }

}
