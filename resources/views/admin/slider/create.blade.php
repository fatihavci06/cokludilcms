@extends('layouts.admin.master')
@section('title','Slider Ekle')
@section('content')

          <div id="mainContent">
            <div class="row gap-20 masonry pos-r">
              <div class="masonry-sizer col-md-12"></div>
              <div class="masonry-item col-md-12">
                <div class="bgc-white p-20 bd">
                  <h6 class="c-grey-900">Dil Ekle</h6>
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
                      @foreach($language as $k => $v)
                        

                        <div class="row">
                          <div class="col-md-3">
                              <div class="form-group">
                              <label for="exampleInputEmail1">Slider Resim ( {{$v['name']}} )</label>
                              <input type="file" class="form-control" name="image[{{$v['id']}}]"  >
                            </div>
                          </div>
                          <div class="col-md-3">
                              <div class="form-group">
                              <label for="exampleInputEmail1">Slider Başlık ( {{$v['name']}} )</label>
                              <input type="text" class="form-control" name="title[{{$v['id']}}]" >
                            </div>
                          </div>
                          <div class="col-md-3">
                              <div class="form-group">
                              <label for="exampleInputEmail1">Slider Açıklama ( {{$v['name']}} )</label>
                              <input type="text" class="form-control" name="description[{{$v['id']}}]" >
                            </div>
                          </div>
                          <div class="col-md-3">
                              <div class="form-group">
                              <label for="exampleInputEmail1">Slider URL ( {{$v['name']}} )</label>
                              <input type="text" class="form-control" name="url[{{$v['id']}}]" >
                            </div>
                          </div>
                        </div>
                      @endforeach
                      
                      <button  class="btn btn-primary">Kaydet</button>
                    </form>
                  </div>
                </div>
              </div>
              
             
            </div>
          </div>
     



@endsection