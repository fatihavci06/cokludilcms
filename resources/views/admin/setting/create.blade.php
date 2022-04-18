@extends('layouts.admin.master')
@section('title','Site Ayarları')
@section('content')

          <div id="mainContent">
            <div class="row gap-20 masonry pos-r">
              <div class="masonry-sizer col-md-12"></div>
              <div class="masonry-item col-md-12">
                <div class="bgc-white p-20 bd">
                  <h6 class="c-grey-900">Site Ayarları</h6>
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
                    <form method="post" action="{{route('setting.update',['id'=>$data->id])}}" enctype="multipart/form-data">
                      @csrf
                      
                      
                      <div class="row">
                        <div class="form-group col-md-4">
                          <label for="exampleInputEmail1">Email</label>
                          <input type="email" class="form-control" name="email" value="{{$data->email}}" >
                        </div>
                        <div class="form-group col-md-4">
                          <label for="exampleInputEmail1">Telefon</label>
                          <input type="number" class="form-control" name="phone" value="{{$data->phone}}" >
                        </div>
                        <div class="form-group col-md-4">
                          <label for="exampleInputEmail1">Youtube</label>
                          <input type="text" class="form-control" name="youtube" value="{{$data->youtube}}" >
                        </div>
                        
                       </div>
                       <div class="row">
                        <div class="form-group col-md-4">
                          <label for="exampleInputEmail1">Year Experience</label>
                          <input type="number" class="form-control" name="year_experience" value="{{$data->year_experience}}" >
                        </div>
                        <div class="form-group col-md-4">
                          <label for="exampleInputEmail1">Year Won</label>
                          <input type="number" class="form-control" name="year_won" value="{{$data->year_won}}" >
                        </div>
                        <div class="form-group col-md-4">
                          <label for="exampleInputEmail1">Expart Stuff</label>
                          <input type="number" class="form-control" name="expart_stuff" value="{{$data->expart_stuff}}" >
                        </div>
                       </div>
                       <div class="row">
                        <div class="form-group col-md-4">
                          <label for="exampleInputEmail1">Happy Customer</label>
                          <input type="number" class="form-control" name="happy_customer" value="{{$data->happy_customer}}" >
                        </div>
                        <div class="form-group col-md-4">
                          <label for="exampleInputEmail1">Facebook</label>
                          <input type="text" class="form-control" name="facebook" value="{{$data->facebook}}" >
                        </div>
                        <div class="form-group col-md-4">
                          <label for="exampleInputEmail1">Twitter</label>
                          <input type="text" class="form-control" name="twitter" value="{{$data->twitter}}" >
                        </div>
                       </div>
                       <div class="row">
                        <div class="form-group col-md-4">
                          <label for="exampleInputEmail1">Instagram</label>
                          <input type="text" class="form-control" name="instagram" value="{{$data->instagram}}" >
                        </div>
                        <div class="form-group col-md-4">
                          <label for="exampleInputEmail1">Pinterest</label>
                          <input type="text" class="form-control" name="pinterest" value="{{$data->pinterest}}" >
                        </div>
                        <div class="form-group col-md-4">
                          <label for="exampleInputEmail1">Linkedin</label>
                          <input type="text" class="form-control" name="linkedin" value="{{$data->linkedin}}" >
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
