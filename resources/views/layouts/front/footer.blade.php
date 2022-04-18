
 <section class="widget-section padding">
            <div class="container">
                <div class="widget-wrap row">
                    <div class="col-lg-3 col-md-6 col-sm-6 sm-padding">
                        <div class="widget-content">
                            <img src="{{asset('front/venox/')}}/img/logo-light.png" alt="logo">
                            <p>We are Education, create your passion and inspiration. And hope success will come for your dream.</p>
                            <ul class="social-icon">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-6 sm-padding">
                        <div class="widget-content">
                            <h3>@lang('general.pages')</h3>
                            <ul class="widget-link">
                                @php
                                $page=\App\Http\Controllers\front\IndexController::pageGet(App::getlocale());
                                @endphp
                                @foreach($page as $p)
                                       <li><a href="{{route('front.page',['slug'=>$p->slug])}}">{{$p->name}}</a></li>
                                       @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-6 sm-padding">
                        <div class="widget-content">
                            <h3>@lang('general.recent_blog')</h3>
                            <ul class="widget-link">
                                <li><a href="#">Wordpress Development</a></li>
                                <li><a href="#">Javascript</a></li>
                                <li><a href="#">Basic Photoshop</a></li>
                                <li><a href="#">Mastaring Php</a></li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="col-lg-3 col-sm-6 sm-padding">
                        <div class="widget-content">
                            <h3>@lang('general.newsletter')</h3>
                            <div class="subscribe-wrap">
                                <form action="#" class="subscribe-form">
                                    <input type="email" name="email" id="subs-email" class="form-input" placeholder="@lang('general.your_email')">
                                    <button type="submit" class="submit"><i class="ti-email"></i></button>
                                    <div class="clearfix"></div>
                                    <div id="subscribe-result">
                                        <p class="subscription-success"></p>
                                        <p class="subscription-error"></p>
                                    </div>
                                </form>
                            </div><!-- /.subscribe_wrap -->
                            
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- ./Widget Section -->
<footer class="footer-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 sm-padding">
                        <div class="copyright">&copy; 2022 Fatih AVCI </div>
                    </div>
                    
                </div>
            </div>
        </footer><!-- /Footer Section -->

        <a data-scroll href="#header" id="scroll-to-top"><i class="arrow_up"></i></a>

        <!-- jQuery Lib -->
        <script src="{{asset('front/venox/')}}/js/vendor/jquery-1.12.4.min.js"></script>
        <!-- Bootstrap JS -->
        <script src="{{asset('front/venox/')}}/js/vendor/bootstrap.min.js"></script>
        <!-- Tether JS -->
        <script src="{{asset('front/venox/')}}/js/vendor/tether.min.js"></script>
        <!-- Imagesloaded JS -->
        <script src="{{asset('front/venox/')}}/js/vendor/imagesloaded.pkgd.min.js"></script>
        <!-- OWL-Carousel JS -->
        <script src="{{asset('front/venox/')}}/js/vendor/owl.carousel.min.js"></script>
        <!-- isotope JS -->
        <script src="{{asset('front/venox/')}}/js/vendor/jquery.isotope.v3.0.2.js"></script>
        <!-- Smooth Scroll JS -->
        <script src="{{asset('front/venox/')}}/js/vendor/smooth-scroll.min.js"></script>
        <!-- venobox JS -->
        <script src="{{asset('front/venox/')}}/js/vendor/venobox.min.js"></script>
        <!-- ajaxchimp JS -->
        <script src="{{asset('front/venox/')}}/js/vendor/jquery.ajaxchimp.min.js"></script>
        <!-- Counterup JS -->
        <script src="{{asset('front/venox/')}}/js/vendor/jquery.counterup.min.js"></script>
        <!-- waypoints js -->
        <script src="{{asset('front/venox/')}}/js/vendor/jquery.waypoints.v2.0.3.min.js"></script>
        <!-- Slick Nav JS -->
        <script src="{{asset('front/venox/')}}/js/vendor/jquery.slicknav.min.js"></script>
        <!-- Nivo Slider JS -->
        <script src="{{asset('front/venox/')}}/js/vendor/jquery.nivo.slider.pack.js"></script>
        <!-- Wow JS -->
        <script src="{{asset('front/venox/')}}/js/vendor/wow.min.js"></script>
        <!-- Contact JS -->
        <script src="{{asset('front/venox/')}}/js/contact.js"></script>
        <!-- Main JS -->
        <script src="{{asset('front/venox/')}}/js/main.js"></script>
@yield('js')
    </body>
</html>
