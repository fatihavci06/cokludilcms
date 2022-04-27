    @extends('layouts.front.master')
    @section('title', trans("general.contact"))
    @section('content')

        @php
            $setting=\App\Http\Controllers\front\IndexController::Setting();
        @endphp
        <div class="pager-header">
            <div class="container">
                <div class="page-content">
                    <h2>@lang('general.contact')</h2>
                    
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">@lang('general.home')</a></li>
                        <li class="breadcrumb-item active">@lang('general.contact')</li>
                    </ol>
                </div>
            </div>
        </div><!-- /Page Header -->
        
        <section class="contact-section padding">
            <div id="google_map"></div><!-- /#google_map -->
            <div class="container">
                <div class="row contact-wrap">
                    <div class="col-md-6 xs-padding">
                        <div class="contact-info">
                            <h3>@lang('general.contact')</h3>
                            <p>@lang('general.contact_text')</p>
                           
                            <ul>
                                <li><i class="ti-location-pin"></i>{{$setting->address}}</li>
                                <li><i class="ti-mobile"></i> {{$setting->phone}}</li>
                                <li><i class="ti-email"></i> {{$setting->email}}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 xs-padding">
                        <div class="contact-form">
                            
                            <form  id="formMsg" class="form-horizontal">
                                <div class="form-group colum-row row">
                                    <div class="col-sm-6">
                                        <input type="text" id="name" name="name" class="form-control" placeholder="@lang('general.name')" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="email" id="email" name="email" class="form-control" placeholder="@lang('general.email')" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <textarea id="content" name="content" cols="30" rows="5" class="form-control message" placeholder="@lang('general.message')" required></textarea>
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-12">
                                        <a" class="default-btn" id="msgSubmit" type="submit">@lang('general.send')</a>
                                    </div>
                                </div>
                                <div id="form-messages" class="alert" role="alert"></div>
                            </form>
                            <div id="er" class="alert alert-danger" style="display: none;"></div>
                            <div id="success" class="alert alert-success" style="display: none;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- /Contact Section -->
    @endsection
    @section('js')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBGm_weV-pxqGWuW567g78KhUd7n0p97RY"></script>
    <script>

        (function($){ "use strict";

        /*=========================================================================
            Google Map Settings
        =========================================================================*/
                         
            google.maps.event.addDomListener(window, 'load', init);

            function init() {

                var mapOptions = {
                    zoom: 11,
                    center: new google.maps.LatLng(40.6700, -73.9400), 
                    scrollwheel: false,
                    navigationControl: false,
                    mapTypeControl: false,
                    scaleControl: false,
                    draggable: false,
                    styles: [{"featureType":"administrative","elementType":"all","stylers":[{"saturation":"-100"}]},{"featureType":"administrative.province","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"landscape","elementType":"all","stylers":[{"saturation":-100},{"lightness":65},{"visibility":"on"}]},{"featureType":"poi","elementType":"all","stylers":[{"saturation":-100},{"lightness":"50"},{"visibility":"simplified"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":"-100"}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"all","stylers":[{"lightness":"30"}]},{"featureType":"road.local","elementType":"all","stylers":[{"lightness":"40"}]},{"featureType":"transit","elementType":"all","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"water","elementType":"geometry","stylers":[{"hue":"#ffff00"},{"lightness":-25},{"saturation":-97}]},{"featureType":"water","elementType":"labels","stylers":[{"lightness":-25},{"saturation":-100}]}]
                };

                var mapElement = document.getElementById('google_map');

                var map = new google.maps.Map(mapElement, mapOptions);

                var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(40.6700, -73.9400),
                    map: map,
                    title: 'Location!'
                });
            }

        })(jQuery);

        </script>
        <script type="text/javascript">

   

    $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });

   

    $(document).on('click', '#msgSubmit', function(e) {  

  

        e.preventDefault();

   
        var err='';
        var name = $("input[name=name]").val();

        var email = $("input[name=email]").val();

        
        var icerik = $("#content").val();
        $('#success').show();
         $('#er').hide();
         $('#success').html('Lütfen Bekleyiniz..');
   

        $.ajax({

           type:'POST',

           url:"{{route('front.contactpost')}}",

           data:{name:name,  email:email,'icerik':icerik},

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
                $('#formMsg').trigger('reset');
             }
           }

        }); 

  

    });

</script>
    @endsection