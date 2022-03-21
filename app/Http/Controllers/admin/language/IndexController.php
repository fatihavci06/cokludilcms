<?php

namespace App\Http\Controllers\admin\language;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\language;
 use Illuminate\Support\Facades\Storage;
class IndexController extends Controller
{
    //
    public function create()
    {
            return view('admin.language.create');
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

}
