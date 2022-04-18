@extends('layouts.admin.master')
@section('title','Servis Düzenle')
@section('content')

          <div id="mainContent">
            <div class="row gap-20 masonry pos-r">
              <div class="masonry-sizer col-md-12"></div>
              <div class="masonry-item col-md-12">
                <div class="bgc-white p-20 bd">
                  <h6 class="c-grey-900">Servis Düzenle</h6>
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
                    <form method="post" action="{{route('services.update',['id'=>$services->id])}}" enctype="multipart/form-data">
                      @csrf
                      <div class="row">
                        <div class="form-group col-md-6">
                          <select class="form-control" name="language_id" aria-label="Default select example">

                            <option value="" >Dil Seçiniz</option>
                            @foreach($language as $l)
                            <option value="{{$l->id}}" @if($services->language_id==$l->id) selected @endif>{{$l->name}}</option>
                            
                            @endforeach
                          </select>
                        </div>
                        <div class="form-group col-md-6">
                           
                          <select class="form-control" name="isAktive" aria-label="Default select example">
                            <option  value="">Durum Seçiniz</option>
                            <option value="1" @if($services->isAktive==1) selected @endif>Aktif</option>
                            <option value="2" @if($services->isAktive==2) selected @endif>Pasif</option>
                          </select>
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-md-6">
                          <label for="exampleInputEmail1">Sıra Numarası</label>
                          <input type="number" class="form-control" name="order_number" value="{{$services->order_number}}" >
                        </div>
                        <div class="form-group col-md-6">
                          <label for="exampleInputEmail1">Başlık</label>
                          <input type="text" class="form-control" name="title" value="{{$services->title}}" >
                        </div>
                       </div>
                      
                       <div class="row">
                        <div class="form-group col-md-6">
                           <textarea name="editor1">{{$services->description}}</textarea>
                        </div>
                         <div class="form-group col-md-6 mt-5">
                          <div class="row">
                           <label for="exampleInputEmail1">Küçük resim</label>
                           <input type="file" class="form-control" name="mini_image" >
                          </div>
                          <div class="row">
                           <label for="exampleInputEmail1">Resim</label>
                           <input type="file" class="form-control" name="image" >
                           </div>
                         </div>
                       </div>
                       <div class="row">
                        <div class="form-group col-md-6">
                          <label for="exampleInputEmail1">Mini Açıklama</label>
                          <input type="text" class="form-control" name="mini_desc" value="{{$services->mini_desc}}" >
                        </div>
                        <div class="form-group col-md-6">
                          <label for="exampleInputEmail1">İcon</label>
                          <input type="text" class="form-control" name="icon" value="{{$services->icon}}" >
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
