<?php

namespace App\Http\Controllers\admin\blogCategory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Language;
use App\Models\blogCategory;
 use Illuminate\Support\Facades\Storage;
 use Illuminate\Support\Str;
 use DataTables;
class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = blogCategory::with('language_name')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('language_name', function($data){
     
                           $btn = $data->language_name->name;
    
                            return $btn;
                    })
                    ->addColumn('edit', function($data){
     
                           $btn = '<a href="'.route('blogCategory.edit',$data->id).'" class="edit btn btn-primary btn-sm">Edit</a>';
    
                            return $btn;
                    })
                    ->addColumn('delete', function($data){
                       
                           $btn = '<a  onclick="silmedenSor('."'".route('blogCategory.delete',$data->id)."'".');return false" class="edit btn btn-danger btn-sm">Sil</a>';
    
                            return $btn;
                    })
                    ->rawColumns(['edit','delete','language_name'])
                    ->make(true);
        }
        
        
        return view('admin.blogCategory.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $language=Language::all();
        return view('admin.blogCategory.create',['language'=>$language]);
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
        $request->validate([
            'title'=>'required|unique:blog_categories',
            'name'=>'required',
            'keywords'=>'required',
            'language_id'=>'required'
             
           ]);
        $category=new blogCategory;
        $category->name=$request->name;
        $category->title=$request->title;
        $category->language_id=$request->language_id;
        $category->keywords=$request->keywords;
        $category->description=$request->editor1;
        $category->slug=Str::slug($request->title);

        $category->save();

        return redirect()->back()->with('status','Kategori başarıyla eklendi');


        

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
        $data=blogCategory::findOrFail($id);
        $language=Language::all();
        return view('admin.blogCategory.edit',['data'=>$data,'language'=>$language]);
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
            'title'=>'required',
            'name'=>'required',
            'keywords'=>'required',
            'language_id'=>'required'
             
           ]);
        $varmi=blogCategory::where('slug',Str::slug($request->title))->where('id','!=',$id)->count();
        if($varmi>0){
            return redirect()->back()->with('status','Lütfen kategori title değiştirerek deneyiniz.');
        }
        
        $category=blogCategory::findOrFail($id);
        $category->name=$request->name;
        $category->title=$request->title;
        $category->language_id=$request->language_id;
        $category->keywords=$request->keywords;
        $category->description=$request->editor1;
        $category->slug=Str::slug($request->title);

        $category->save();

        return redirect()->back()->with('status','Kategori başarıyla güncellendi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
     {

        $category=blogCategory::findOrFail($id);
        $category->delete();
          return redirect()->back()->with('status','Silindi');

     }
}
