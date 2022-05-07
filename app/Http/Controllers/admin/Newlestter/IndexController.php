<?php

namespace App\Http\Controllers\admin\Newlestter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Newlestter;
 use DataTables;
class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        

        if ($request->ajax()) {
            $data = Newlestter::get();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('delete', function($data){
                       
                           $btn = '<a  onclick="silmedenSor('."'".route('newlestter.delete',$data->id)."'".');return false" class="edit btn btn-danger btn-sm">Sil</a>';
    
                            return $btn;
                    })
                    ->rawColumns(['delete'])->make(true);
            
        }
        
        return view('admin.newlestter.index');
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
        //
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
       
        $data=Newlestter::findOrFail($id);
        $data->delete();
          return redirect()->back()->with('status','Silindi');

    
    }
}
