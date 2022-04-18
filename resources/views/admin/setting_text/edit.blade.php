@extends('layouts.admin.master')
@section('title','Text Ayarları')
@section('content')

          <div id="mainContent">
            <div class="row gap-20 masonry pos-r">
              <div class="masonry-sizer col-md-12"></div>
              <div class="masonry-item col-md-12">
                <div class="bgc-white p-20 bd">
                  <h6 class="c-grey-900">Text Ayarları---- {{$language_name->name}}</h6>
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
                    <form method="post" action="{{route('setting_text.update',['id'=>$language_name->id])}}" enctype="multipart/form-data">
                      @csrf
                      
                      
                      <div class="row">
                        <div class="form-group col-md-6">
                          <label for="exampleInputEmail1">Site Title</label>
                          <input type="text" class="form-control" name="site_title" value="@if(!empty($data->site_title)){{$data->site_title}}@endif" >
                        </div>
                        <div class="form-group col-md-6">
                          <label for="exampleInputEmail1">Site Description</label>
                          <input type="text" class="form-control" name="site_description" value="@if(!empty($data->site_description)){{$data->site_description}}@endif" >
                        </div>
                        
                        
                       </div>
                       <div class="row">
                        <div class="form-group col-md-6">
                          <label for="exampleInputEmail1">Banner Title</label>
                          <input type="text" class="form-control" name="banner_title" value="@if(!empty($data->banner_title)){{$data->banner_title}}@endif" >
                        </div>
                        <div class="form-group col-md-6">
                          <label for="exampleInputEmail1">Banner Description</label>
                          <input type="text" class="form-control" name="banner_description" value="@if(!empty($data->banner_description)){{$data->banner_description}}@endif" >
                        </div>
                        
                        
                       </div>
                       <div class="row">
                        <div class="form-group col-md-6">
                          <label for="exampleInputEmail1">Site Keywords</label>
                          <input type="text" class="form-control" name="site_keywords" value="@if(!empty($data->site_keywords)){{$data->site_keywords}}@endif" >
                        </div>
                        <div class="form-group col-md-6">
                          <label for="exampleInputEmail1">Site Footer Text</label>
                          <input type="text" class="form-control" name="site_footer_text" value="@if(!empty($data->site_footer_text)){{$data->site_footer_text}}@endif" >
                        </div>
                        
                        
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
