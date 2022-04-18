<?php

namespace App\Http\Controllers\admin\referans;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Referens;
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
        $data=Referens::all();
        return view('admin.referans.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.referans.create');
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
            'image'=>'required'
        ]);
        $data=new Referens;
        if(!empty($request->file('image'))){
            $data->image=Storage::putFile('images', $request->file('image'));  //storage burda
            
        }
        $saved=$data->save();
        if(!$saved){
            App::abort(500,'Error');

        }
        else{
            return redirect()->back()->with('status','Eklendi');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sortable(Request $request)
    {
        foreach ($request->get('referans') as $key => $value) { //bladeden gelen page (blade ne yazarsan o gelir tablo içerine bak)
              
              $data=Referens::findOrfail($value);
              $data->order_number=$key;
              $data->save();

           }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=Referens::findOrfail($id);
        return view('admin.referans.edit',['data'=>$data]);
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
            'image'=>'required'
        ]);
        $data=Referens::findOrfail($id);
        if(!empty($request->file('image'))){
            Storage::delete($data->image);
            $data->image=Storage::putFile('images', $request->file('image'));  //storage burda
            
        }
        $saved=$data->save();
        if(!$saved){
            App::abort(500,'Error');

        }
        else{
            return redirect()->back()->with('status','Düzenlendi');
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
        $data=Referens::findOrfail($id);
        Storage::delete($data->image);
        $data->delete();
        return redirect()->back()->with('status','silindi');
    }
}
