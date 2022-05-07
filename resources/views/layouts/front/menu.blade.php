<body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <div class="site-preloader-wrap">
            <div class="spinner"></div>
        </div><!-- Preloader -->
        @php
        $setting= \App\Http\Controllers\front\IndexController::setting(); 
        $dil= \App\Http\Controllers\front\IndexController::diller();
        $uygulamadili=\App\Http\Controllers\front\IndexController::uygulamadili();
        $page=\App\Http\Controllers\front\IndexController::pageGet(App::getlocale());
        $services=\App\Http\Controllers\front\IndexController::servicesGet(App::getlocale());    
         @endphp
        <header id="header" class="header-section">
            <div class="top-header">
                <div class="container">
                    <div class="top-content-wrap row">
                        <div class="col-md-6">
                            <ul class="left-info">
                                <li><a href="#"><i class="ti-email"></i>{{$setting->email}}</a></li>
                                <li><a href="#"><i class="ti-mobile"></i>{{$setting->phone}}</a></li>
                                
                            </ul>
                        </div>
                        <div class="col-md-4 d-none d-md-block">
                            <ul class="right-info">
                                <li><a href="#">Register</a></li>
                                <li><a href="#">Login</a></li>
                            </ul>
                        </div>
                        <div class="col-md-2 d-none d-md-block">
                           <ul>
   
        @if($uygulamadili=='en') <li>  <a href="http://cokludilcms.test/tr">Türkçe</a> </li>@endif
        @if($uygulamadili=='tr')  <li>  <a href="http://cokludilcms.test/en">English</a> </li>@endif
</ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bottom-header">
                <div class="container">
                    <div class="bottom-content-wrap row">
                        <div class="col-md-3">
                            <div class="site-branding">
                                <a href="{{route('front.index')}}"><img src="{{asset('front/venox/')}}/img/logo.png" alt="Brand"></a>
                            </div>
                        </div>
                       <div class="col-md-9 d-none d-md-block text-right">
                           <ul id="mainmenu" class="nav navbar-nav nav-menu">
                                <li><a href="/">@lang('general.home')</a></li>
                                <li class="active"> <a href="index.html">@lang('general.pages')</a>
                                    <ul>
                                        @foreach($page as $p)
                                       <li><a href="{{route('front.page',['slug'=>$p->slug])}}">{{$p->name}}</a></li>
                                       @endforeach
                                    </ul>
                                </li>
                                <li class="active"> <a href="#">@lang('general.services')</a>
                                    <ul>
                                        @foreach($services as $se)
                                       <li><a href="{{route('front.services',['id'=>$se->id])}}">{{$se->title}}</a></li>
                                       @endforeach
                                    </ul>
                                </li>
                               
                                
                                <li><a href="{{route('front.blog')}}">@lang('general.blog')</a>
                                    
                                </li>
                                <li> <a href="{{route('front.contact')}}">@lang('general.contact')</a></li>
                            </ul>
                            <a href="#offer_get" class="default-btn">@lang('general.call_back')</a>
                       </div>
                    </div>
                </div>
            </div>
        </header><!-- /Header Section -->

        <div class="header-height"></div>