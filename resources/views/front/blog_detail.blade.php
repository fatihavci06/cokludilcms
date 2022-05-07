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
                <div class="row">
                    <div class="col-lg-9 sm-padding">
                        <div class="blog-items single-post row">
                            <img src="{{Storage::url($data->image)}}" alt="blog post">
                            <h2>{{$data->title}}</h2>
                            <div class="meta-info">
                                <span style="margin-left:30px;">
                                     <a href="#">
                                        {{ $data->created_at->diffForHumans()}}
                                        </a>
                                </span>
                                <span style="margin-left:30px;">
                                    @foreach($data->categories as $d)
                                     <a href="{{route('front.blog_cat',$d->category_name->slug)}}">{{$d->category_name->name}}</a>
                                    @endforeach
                                </span>
                            </div><!-- Meta Info -->
                        </div>
                        <div class="blog-items single-post row">
                            {!!$data->content!!}
                            
                            <div class="share-wrap">
                                <h4>Share This Article</h4>
                                <ul class="share-icon">
                                <li><a href="https://www.facebook.com/sharer.php?u={{ url()->current() }}"><i class="ti-facebook"></i> Facebook</a></li>
                                <li><a href="https://twitter.com/intent/tweet?url={{ url()->current() }}&text={!!$data->content!!}"><i class="ti-twitter"></i> Twitter</a></li>
                                <li><a href="whatsapp://send?text={{ url()->current() }}&t={!!$data->content!!}"><i class="ti-whatsapp"></i> Whatsapp</a></li>
                                <li><a href="https://www.linkedin.com/shareArticle?mini=true&url={{ url()->current() }}&title={{$data->title}}"><i class="ti-linkedin"></i> Linkedin</a></li>
                            </ul>
                            </div><!-- Share Wrap -->
                            
                            <div class="comments-wrapper">
                                <h4>There are 4 comments</h4>
                                <ul id="comments-list" class="comments-list">
                                    <li>
                                        <div class="comment-main-level">
                                            <!-- Avatar -->
                                            <div class="comment-avatar"> <img src="img/comment-1.jpg" alt="comment"> </div>
                                            <!-- Contenedor del Comentario -->
                                            <div class="comment-box">
                                                <div class="comment-head">
                                                    <h6 class="comment-name by-author"><a href="http://creaticode.com/blog">Agustin Ortiz</a></h6>
                                                    <span>hace 20 minutos</span>
                                                    <i class="fa fa-reply"></i>
                                                    <i class="fa fa-heart"></i>
                                                </div>
                                                <div class="comment-content">
                                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit omnis animi et iure laudantium vitae, praesentium optio, sapiente distinctio illo?
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Respuestas de los comentarios -->
                                        <ul class="comments-list reply-list">
                                            <li>
                                                <!-- Avatar -->
                                                <div class="comment-avatar"> <img src="img/comment-2.jpg" alt="comment"> </div>
                                                <!-- Contenedor del Comentario -->
                                                <div class="comment-box">
                                                    <div class="comment-head">
                                                        <h6 class="comment-name"><a href="http://creaticode.com/blog">Lorena Rojero</a></h6>
                                                        <span>hace 10 minutos</span>
                                                        <i class="fa fa-reply"></i>
                                                        <i class="fa fa-heart"></i>
                                                    </div>
                                                    <div class="comment-content">
                                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit omnis animi et iure laudantium vitae, praesentium optio, sapiente distinctio illo?
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <!-- Avatar -->
                                                <div class="comment-avatar"> <img src="img/comment-3.jpg" alt="comment"> </div>
                                                <!-- Contenedor del Comentario -->
                                                <div class="comment-box">
                                                    <div class="comment-head">
                                                        <h6 class="comment-name by-author"><a href="http://creaticode.com/blog">Agustin Ortiz</a></h6>
                                                        <span>hace 10 minutos</span>
                                                        <i class="fa fa-reply"></i>
                                                        <i class="fa fa-heart"></i>
                                                    </div>
                                                    <div class="comment-content">
                                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit omnis animi et iure laudantium vitae, praesentium optio, sapiente distinctio illo?
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <div class="comment-main-level">
                                            <!-- Avatar -->
                                            <div class="comment-avatar"> <img src="img/comment-4.jpg" alt="comment"> </div>
                                            <!-- Contenedor del Comentario -->
                                            <div class="comment-box">
                                                <div class="comment-head">
                                                    <h6 class="comment-name"><a href="http://creaticode.com/blog">Lorena Rojero</a></h6>
                                                    <span>hace 10 minutos</span>
                                                    <i class="fa fa-reply"></i>
                                                    <i class="fa fa-heart"></i>
                                                </div>
                                                <div class="comment-content">
                                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit omnis animi et iure laudantium vitae, praesentium optio, sapiente distinctio illo?
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <div class="comment-form">
                                    <h4>Leave a reply</h4>
                                    <p>Your email address will not be published. Required fields are marked *</p>
                                    <form action="contact.php" method="post" id="ajax_form" class="form-horizontal">
                                        <div class="form-group colum-row row">
                                            <div class="col-sm-4">
                                                <input type="text" id="name" name="name" class="form-control" placeholder="Name" required>
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="email" id="email" name="email" class="form-control" placeholder="Email" required>
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="website" id="website" name="website" class="form-control" placeholder="Website" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <textarea id="message" name="message" cols="30" rows="5" class="form-control message" placeholder="Message" required></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <button id="submit" class="default-btn" type="submit">Send Message</button>
                                            </div>
                                        </div>
                                        <div id="form-messages" class="alert" role="alert"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div><!-- Blog Posts -->
                     @include('front.blog.sidebar')
                </div>
            </div>
        </section><!-- /Blog Section -->
    @endsection