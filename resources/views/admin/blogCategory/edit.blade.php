@extends('layouts.admin.master')
@section('title','Blog Kategori Düzenle')
@section('content')

          <div id="mainContent">
            <div class="row gap-20 masonry pos-r">
              <div class="masonry-sizer col-md-6"></div>
              <div class="masonry-item col-md-6">
                <div class="bgc-white p-20 bd">
                  <h6 class="c-grey-900">Blog Kategori Düzenle</h6>
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
                    <form method="post" action="{{route('blogCategory.update',['id'=>$data->id])}}" enctype="multipart/form-data">
                      @csrf
                      <div class="form-group">
                        <select class="form-control" name="language_id" aria-label="Default select example">

                            <option value="" >Dil Seçiniz</option>
                            @foreach($language as $l)
                            <option value="{{$l->id}}" @if($data->language_id==$l->id) selected @endif>{{$l->name}}</option>
                            
                            @endforeach
                          </select>
                        
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Kategori Ad</label>
                        <input type="text" class="form-control" name="name" value="{{$data->name}}" >
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Kategori Title</label>
                        <input type="text" class="form-control" name="title" value="{{$data->title}}">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Kategori Description</label>
                        <textarea name="editor1">{{$data->description}}</textarea>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Kategori Keywords</label>
                        <input type="text" class="form-control" name="keywords" value="{{$data->keywords}}" >
                      </div>
                       
                      <button  class="btn btn-primary">Kaydet</button>
                    </form>
                  </div>
                </div>
              </div>
              
             
            </div>
          </div>
     



@endsection