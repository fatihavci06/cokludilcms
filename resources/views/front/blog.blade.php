    @extends('layouts.front.master')
    @section('title', 'Blog')
    @section('content')
     <div class="pager-header">
            <div class="container">
                <div class="page-content">
                    
                    
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('front.index')}}">@lang('general.home')</a></li>
                        <li class="breadcrumb-item active">Blog</li>
                    </ol>
                </div>
            </div>
        </div><!-- /Page Header -->
        
        <section class="blog-section bg-grey padding">
            <div class="container">
                <div class="row right-sidebar">
                    <div class="col-lg-9 xs-padding">
                        <div class="blog-items row">
                            @foreach($data as $d)
                            <div class="col-sm-6 padding-15">
                                <div class="blog-post">
                                    <img src="{{Storage::url($d->image)}}" height="158px" alt="blog post">
                                    <div class="blog-content">
                                        <span class="date"><i class="fa fa-clock-o"></i>  {{ $d->created_at->diffForHumans()}}</span>
                                        <h3><a href="{{route('front.blog_detail',$d->slug)}}">{{$d->title}}</a></h3>
                                        <p>{!! \App\Http\Controllers\front\IndexController::kisalt($d->content) !!}.</p>
                                        <a href="{{route('front.blog_detail',$d->slug)}}" class="post-meta">@lang('general.read_more')</a>
                                    </div>
                                </div>
                            </div><!-- Post 1 -->
                            @endforeach
                            <div class="col-sm-12"> {{ $data->links() }}</div>

                        </div>
                        



                        
                    </div><!-- Blog Posts -->
                    @include('front.blog.sidebar')
                </div>
            </div>
        </section><!-- /Blog Section -->
    @endsection