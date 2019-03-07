<!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">
        <meta content="" name="description"/>
        <meta content="" name="author"/>

        
        <meta name="_token" content="{{ csrf_token() }}">
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
       

      
        <meta charset="utf-8"/>
        <title>Devdrishti Infrahomes Pvt. Ltd.</title>
        
    <link rel="icon" type="image/png" href="{{asset('assets/img/logo.jpg')}}">
        
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
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/jquery.mCustomScrollbar.css')}}" >
    <!-- Animate -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/animate.css')}}">
    <!-- Main Style -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/main.css')}}">
    <!-- Responsive Style -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/responsive.css')}}">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.4.6/css/swiper.css" rel="stylesheet">
<!-- ====================================[ DEFAULT STYLESHEET ]==================================== -->
</head>
    <body class="page-md login loadingInProgress">
        <div id="cover"></div>
          <div class="wrapper">
                  @yield('content')
          </div>
        
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{asset('assets/js/jquery-min.js')}}"></script>
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

    {{-- <script src="{{asset('assets/js/idangerous.swiper.min.js')}}"></script> --}}
    <script type="text/javascript" src="assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="{{asset('assets/js/owl.carousel.js')}}"></script>
    <script src="https://cdn.ckeditor.com/4.11.1/standard-all/ckeditor.js"></script>

    <script src="{{asset('assets/bower_components/ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('assets/js/main.js')}}"></script>
    <script src="{{asset('assets/js/script.js')}}"></script>
    <script src="{{asset('assets/js/sweetalert2.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.4.6/js/swiper.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.0/js/swiper.min.js.map"></script> --}}
    
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
        loop: true,
        margin: 0,
        nav: false,
        items: 1,
        dots: true,
        autoplay: true
      });

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
            loop: true,
            margin: 30,
            nav: true,
            items: 4,
            dots: true,
            autoplay: true,
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


    @yield('requirejs')
    </body>
</html>
