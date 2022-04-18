<?php

namespace App\Http\Controllers\admin\takim;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Language;
use App\Models\Takim;
use Illuminate\Support\Facades\Storage;
class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $data=Takim::with('language_name')->get();
        return view('admin.takim.index',['data'=>$data]);
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
        return view('admin.takim.create',['language'=>$language]);
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
            'description'=>'required',
            'language_id'=>'required',
             'isAktive'=>'required',
             'name'=>'required',
             'order_number'=>'required',
             'pozisyon'=>'required',
             'image'=>'required'

             
           ]);
        $data=new Takim;
        $data->language_id=$request->language_id;
        $data->isAktive=$request->isAktive;
        $data->name=$request->name;
        $data->pozisyon=$request->pozisyon;
        $data->order_number=$request->order_number;
        $data->description=$request->description;
        if(!empty($request->file('image'))){
                //Storage::delete($data->image);
                $data->image=Storage::putFile('images', $request->file('image'));  //storage burda
                
            }
        $data->save();
        if($data->save()){
            return redirect()->back()->with('status','Eklendi...');
        }
        else{
            return redirect()->back()->with('status','Eklenemedi');
        }

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
        //
        $language=Language::all();
        $data=Takim::findOrFail($id);
        return view('admin.takim.edit',['data'=>$data,'language'=>$language]);
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
            'description'=>'required',
            'language_id'=>'required',
             'isAktive'=>'required',
             'name'=>'required',
             'order_number'=>'required',
             'pozisyon'=>'required',
             

             
           ]);
        $data=Takim::findOrFail($id);
        $data->language_id=$request->language_id;
        $data->isAktive=$request->isAktive;
        $data->name=$request->name;
        $data->pozisyon=$request->pozisyon;
        $data->order_number=$request->order_number;
        $data->description=$request->description;
        if(!empty($request->file('image'))){
                Storage::delete($data->image);
                $data->image=Storage::putFile('images', $request->file('image'));  //storage burda
                
            }
        $data->save();
        if($data->save()){
            return redirect()->back()->with('status','Eklendi...');
        }
        else{
            return redirect()->back()->with('status','Eklenemedi');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $data=Takim::findOrFail($id);
        Storage::delete($data->image);
        $data->delete();
        return redirect()->back()->with('status','silindi');
    }
    public function sortable(Request $request){
        
          
           foreach ($request->get('takim') as $key => $value) { //bladeden gelen page (blade ne yazarsan o gelir tablo içerine bak)
              
              $data=Takim::findOrfail($value);
              $data->order_number=$key;
              $data->save();

           }
                    
    }
}
