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
	    <title>DevDrishti Infrahomes Pvt. Ltd.</title>

	 	<link rel="icon" type="image/png" href="{{asset('assets/img/logo.png')}}">
	 	<!-- Bootstrap 3.3.7 -->
	 	<link rel="stylesheet" href="{{asset('assets/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
	 	<!-- Font Awesome -->
	  	<link rel="stylesheet" href="{{asset('assets/bower_components/font-awesome/css/font-awesome.min.css')}}">
	  	<!-- Theme style -->
	  	<link rel="stylesheet" href="{{asset('assets/dist/css/AdminLTE.min.css')}}">
	  	<!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
	  	<link rel="stylesheet" href="{{asset('assets/css/admin-style.css')}}">
	  	<link rel="stylesheet" href="{{asset('assets/dist/css/skins/_all-skins.min.css')}}">
	  	<link rel="stylesheet" href="{{asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.css')}}">
	  	<link rel="stylesheet" href="{{asset('assets/css/sweetalert2.css')}}">
	  	<!-- Google Font -->
	  	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	</head>

	<body class="hold-transition skin-blue sidebar-mini">
	    <div id="cover"></div>
	    <div class="wrapper">
	            @yield('content')
	    </div>

	    <!-- jQuery 3 -->
		<script src="{{asset('assets/bower_components/jquery/dist/jquery.min.js')}}"></script>
		<!-- jQuery UI 1.11.4 -->
		<!-- <script>
		  $.widget.bridge('uibutton', $.ui.button);
		</script> -->
		<!-- Bootstrap 3.3.7 -->
		<script src="{{asset('assets/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
		<script src="{{asset('assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
		<script src="{{asset('assets/bower_components/datatables.net/js/jquery.dataTables.js')}}"></script>
		<script src="{{asset('assets/js/sweetalert2.js')}}"></script>
		<!-- <script src="https://cdn.ckeditor.com/4.11.1/standard-all/ckeditor.js"></script> -->
		<script src="{{asset('assets/bower_components/ckeditor/ckeditor.js')}}"></script>
		<!-- AdminLTE App -->
		<script src="{{asset('assets/dist/js/adminlte.min.js')}}"></script>
		<script src="{{asset('assets/js/script.js')}}"></script>
		<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
		<script type="text/javascript">
		$(function () {
		    $.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		        },isLocal: false
		    });
		});

		$(function(){
	    var url = window.location.pathname, 
	        urlRegExp = new RegExp(url.replace(/\/$/,'') + "$");
	        $('.nav_active_menu a').each(function(){
	            if(urlRegExp.test(this.href.replace(/\/$/,''))){
	                $(this).parent().addClass('active');
	            }
	        });
		});

		$(document).ready(function(){
		    setTimeout(function(){
		        $('#cover').fadeToggle(); },
		        1000)
		});
		</script>
<script type="text/javascript">
	function geolocate() {
	 if (navigator.geolocation) {
	   navigator.geolocation.getCurrentPosition(function(position) {
	     var geolocation = {
	       lat: position.coords.latitude,
	       lng: position.coords.longitude
	     };
	    
	     //console.log(geolocation);
	     var circle = new google.maps.Circle({
	       center: geolocation,
	       radius: position.coords.accuracy
	     });
	     autocomplete.setBounds(circle.getBounds());
	   });
	 }
	}  
	function initAutocomplete1() {
	    autocomplete = new google.maps.places.Autocomplete(
	       /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
	       {types: ['geocode']});
	   console.log(autocomplete);
	   geolocate();
	}
	</script>

	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCFN6hK1mAT4moig0d3PEVCr4-NJaTrqLA&libraries=places&callback=initAutocomplete1">
	</script>

	  <script>
	var placeSearch, autocomplete;
	var componentForm = {
	 street_number: 'short_name',
	 route: 'long_name',
	 locality: 'long_name',
	 administrative_area_level_1: 'short_name',
	 country: 'long_name',
	 postal_code: 'short_name',
	 
	};


	function initialize() {
	      var input = document.getElementById('autocomplete');
	      var autocomplete = new google.maps.places.Autocomplete(input);
	    
	      google.maps.event.addListener(autocomplete, 'place_changed', function () {
	          var place = autocomplete.getPlace();
	          document.getElementById('city').value = place.name;
	          document.getElementById('cityLat').value = place.geometry.location.lat();
	          document.getElementById('cityLng').value = place.geometry.location.lng();

	      });
	}
	 google.maps.event.addDomListener(window, 'load', initialize); 
	 $(document).ready(function(){
			$(".treeview").click(function(){
				$(this).toggleClass("dropdownmenu")


				
			});
		});
</script>
@yield('requirejs')

	</body>
</html>
