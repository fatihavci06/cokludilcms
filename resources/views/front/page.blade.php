    @extends('layouts.front.master')
    @section('title', $data->name)
    @section('content')
     <div class="pager-header">
            <div class="container">
                <div class="page-content">
                    <h2>{{$data->name}}</h2>
                    <p>{{$data->description}} </p>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('front.index')}}">@lang('home')</a></li>
                        <li class="breadcrumb-item active">{{$data->description}}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /Page Header -->
        
        <div class="about-inner bg-grey bd-bottom padding">
            <div class="container">
                <div class="row about-inner-wrap">
                    <div class="col-md-6 xs-padding">
                        <div class="about-inner-content">
                            <h2>{{$data->title}}</h2>
                            <p>{!!$data->content!!}</p>
                            
                        </div>
                    </div>
                    <div class="col-md-6 xs-padding">
                        <div class="about-inner-bg">
                            <img src="{{Storage::url($data->image)}}" alt="img">
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /About Section -->
    @endsection