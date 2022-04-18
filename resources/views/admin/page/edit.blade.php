@extends('layouts.admin.master')
@section('title','Sayfa Düzenle')
@section('content')

          <div id="mainContent">
            <div class="row gap-20 masonry pos-r">
              <div class="masonry-sizer col-md-12"></div>
              <div class="masonry-item col-md-12">
                <div class="bgc-white p-20 bd">
                  <h6 class="c-grey-900">Sayfa Düzenle</h6>
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
                    <form method="post" action="{{route('page.update',$data->id)}}" enctype="multipart/form-data">
                      @csrf
                      <div class="row">
                        <div class="form-group col-md-6">
                          <select class="form-control" name="language_id" aria-label="Default select example">

                            <option value="" >Dil Seçiniz</option>
                            @foreach($language as $l)
                            <option value="{{$l->id}}" @if($data->language_id==$l->id) selected @endif>{{$l->name}}</option>
                            
                            @endforeach
                          </select>
                        </div>
                        <div class="form-group col-md-6">
                           
                          <select class="form-control" name="isAktive" aria-label="Default select example">
                            <option  value="">Durum Seçiniz</option>
                            <option value="1" @if($data->isAktive==1) selected @endif>Aktif</option>
                            <option value="2" @if($data->isAktive==2) selected @endif>Pasif</option>
                          </select>
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-md-12">
                           <input type="file" name="image" class="form-control">
                        </div>
                         
                       </div>
                      <div class="row">
                        <div class="form-group col-md-4">
                          <label for="exampleInputEmail1">Sıra Numarası</label>
                          <input type="number" class="form-control" name="order_number" value="{{$data->order_number}}" >
                        </div>
                        <div class="form-group col-md-4">
                          <label for="exampleInputEmail1">Başlık</label>
                          <input type="text" class="form-control" name="title" value="{{$data->title}}" >
                        </div>
                        <div class="form-group col-md-4">
                           <label for="exampleInputEmail1">Sayfa Adı</label>
                          <input type="text" name="name" class="form-control" value="{{$data->name}}">
                        </div>
                       </div>
                      
                       <div class="row">
                        <div class="form-group col-md-12">
                           <textarea name="editor1">{{$data->content}}</textarea>
                        </div>
                         
                       </div>
                       <div class="row">
                        <div class="form-group col-md-6">
                          <label for="exampleInputEmail1">Açıklama</label>
                          <input type="text" class="form-control" name="description" value="{{$data->description}}" >
                        </div>
                        <div class="form-group col-md-6">
                          <label for="exampleInputEmail1">Keywords</label>
                          <input type="text" class="form-control" name="keywords" value="{{$data->keywords}}" >
                        </div>
                      </div>
                      
                      <div class="row"><div class="col-md-6 mx-auto"><button  class="btn btn-primary form-control">Kaydet</button><div></div></div>
                    </form>
                  </div>
                </div>
              </div>
              
             
            </div>
          </div>
     



@endsection
