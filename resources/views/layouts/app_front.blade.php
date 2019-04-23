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

    $(document).ready(function() {
        var bigimage = $("#big");
        var thumbs = $("#thumbs");
        //var totalslides = 10;
        var syncedSecondary = true;

        bigimage
          .owlCarousel({
          items: 1,
          slideSpeed: 2000,
          nav: true,
          autoplay: true,
          dots: false,
          loop: true,
          responsiveRefreshRate: 200,
          navText: [
            '<i class="fa fa-arrow-left" aria-hidden="true"></i>',
            '<i class="fa fa-arrow-right" aria-hidden="true"></i>'
          ]
        })
          .on("changed.owl.carousel", syncPosition);

        thumbs
          .on("initialized.owl.carousel", function() {
          thumbs
            .find(".owl-item")
            .eq(0)
            .addClass("current");
        })
          .owlCarousel({
          items: 4,
          dots: true,
          nav: true,
          
          smartSpeed: 200,
          slideSpeed: 500,
          slideBy: 4,
          responsiveRefreshRate: 100
        })
          .on("changed.owl.carousel", syncPosition2);

        function syncPosition(el) {
          //if loop is set to false, then you have to uncomment the next line
          //var current = el.item.index;

          //to disable loop, comment this block
          var count = el.item.count - 1;
          var current = Math.round(el.item.index - el.item.count / 2 - 0.5);

          if (current < 0) {
            current = count;
          }
          if (current > count) {
            current = 0;
          }
          //to this
          thumbs
            .find(".owl-item")
            .removeClass("current")
            .eq(current)
            .addClass("current");
          var onscreen = thumbs.find(".owl-item.active").length - 1;
          var start = thumbs
          .find(".owl-item.active")
          .first()
          .index();
          var end = thumbs
          .find(".owl-item.active")
          .last()
          .index();

          if (current > end) {
            thumbs.data("owl.carousel").to(current, 100, true);
          }
          if (current < start) {
            thumbs.data("owl.carousel").to(current - onscreen, 100, true);
          }
        }

        function syncPosition2(el) {
          if (syncedSecondary) {
            var number = el.item.index;
            bigimage.data("owl.carousel").to(number, 100, true);
          }
        }

        thumbs.on("click", ".owl-item", function(e) {
          e.preventDefault();
          var number = $(this).index();
          bigimage.data("owl.carousel").to(number, 300, true);
        });
      });

    </script>
    
    <!--Start of Tawk.to Script-->

<!--End of Tawk.to Script-->
    @yield('requirejs')
  </body>
</html>
