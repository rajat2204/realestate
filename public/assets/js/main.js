(function($) {
  
  "use strict";  

  $(window).on('load', function() {

    /* 
   MixitUp
   ========================================================================== */
  $('#portfolio').mixItUp();

  /* 
   One Page Navigation & wow js
   ========================================================================== */
    // var OnePNav = $('.onepage-nev');
    // var top_offset = OnePNav.height() - -0;
    // OnePNav.onePageNav({
    //   currentClass: 'active',
    //   fadeOut:'300',
    //   scrollOffset: top_offset,
    // });
  
  /*Page Loader active
    ========================================================*/
    $('#preloader').fadeOut();

  // Sticky Nav
    $(window).on('scroll', function() {
        if ($(window).scrollTop() > 200) {
            $('.scrolling-navbar').addClass('top-nav-collapse');
        } else {
            $('.scrolling-navbar').removeClass('top-nav-collapse');
        }
    });

    /* slicknav mobile menu active  */
    $('.mobile-menu').slicknav({
        prependTo: '.navbar-header',
        parentTag: 'liner',
        allowParentLinks: true,
        duplicate: true,
        label: '',
        closedSymbol: '<i class="icon-arrow-right"></i>',
        openedSymbol: '<i class="icon-arrow-down"></i>',
      });

      /* WOW Scroll Spy
    ========================================================*/
     var wow = new WOW({
      //disabled for mobile
        mobile: false
    });

    wow.init();

    /* Nivo Lightbox 
    ========================================================*/
    $('.lightbox').nivoLightbox({
        effect: 'fadeScale',
        keyboardNav: true,
      });

    /* Counter
    ========================================================*/
    $('.counterUp').counterUp({
     delay: 10,
     time: 1000
    });


    /* Back Top Link active
    ========================================================*/
      var offset = 200;
      var duration = 500;
      $(window).scroll(function() {
        if ($(this).scrollTop() > offset) {
          $('.back-to-top').fadeIn(400);
        } else {
          $('.back-to-top').fadeOut(400);
        }
      });

      $('.back-to-top').on('click',function(event) {
        event.preventDefault();
        $('html, body').animate({
          scrollTop: 0
        }, 600);
        return false;
      });

      

  });      

}(jQuery));

$(document).ready(function(){
      var winWidth = $(window).width();
      // showWidth( "window", $( window ).width() );
        if (winWidth>991) {
           $("#vertical_slider").mCustomScrollbar({
              axis:"y", // horizontal scrollbar
              scrollButtons:{enable:true},
              theme:"light-thick",
              scrollbarPosition:"outside"
      //         callbacks:{
      //   onOverflowY:function(){
      //     var opt=$(this).data("mCS").opt;
      //     if(opt.mouseWheel.axis!=="y") opt.mouseWheel.axis="y";
      //   },
      //   onOverflowX:function(){
      //     var opt=$(this).data("mCS").opt;
      //     if(opt.mouseWheel.axis!=="x") opt.mouseWheel.axis="x";
        
          });
        }
        else{
          $("#vertical_slider").mCustomScrollbar({
              axis:"x", // horizontal scrollbar
              scrollButtons:{enable:true},
              theme:"light-thick",
              scrollbarPosition:"outside"
          });
        }
      });
        // }
      $(document).ready(function(){
      var winWidth = $(window).width();
      // showWidth( "window", $( window ).width() );
        if (winWidth>991) {
           $("#vertical_slider2").mCustomScrollbar({
              axis:"y", // horizontal scrollbar
              scrollButtons:{enable:true},
              theme:"light-thick",
              scrollbarPosition:"outside"
      //         callbacks:{
      //   onOverflowY:function(){
      //     var opt=$(this).data("mCS").opt;
      //     if(opt.mouseWheel.axis!=="y") opt.mouseWheel.axis="y";
      //   },
      //   onOverflowX:function(){
      //     var opt=$(this).data("mCS").opt;
      //     if(opt.mouseWheel.axis!=="x") opt.mouseWheel.axis="x";
        
          });
        }
        else{
          $("#vertical_slider2").mCustomScrollbar({
              axis:"x", // horizontal scrollbar
              scrollButtons:{enable:true},
              theme:"light-thick",
              scrollbarPosition:"outside"
          });
        }
      });

      /*on mobile slider*/

      $(document).ready(function(){
      // var winWidth = $(window).width();
      // showWidth( "window", $( window ).width() );
       
           $("#vertical_slider3").mCustomScrollbar({
              axis:"y", // horizontal scrollbar
              scrollButtons:{enable:true},
              theme:"light-thick",
              scrollbarPosition:"outside"
    
          });
       
      });
        // }
      $(document).ready(function(){
      // var winWidth = $(window).width();
      // showWidth( "window", $( window ).width() );
              $("#vertical_slider4").mCustomScrollbar({
              axis:"y", // horizontal scrollbar
              scrollButtons:{enable:true},
              theme:"light-thick",
              scrollbarPosition:"outside"
    
          });
        
      });


        // hero slider js
        $(document).ready(function() {

            var homebannerDesc = $('#hero_slider');
            var homebannerDesc_settings = {
                loop: true,
                mouseDrag: true ,
                autoplaySpeed: 1000,
                navSpeed: 1000,
                dotsSpeed: 1000,
                dragEndSpeed: 1000,
                autoplay: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    360: {
                        items: 1
                    },
                    500: {
                        items: 1
                    },
                    1200: {
                        items: 1
                    },
                    1600: {
                        items: 1
                    }
                }
            };
            homebannerDesc.owlCarousel(homebannerDesc_settings);

        });


        // notice slider js
        $(document).ready(function() {
            var owl = $('#notice_slider');
              owl.owlCarousel({
                  // items:4,
                  loop:true,
                  // margin:10,
                  slideTransition: 'linear',
                  autoplaySpeed: 2000,
                  autoplay:true,
                  autoplayTimeout:3000,
                  autoplayHoverPause:true,
                  responsive: {
                    0: {
                        items: 1
                    },
                    360: {
                        items: 1
                    },
                    500: {
                        items: 1
                    },
                    991: {
                        items: 2
                    },
                    1600: {
                        items: 2
                    }
                }
              });
              $('#notice_slider').on('mouseleave',function(){
                  owl.trigger('play.owl.autoplay',[2000])
              })
              $('#notice_slider').on('mouseover',function(){
                  owl.trigger('stop.owl.autoplay')
              })
            // var homebannerDesc = $('#notice_slider');
            // var homebannerDesc_settings = {
            //     loop: true,
            //     touchDrag: true,
            //     autoplaySpeed: 1000,
            //     navSpeed: 1000,
            //     dotsSpeed: 1000,
            //     dragEndSpeed: 1000,
            //     center: true,
            //     autoplay: true,
            //     autoplayTimeout:2000,
            //     autoplayHoverPause:true,
            //     responsive: {
            //         0: {
            //             items: 1
            //         },
            //         360: {
            //             items: 1
            //         },
            //         500: {
            //             items: 1
            //         },
            //         991: {
            //             items: 2
            //         },
            //         1600: {
            //             items: 2
            //         }
            //     }
            // };
            // homebannerDesc.owlCarousel(homebannerDesc_settings);
        });

        // $(document).ready(function() {
        //   $('#gallery'),owlCarousel(function(){
            
        //   });
            
        // });
// share icon

$('.share_with a').on('click',function(){
  $('.social-icon').toggleClass('open');
  $('.share_with').toggleClass('open');
})


  document.addEventListener('DOMContentLoaded',function(){
    var photo = new SmartPhoto(".js-img-viwer");
        photo.on('change',function(){
            console.log('change');
        });
        photo.on('close',function(){
            console.log('close');
        });
        photo.on('swipestart',function(){
            console.log('swipestart');
        });
        photo.on('swipeend',function(){
            console.log('swipeend');
        });
        photo.on('loadall',function(){
            console.log('loadall');
        });
        photo.on('zoomin',function(){
            console.log('zoomin');
        });
        photo.on('zoomout',function(){
            console.log('zoomout');
        });
        photo.on('open',function(){
            console.log('open');
        });
  });

  
 