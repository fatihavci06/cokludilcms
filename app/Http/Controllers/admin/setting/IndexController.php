<?php

namespace App\Http\Controllers\admin\setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data=Setting::where('id',1)->first();
        return view('admin.setting.create',['data'=>$data]);
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id=1)
    {
        $request->validate([
            'year_experience'=>'required',
            'year_won'=>'required',
             'expart_stuff' => 'required',
             'happy_customer'=>'required',
           ]);
        $data=Setting::findOrFail($id);
        $data->email=$request->email;
        $data->phone=$request->phone;
        $data->year_experience=$request->year_experience;
        $data->year_won=$request->year_won;
        $data->expart_stuff=$request->expart_stuff;
        $data->happy_customer=$request->happy_customer;
        $data->facebook=$request->facebook;
        $data->twitter=$request->twitter;
        $data->instagram=$request->instagram;
        $data->pinterest=$request->pinterest;
        $data->linkedin=$request->linkedin;
        $data->youtube=$request->youtube;
        $saved=$data->save();
       
        if(!$saved){
            App::abort(500, 'Error');
        }
        else{
             return redirect()->back()->with('status','Güncelleme Başarılı...');
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
