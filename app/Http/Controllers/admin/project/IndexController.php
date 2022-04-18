<?php

namespace App\Http\Controllers\admin\project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Language;
use Illuminate\Support\Str;
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
        $data=Project::with('language_name')->get();
        return view('admin.project.index',['data'=>$data]);
        
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
        return view('admin.project.create',['language'=>$language]);
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
             'image' => 'required',
             'isAktive'=>'required',
             'name'=>'required',
             'order_number'=>'required',

             
           ]);
        $project=new Project;
        $project->language_id=$request->language_id;
        $project->aciklama=$request->description;
        $project->name=$request->name;
        $project->slug=Str::slug($request->name);
        $project->isAktive=$request->isAktive;
        $project->order_number=$request->order_number;
        if(!empty($request->file('image'))){
                $project->image=Storage::putFile('images', $request->file('image'));  //storage burda
                
            }
        $project->save();
        return redirect()->back()->with('status','Başarıyla kaydedildi...');
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
        $data=Project::with('language_name')->where('id',$id)->first();
        
        $language=Language::all();
        return view('admin.project.edit',['data'=>$data,'language'=>$language]);
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

             
           ]);
        $project=Project::findOrfail($id);
        $project->language_id=$request->language_id;
        $project->aciklama=$request->description;
        $project->name=$request->name;
        $project->slug=Str::slug($request->name);
        $project->isAktive=$request->isAktive;
        $project->order_number=$request->order_number;
        if(!empty($request->file('image'))){
                Storage::delete($project->image);
                $project->image=Storage::putFile('images', $request->file('image'));  //storage burda
                
            }
        $project->save();
        return redirect()->back()->with('status','Başarıyla düzenlendi...');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        //
        $project=Project::findOrfail($id);
        $project->delete();
        return redirect()->back()->with('status','Başarıyla silindi...');


    }
    public function sortable(Request $request){
        
          
           foreach ($request->get('project') as $key => $value) {
              
              $data=Project::findOrfail($value);
              $data->order_number=$key;
              $data->save();

           }
                    
    }
}
