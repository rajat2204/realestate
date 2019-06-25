<!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">
        <meta content="Search Real Estate Properties in India at Devdrishti, Devdrishti Infrahomes Pvt Ltd  producing, buying and selling of real estate properties" name="description"/>
        <meta content="Buy/Sale/Rent Properties | Devdrishti Infrahomes Pvt Ltd" name="author"/>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-142461506-1"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'UA-142461506-1');
        </script>

        <script async src='https://www.google-analytics.com/analytics.js'></script>
        <meta name="google-site-verification" content="itYRRPYc4CePYsGFzydgw1X32pE7cJso2c9TDYTT51Y">
        <!-- Google Tag Manager -->
      
<!-- End Google Tag Manager -->
        <!-- End Google Analytics -->
        <meta name="_token" content="{{ csrf_token() }}">
        
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans|Roboto" rel="stylesheet">
        <link rel="stylesheet" href="https://unpkg.com/smartphoto@1.1.0/css/smartphoto.min.css">
        <!-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css"> -->
       

      
        <meta charset="utf-8"/>
        <title>DevDrishti Infrahomes Pvt. Ltd.</title>
        
    <link rel="icon" type="image/png" href="{{asset('assets/img/logo.png')}}">
    <link rel="stylesheet" href="{{asset('assets/css/smartphoto.min.css')}}">  
  <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap.min.css')}}" >
    <!-- Fonts -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/fonts/font-awesome.min.css')}}">
    <!-- Icon -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/fonts/simple-line-icons.css')}}">
    <!-- Slicknav -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/slicknav.css')}}">
    <!-- Menu CSS -->
    <!-- <link rel="stylesheet" type="text/css" href="assets/css/menu_sideslide.css"> -->
    <!-- Slider CSS -->
    <!-- <link rel="stylesheet" type="text/css" href="assets/css/slide-style.css"> -->
    <!-- Nivo Lightbox -->
    <link rel="stylesheet" href="{{asset('assets/css/sweetalert2.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/nivo-lightbox.css')}}" >
    <!-- owl carousal css -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/owl.carousel.min.css')}}" >
    <!-- mcustomscroll css -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/ion.rangeSlider.min.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.3.3/css/swiper.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/jquery.mCustomScrollbar.css')}}" >
    <!-- Animate -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/animate.css')}}">
    <!-- Main Style -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/main.css')}}">
    <!-- Responsive Style -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/responsive.css')}}">
    <!-- Google Tag Manager (noscript) -->
<!-- End Google Tag Manager (noscript) -->
</head>
    <body class="page-md login loadingInProgress">
        <div id="cover"></div>
          <div class="wrapper">
            
                  @yield('content')

          </div>
        
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="{{asset('assets/js/jquery-min.js')}}"></script>
    <script src="{{asset('assets/js/smartphoto.min.js')}}"></script>
    <script src="{{asset('assets/js/popper.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.mixitup.js')}}"></script>
    <script src="{{asset('assets/js/jquery.counterup.min.js')}}"></script>
    <script src="{{asset('assets/js/waypoints.min.js')}}"></script>
    <script src="{{asset('assets/js/wow.js')}}"></script>
    <script src="{{asset('assets/js/jquery.nav.js')}}"></script>

    <script src="{{asset('assets/js/jquery.easing.min.js')}}"></script>  
    <script src="{{asset('assets/js/nivo-lightbox.js')}}"></script>
    <script src="{{asset('assets/js/jquery.slicknav.js')}}"></script>
    <script src="{{asset('assets/js/ion.rangeSlider.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>

    <script src="{{asset('assets/js/owl.carousel.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.3.3/js/swiper.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.11.1/standard-all/ckeditor.js"></script>
    <script src="https://unpkg.com/smartphoto@1.1.0/js/smartphoto.min.js"></script>
    <script src="{{asset('assets/bower_components/ckeditor/ckeditor.js')}}"></script>
    
    <script src="{{asset('assets/js/main.js')}}"></script>
    <script src="{{asset('assets/js/script.js')}}"></script>
    <script src="{{asset('assets/js/sweetalert2.js')}}"></script>
    
  
    
    <!-- [ SLIDER SCRIPT ] -->


    <script type="text/javascript">

      $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },isLocal: false
        });
      });
      
      $('.review-slider').owlCarousel({
        items:1,
        margin:30,
        animateIn: 'lightSpeedIn',
        autoplay:true,
        slideTransition: 'linear',
        autoplaySpeed: 2000,
      });
       // $('.review-slider').owlCarousel({
       //    loop: true,
       //    margin: 0,
       //    nav: false,
       //    items: 1,
       //    dots: true,
       //    autoplay: true,
       //    autoplaySpeed: 2000,
       //    autoplayTimeout: 5000,
       //    slideTransition: 'linear',
       //  });

       $(".price-filter").ionRangeSlider({
            type: "double",
            grid: true,
            min: 0,
            max: 1000,
            from: 0,
            to: 200
            // prefix: "$"
        });
       $(document).ready(function() {
          $('#our-agent').owlCarousel({
            loop: false,
            margin: 30,
            nav: true,
            items: 4,
            dots: true,
            autoplay: true,
            autoplaySpeed: 2000,
            autoplayTimeout: 5000,
            slideTransition: 'linear',
            responsive: {
              0: {
                  items: 1
              },
              360: {
                  items: 1
              },
              500: {
                  items: 2
              },
              991: {
                  items: 3
              },
              1200: {
                  items: 4
              }
            }
          });
        });

    $(window).load(function(){
      setTimeout(function(){
          $('#cover').fadeToggle();
      },500)
    });

   

    </script>
    <script>

    $(document).ready(function() {

     var docHeight = $(window).height();
     var footerHeight = $('#footer-section').height();
     var footerTop = $('#footer-section').position().top + footerHeight;

     if (footerTop < docHeight) {
      $('#footer-section').css('margin-top', 2+ (docHeight - footerTop) + 'px');
     }
    });
   </script>
    
    <!--Start of Tawk.to Script-->

<!--End of Tawk.to Script-->
    @yield('requirejs')
  </body>
</html>
