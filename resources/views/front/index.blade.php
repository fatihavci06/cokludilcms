    @extends('layouts.front.master')
    @section('title', trans("general.dashboard"))
    @section('content')

        <section class="slider-section">
            <div class="slider-wrapper">
                <div id="main-slider" class="nivoSlider">
                    @foreach($slider as $s)
                    <img src="{{Storage::url($s->image)}}" alt="" title="#slider-caption-{{$s->id}}"/>
                    @endforeach
                    
                </div><!-- /#main-slider -->
                @foreach($slider as $s)
                <div id="slider-caption-{{$s->id}}" class="nivo-html-caption slider-caption">
                    <div class="display-table">
                        <div class="table-cell">
                            <div class="container">
                               <div class="slider-text">
                                    
                                    <h1 class="wow cssanimation fadeInTop" data-wow-delay="1s" data-wow-duration="800ms">{!!$s->title!!}</h1>
                                    <p class="wow cssanimation fadeInBottom" data-wow-delay="1s">{!!$s->description!!}</p>
                                    <a href="#" class="default-btn wow cssanimation fadeInBottom" data-wow-delay="0.8s">@lang('general.slider_go_to_detail')</a>
                                    
                                </div>
                           </div>
                        </div>
                    </div>
                </div>
                @endforeach <!-- /#slider-caption-1 -->
                <!-- /#slider-caption-3 -->
            </div>
        </section><!-- /#slider-Section -->
        
        
        
        <section class="services-section bg-grey bd-bottom padding">
            <div class="container">
               <div class="section-heading text-center mb-40">
                    <h4>@lang('general.home_services_title')</h4>
                    <h2>@lang('general.home_services_desc')</h2>
                </div>
                <div class="row service-wrap">
                    @foreach($services as $s)
                    <div class="col-md-4 col-sm-6 xs-padding">
                        <div class="service-box">
                            <div class="icon"><i class="{{$s->icon}}"></i></div>
                            <div class="service-content">
                                <h3>{{$s->title}}</h3>
                                <p>{{$s->mini_desc}}</p>
                            </div>
                        </div>
                    </div><!-- /Services 1 -->
                    @endforeach
                </div>
            </div>
        </section><!-- /Services Section -->
         <section id="offer_get" class="request-section padding bd-bottom">
            <div class="container">
                <div class="row request-wrap">
                    <div class="col-md-6">
                        <div class="request-heading mb-40">
                           <h2>@lang('general.call_back')</h2>
                           <p>@lang('general.call_back_text')</p>
                        </div>
                        
                    
                        <form id="formoffer" class="form-horizontal request-form">
                            @csrf
                            <div class="form-group colum-row row">
                                <div class="col-sm-6">
                                    <input type="text" id="name" name="name" class="form-control" placeholder="@lang('general.name')" >
                                </div>
                                <div class="col-sm-6">
                                    <input type="email" id="email" name="email" class="form-control" placeholder="@lang('general.email')" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <input type="text" id="subject" name="subject" class="form-control" placeholder="@lang('general.subject')" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <textarea id="message" name="icerik" cols="30" rows="5" class="form-control message" placeholder="@lang('general.message')" ></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <a class="default-btn" id="send-offer" type="submit">@lang('general.send')</a>
                                </div>
                            </div>
                            
                            <div id="er" class="alert alert-danger" style="display: none;"></div>
                            <div id="success" class="alert alert-success" style="display: none;"></div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="request-bg"></div>
        </section><!-- Request Section -->
        
        
        <section id="counter" class="counter-section">
		    <div class="container">
                <ul class="row counters">
                    <li class="col-md-3 col-sm-6 sm-padding">
                        <div class="counter-content text-center">
                            <i class="ti-bar-chart"></i>
                            <h3 class="counter">{{$setting->year_experience}}</h3>
                            <h4 class="text-white">@lang('general.experience')</h4>
                        </div>
                    </li>
                    <li class="col-md-3 col-sm-6 sm-padding">
                        <div class="counter-content text-center">
                            <i class="ti-cup"></i>
                            <h3 class="counter">{{$setting->year_won}}</h3>
                            <h4 class="text-white">@lang('general.won')</h4>
                        </div>
                    </li>
                    <li class="col-md-3 col-sm-6 sm-padding">
                        <div class="counter-content text-center">
                            <i class="ti-user"></i>
                            <h3 class="counter">{{$setting->expart_stuff}}</h3>
                            <h4 class="text-white">@lang('general.stuff')</h4>
                        </div>
                    </li>
                    <li class="col-md-3 col-sm-6 sm-padding">
                        <div class="counter-content text-center">
                            <i class="ti-face-smile"></i>
                            <h3 class="counter">{{$setting->happy_customer}}</h3>
                            <h4 class="text-white">@lang('general.happy_customer')</h4>
                        </div>
                    </li>
                </ul>
		    </div>
		</section><!-- Counter Section -->
        
        <section class="project-section bg-grey bd-bottom padding">
            <div class="container">
                <div class="section-heading mb-40 text-center">
                   <h4>@lang('general.works')</h4>
                   <h2>@lang('general.recent_projects')</h2>
                </div>
                <div id="project-carousel" class="project-carousel owl-carousel">
                    @foreach($project as $p)
                    <div class="project-item">
                        <div class="project-thumb">
                            <img src="{{Storage::url($p->image)}}" alt="img" height="158px;">
                        </div>
                        <div class="project-content">
                            <h3><a href="#">{{$p->name}}</a></h3>
                            <span class="date">{{$p->created_at}}</span>
                            <p>{{$p->aciklama}}</p>
                            <a href="#" class="project-btn">@lang('general.view_project')</a>
                        </div>
                    </div> <!-- Item 5 -->
                    @endforeach
                </div>
            </div>
        </section><!-- Project Section -->
        
        <section class="team-section bg-grey bd-bottom padding">
            <div class="container">
                <div class="section-heading mb-40 text-center">
                   <h4>@lang('general.team')</h4>
                   <h2>@lang('general.our_team')</h2>
                </div>
                <div class="team-wrapper row">
                    <div class="col-lg-12 sm-padding">
                        <div class="team-wrap row">
                            @foreach($takim as $t)
                            <div class="col-lg-3 col-sm-6 sm-padding">
                                <div class="team-details">
                                   <img src="{{Storage::url($t->image)}}" alt="team">
                                    <div class="hover">
                                        <h3>{{$t->name}} <span>{{$t->pozisyon}}</span></h3>
                                    </div>
                                </div>
                            </div><!-- /Team-1 -->
                            @endforeach
                            
                        </div>
                    </div>
                </div>
            </div>
        </section> <!-- Team Section -->
        


        
        

     
        
        <section class="cta-section padding">
            <div class="container">
                <div class="cta-content text-center">
                    <h2>{{$setting_text->banner_title}}</h2>
                    <p>{{$setting_text->banner_description}}</p>
                    <a href="#" class="default-btn">Request a Free Consulting</a>
                </div>
            </div>
        </section><!-- /Call To Action Section -->

        <section class="blog-section bd-bottom bg-grey padding">
            <div class="container">
                <div class="section-heading mb-40 text-center">
                   <h4>Blog</h4>
                   <h2>@lang('general.recent_blog')</h2>
                </div>
                <div class="row">
                    @foreach($blogs as $b)
                    <div class="col-md-4 col-sm-6 xs-padding">
                        <div class="blog-post">
                            <img src="{{Storage::url($b->image)}}" alt="blog post" height="158px">
                            <div class="blog-content">
                                <span class="date"><i class="fa fa-clock-o"></i> {{$b->date}} </span>
                                <h3><a href="#">{{$b->title}}</a></h3>
                                <p>{!! \App\Http\Controllers\front\IndexController::kisalt($b->content) !!} </p>
                                <a href="#" class="post-meta">@lang('general.read_more')</a>
                            </div>
                        </div>
                    </div><!-- Post 1 -->
                    @endforeach
                    <!-- Post 3 -->
                </div><!-- Blog Posts -->
            </div>
        </section><!-- Blog Section -->

        <div class="sponsor-section bd-bottom">
            <div class="container">
                <ul id="sponsor-carousel" class="sponsor-items owl-carousel">
                    @foreach($referans as $r)
                    <li class="sponsor-item">
                        <img src="{{Storage::url($r->image)}}" alt="sponsor-image">
                    </li>
                    @endforeach
                    
                </ul>
            </div>
        </div><!-- ./Sponsor Section -->

       
@endsection
        
@section('js')

<script type="text/javascript">

   

    $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });

   

    $(document).on('click', '#send-offer', function(e) {  

  

        e.preventDefault();

   
        var err='';
        var name = $("input[name=name]").val();

        var subject = $("input[name=subject]").val();

        var email = $("input[name=email]").val();
        var icerik = $("#message").val();
        $('#success').show();
         $('#er').hide();
         $('#success').html('Lütfen Bekleyiniz..');
   

        $.ajax({

           type:'POST',

           url:"{{route('front.offer')}}",

           data:{name:name, subject:subject, email:email,'icerik':icerik},

           success:function(veri){
            console.log(veri);
            if(veri.errors){
                $('#success').hide();
                $('#er').show();
                $.each( veri.errors, function( key, value ) {
                  err+='<li>'+value+'</li>';

                });
                $('#er').html(err);
            }
            else if(veri.error){
                $('#success').hide();
                $('#er').show();
                $('#er').html(veri.error);
                
            }
            else{
                $('#er').hide();
                $('#success').show();
                $('#success').html(veri.success);
                $('#formoffer').trigger('reset');
             }
           }

        }); 

  

    });

</script>
@endsection