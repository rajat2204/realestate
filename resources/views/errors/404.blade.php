<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">
        <meta content="" name="description"/>
        <meta content="" name="author"/>
	<title>DevDrishti Infrahomes Pvt. Ltd.</title>
	<link rel="icon" type="image/png" href="{{asset('assets/img/logo.png')}}">
	 <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap.min.css')}}" >
	 <link rel="stylesheet" type="text/css" href="{{asset('assets/css/main.css')}}">
	<style type="text/css">
		.notfoundsection {
		    height: 100vh;
		    /*background-color: #9c100a;*/
		}
		.pagenotfound{
			position: relative;
			height: inherit;
		}
		.pagenotfound .pagenotcontent{
			position: absolute;
			transform: translate(-50%,-50%);
			top:50%;
			text-align: center;
			color: #9c100a;
			left:50%;
			
		}
		.pagenotcontent h4{
			font-size: 80px;
			margin-bottom: 40px;
		}
		.pagenotcontent a{
			color: #457fd5;
		    border: 1px solid #457fd5;
		    text-align: center;
		    font-size: 17px;
		    padding: 5px;
		}
		.pagenotcontent a:hover{
			color:#fff;
			background-color:#9c100a;
			border:1px solid #9c100a;
		} 
		@media screen and (max-width: 767px) {
			.pagenotcontent h4 {
			    font-size: 40px;
			}
		}
		@media screen and (max-width: 420px) {
			.pagenotcontent h4 {
			    font-size: 26px;
			}
		}
	</style>	
</head>
<body>
	<section class="notfoundsection">
		<div class="pagenotfound">
			<div class="pagenotcontent">
				<h4>Page not Found</h4>
				<a href="{{url('/')}}">Back to Home</a>
			</div>
		</div>
</section>
</body>
</html>

