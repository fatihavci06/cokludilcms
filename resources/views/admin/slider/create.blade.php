@extends('layouts.admin.master')
@section('title','Slider Ekle')
@section('content')

          <div id="mainContent">
            <div class="row gap-20 masonry pos-r">
              <div class="masonry-sizer col-md-12"></div>
              <div class="masonry-item col-md-12">
                <div class="bgc-white p-20 bd">
                  <h6 class="c-grey-900">Slider Ekle</h6>
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
                    <form method="post" action="{{route('slider.store')}}" enctype="multipart/form-data">
                      @csrf
                      
                        
                        <div class="row">
                          <div class="col-md-6">
                              <div class="form-group">
                              <label for="exampleInputEmail1">Dil </label>
                              <select class="form-control" name="language_id" aria-label="Default select example">

                            <option value="" >Dil Seçiniz</option>
                            @foreach($language as $l)
                            <option value="{{$l->id}}" @if(old('language_id')==$l->id) selected @endif>{{$l->name}}</option>
                            
                            @endforeach
                          </select>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                              <div class="form-group">
                              <label for="exampleInputEmail1">Slider Resim </label>
                              <input type="file" class="form-control" name="image"  >
                            </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                              <label for="exampleInputEmail1">Slider Başlık </label>
                              <input type="text" class="form-control" name="title" >
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                              <div class="form-group">
                              <label for="exampleInputEmail1">Slider Açıklama </label>
                              <input type="text" class="form-control" name="description" >
                            </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                              <label for="exampleInputEmail1">Slider URL </label>
                              <input type="text" class="form-control" name="url" >
                            </div>
                          </div>
                        </div>
                      
                      
                      <button  class="btn btn-primary">Kaydet</button>
                    </form>
                  </div>
                </div>
              </div>
              
             
            </div>
          </div>
     



@endsection