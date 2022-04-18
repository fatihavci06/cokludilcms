@extends('layouts.admin.master')
@section('title','Referans Düzenle')
@section('content')

          <div id="mainContent">
            <div class="row gap-20 masonry pos-r">
              <div class="masonry-sizer col-md-12"></div>
              <div class="masonry-item col-md-12">
                <div class="bgc-white p-20 bd">
                  <h6 class="c-grey-900">Referans Düzenle</h6>
                  <div class="mT-30">
                    @if(session('status'))
                     <div class="alert alert-primary">{{session('status')}}</div>
                    @endif
                     @if($errors->any()) 
                     <div class="alert alert-primary">
                        @foreach($errors->all() as $e)
                        <li>{{$e}}</li>
                        @endforeach

                      </div>
                    @endif
                    <form method="post" action="{{route('referans.update',['id'=>$data->id])}}" enctype="multipart/form-data">
                      @csrf
                      
                      
                      
                       
                      <div class="row">
                        
                        <div class="form-group col-md-6">
                          <label for="exampleInputEmail1">Resim</label>
                          <input type="file" class="form-control" name="image" required  >
                        </div>
                        
                      </div>
                      
                      <div class="row"><div class="col-md-6 "><button  class="btn btn-primary form-control">Kaydet</button><div></div></div>
                    </form>
                  </div>
                </div>
              </div>
              
             
            </div>
          </div>
     



@endsection
