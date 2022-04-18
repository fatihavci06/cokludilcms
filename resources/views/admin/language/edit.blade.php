@extends('layouts.admin.master')
@section('title','Dil Düzenle')
@section('content')

          <div id="mainContent">
            <div class="row gap-20 masonry pos-r">
              <div class="masonry-sizer col-md-6"></div>
              <div class="masonry-item col-md-6">
                <div class="bgc-white p-20 bd">
                  <h6 class="c-grey-900">Dil Düzenle</h6>
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
                    <form method="post" action="{{route('language.update',$data->id)}}" enctype="multipart/form-data">
                      @csrf
                      <div class="form-group">
                        <label for="exampleInputEmail1">Dil Adı</label>
                        <input type="text" class="form-control" name="name" value="{{$data->name}}">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Dil Kodu</label>
                        <input type="text" class="form-control" name="code" value="{{$data->code}}" >
                      </div>
                       
                      <button  class="btn btn-primary">Kaydet</button>
                    </form>
                  </div>
                </div>
              </div>
              
             
            </div>
          </div>
     



@endsection