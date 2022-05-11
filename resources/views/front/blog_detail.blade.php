    @extends('layouts.front.master')
    @section('title', $data->title)
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
                            <input type="hidden" id="blogid" data-id="{{$data->id}}">
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
                            
                           
                            
                            <div class="comments-wrapper">
                                <h4>There are {{$comment_count}} comments</h4>
                                <ul id="comments-list" class="comments-list">
                                    @foreach($comment as $co)
                                    <li>

                                        <div class="comment-main-level">
                                            <!-- Avatar -->
                                            
                                            <!-- Contenedor del Comentario -->
                                            <div class="comment-box">
                                                <div class="comment-head">
                                                    <h6 class="comment-name by-author">{{$co->name}}</h6>
                                                    <span>{{ $co->created_at->diffForHumans()}}</span>
                                                   <a class="commentA" data-id="{{$co->id}}"> <i class="fa fa-reply" ></i></a>
                                                    
                                                </div>
                                                <div class="comment-content">
                                                    {{$co->comment}}

                                                </div>
                                            </div>
                                        </div>
                                        <!-- Respuestas de los comentarios -->
                                        <ul class="comments-list reply-list">
                                            @foreach($co->child_comment as $c)
                                          
                                            <li>
                                                <!-- Avatar -->
                                                
                                                <!-- Contenedor del Comentario -->
                                                <div class="comment-box">
                                                    <div class="comment-head">
                                                        <h6 class="comment-name ">{{$c->name}}</h6>
                                                        <span>{{ $c->created_at->diffForHumans()}}</span>
                                                       
                                                        
                                                    </div>
                                                    <div class="comment-content">
                                                        {{$c->comment}}
                                                    </div>
                                                </div>
                                            </li>
                                            
                                           @endforeach
                                           
                                        </ul>
                                    </li>
                                    <div class="comment-form2" id="commentChild_{{$co->id}}"   style="display:none;">
                                   
                                                        
                                                            <div class="form-group colum-row row">
                                                                <div class="col-sm-6">
                                                                    <input type="text" id="name_{{$co->id}}" name="name" class="form-control" placeholder="Name" required>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <input type="email" id="email_{{$co->id}}" name="email" class="form-control" placeholder="Email" required>
                                                                </div>
                                                                
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-md-12">
                                                                    <textarea id="comment_{{$co->id}}" name="comment" cols="30" rows="5" class="form-control message" placeholder="comment" required></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-md-12">
                                                                    <a  class="default-btn cgonder"  data-id="{{$co->id}}">@lang('general.send')</a>
                                                                </div>
                                                            </div>
                                                            <div id="form-messages" class="alert" role="alert"></div>
                                                       
                                                        
                                                        <div class="alert alert-success" id="sonuc_{{$co->id}}" style="display:none" ></div>
                                                        
                                                </div>
                                    @endforeach
                                </ul>
                                <div class="comment-form">
                                   
                                    <form action="{{route('front.blog_comment',['blog_id'=>$data->id,'parent_id'=>0])}}" method="post"  class="form-horizontal">
                                        @csrf
                                        <div class="form-group colum-row row">
                                            <div class="col-sm-6">
                                                <input type="text" id="name" name="name" class="form-control name" placeholder="Name" required>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="email" id="email" name="email" class="form-control" placeholder="Email" required>
                                            </div>
                                            
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <textarea id="comment" name="comment" cols="30" rows="5" class="form-control message" placeholder="comment" required></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <button  class="default-btn" type="submit">@lang('general.send')</button>
                                            </div>
                                        </div>
                                        <div id="form-messages" class="alert" role="alert"></div>
                                    </form>
                                    @if(session('status'))
                                    <div class="alert alert-success">{{session('status')}}</div>
                                    @endif
                                    @if($errors->any()) 
                                        @foreach($errors->all() as $e)
                                        <li>{{$e}}</li>
                                        @endforeach
                                    @endif
                            </div>
                            </div>
                        </div>
                    </div><!-- Blog Posts -->
                     @include('front.blog.sidebar')
                </div>
            </div>
        </section><!-- /Blog Section -->
    @endsection
    @section('js')
    <script type="text/javascript">
        
         $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });

   

    $(document).on('click', '.commentA', function(e) {  
        var comment_id=$(this).attr("data-id");
        var formChildCevap='#commentChild_'+comment_id;
        $('.comment-form2').hide();
        $(formChildCevap).show();

        

      

        
        
        
        

        

  

    });
    $(document).on('click', '.cgonder', function(e) { 

        var comment_id=$(this).attr("data-id");
        

        var blog_id=$('#blogid').attr("data-id");
        var email=$('#email_'+comment_id).val();
        var name=$('#name_'+comment_id).val();

        alert(email);
        
        var comment=$('#comment_'+comment_id).val();
        
        e.preventDefault();

        var err='';

       

        
        
        

        $.ajax({

           type:'POST',
           
           url:"{{route('front.blog_comment_ajax')}}",


           data:{name:name,email:email,comment:comment,blog_id:blog_id,parent_id:comment_id},

           success:function(data){
            if(data.errors){
                console.log(data.errors)
               
            
             
                $.each( data.errors, function( key, value ) {
                  err+='<p>'+value+'</p>';


                });
                $('#sonuc_'+comment_id).show();
                $('#sonuc_'+comment_id).html(err);
            }
            else{
             console.log(data);
             $('#sonuc_'+comment_id).show();

             $('#sonuc_'+comment_id).html(data.success);
              window.location.reload()
             
             }

           }

        });

        

      

        
        
        
        

        

  

    });

    </script>
    @endsection