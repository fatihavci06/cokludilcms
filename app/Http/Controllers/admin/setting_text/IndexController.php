<?php

namespace App\Http\Controllers\admin\setting_text;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting_text;
use App\Models\Language;
class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Language::all();
        return view('admin.setting_text.index',['data'=>$data]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $data=Setting_text::with('language_name')->where('language_id',$id)->first();
        $language_name=Language::select('id','name')->where('id',$id)->first();
        return view('admin.setting_text.edit',['data'=>$data,'language_name'=>$language_name]);
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
            'site_keywords'=>'required',
            'site_title'=>'required',
             'site_footer_text'=>'required',
             'site_description'=>'required',
             'banner_title'=>'required',
             'banner_description'=>'required'

             
           ]);
        $varmi=Setting_text::where('language_id',$id)->count();
        if($varmi>0){
            //update
            $data=Setting_text::where('language_id',$id)->first();
            $data->language_id=$id;
            $data->site_keywords=$request->site_keywords;
            $data->site_title=$request->site_title;
            $data->banner_title=$request->banner_title;
            $data->banner_description=$request->banner_description;
            $data->site_footer_text=$request->site_footer_text;
            $data->site_description=$request->site_description; 
            $data->save();
            return redirect()->back()->with('status','güncellendi');           
        }
        else{
            //store
            $data=new Setting_text;
            $data->language_id=$id;
            $data->site_keywords=$request->site_keywords;
            $data->site_title=$request->site_title;
            $data->banner_title=$request->banner_title;
            $data->banner_description=$request->banner_description;
            $data->site_footer_text=$request->site_footer_text;
            $data->site_description=$request->site_description; 
            $data->save();
            return redirect()->back()->with('status','kaydedildi');  
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
