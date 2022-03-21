@extends('layouts.admin.master')
@section('title','Slider Düzenle')
@section('content')

          <div id="mainContent">
            <div class="row gap-20 masonry pos-r">
              <div class="masonry-sizer col-md-12"></div>
              <div class="masonry-item col-md-12">
                <div class="bgc-white p-20 bd">
                  <h6 class="c-grey-900">Slider Düzenle</h6>
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
                    <form method="post" action="{{route('slider.update',['id'=>$edit->id,'language_id'=>$edit->language_id])}}" enctype="multipart/form-data">
                      @csrf
                      <div class="row">
                           <div class="col-md-3">
                              <div class="form-group">
                              <label for="exampleInputEmail1">Slider Resim :</label>
                              @if($edit->image)
                              <img src="{{Storage::url($edit->image)}}" width="150px" height="150px" />
                              @endif
                            </div>
                          </div>
                          <div class="col-md-3">
                              <div class="form-group">
                              <label for="exampleInputEmail1">Slider Dil :</label>
                                {{$edit->language_name->name}}
                            </div>
                          </div>
                      </div>
                       <div class="row">
                          <div class="col-md-3">
                              <div class="form-group">
                              <label for="exampleInputEmail1">Slider Resim </label>
                              <input type="file" class="form-control" name="image"  >
                            </div>
                          </div>
                          <div class="col-md-3">
                              <div class="form-group">
                              <label for="exampleInputEmail1">Slider Başlık </label>
                              <input type="text" class="form-control" name="title" value="{{$edit->title}}" >
                            </div>
                          </div>
                          <div class="col-md-3">
                              <div class="form-group">
                              <label for="exampleInputEmail1">Slider Açıklama </label>
                              <input type="text" class="form-control" name="description" value="{{$edit->description}}">
                            </div>
                          </div>
                          <div class="col-md-3">
                              <div class="form-group">
                              <label for="exampleInputEmail1">Slider URL </label>
                              <input type="text" class="form-control" name="url" value="{{$edit->url}}">
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