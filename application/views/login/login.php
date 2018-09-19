
	<!--
	Author: W3layouts
	Author URL: http://w3layouts.com
	License: Creative Commons Attribution 3.0 Unported
	License URL: http://creativecommons.org/licenses/by/3.0/
	-->
	<!DOCTYPE html>
	<html lang="en">
	<head>
	<title>LOGIN | JMA</title>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Velvety Sign In Form Responsive Widget,Login form widgets, Sign up Web forms , Login signup Responsive web form,Flat Pricing table,Flat Drop downs,Registration Forms,News letter Forms,Elements" />
	<link rel="stylesheet" href="<?php echo base_url() ?>resource/login/css/flexslider.css" type="text/css" media="screen" /> <!-- Flexslider-CSS -->
	<link href="<?php echo base_url() ?>resource/login/css/font-awesome.css" rel="stylesheet"><!-- Font-awesome-CSS -->
	<link href="<?php echo base_url() ?>resource/login/css/style.css" rel='stylesheet' type='text/css'/><!-- Stylesheet-CSS -->
	<link href="//fonts.googleapis.com/css?family=Righteous" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Josefin+Sans:100,300,400,600,700" rel="stylesheet">
	<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
	</head>
	<body>
		<h1 style="color: black">Jayamas Mandiri Abadi</h1>
		<div class="main-agile">
			<div class="alert-close"> </div>
			<div class="content-wthree">
				<div class="about-middle">
				<section class="slider">
				<div class="flexslider">
					<ul class="slides">
						<li>
						<div class="banner-bottom-2">
							<div class="about-midd-main">
								<img class="agile-img" src="<?php echo base_url() ?>resource/login/images/bj.png" alt=" " class="img-responsive">
								<h4>Benjamin Franklin</h4>
								<p> Beware of little expenses. A small leak will sink a great ship.</p>
							</div>
						</div>
						</li>
					 <li>
						<div class="banner-bottom-2">
							<div class="about-midd-main">
								<img class="agile-img" src="<?php echo base_url() ?>resource/login/images/wb.png" alt=" " class="img-responsive">
								<h4>Warren Buffett</h4>
								<p>Derivatives are financial weapons of mass destruction.</p>
							</div>
						</div>
						</li>
						<li>
						<div class="banner-bottom-2">
							<div class="about-midd-main">
								<img class="agile-img" src="<?php echo base_url() ?>resource/login/images/jl.jpg" alt=" " class="img-responsive">
								<h4>John Locke</h4>
								<p> A big part of financial freedom is having your heart and mind free from worry about the what-ifs of life.</p>
							</div>
						</div>
						</li>
					</ul>
				</div>
				<div class="clear"> </div>
				</section>
			</div>
			<div class="new-account-form">
			<h2 class="heading-w3-agile">Sign In</h2>
				<form action="<?php echo site_url('home/valid_login') ?>" method="post">
					<div class="inputs-w3ls">
						<p>Username</p>
						<i class="fa fa-user" aria-hidden="true"></i>
						<input type="text" class="email" name="username" placeholder="" required="">
					</div>
					<div class="inputs-w3ls">
						<p>Password</p>
						<i class="fa fa-unlock-alt" aria-hidden="true"></i>
						<input type="password" class="password" name="password" placeholder="" required="">
					</div>
					<input type="submit" value="Sign in">
				</form>
			</div>
			<div class="clear"> </div>

			</div>
		</div>
		<div class="footer-w3l">
			<p  class="agileinfo"><?php echo date('Y') ?> &copy; PT Monstera Inti Teknologi</p>
		</div>
	<script src="<?php echo base_url() ?>resource/login/js/jquery.min.js"></script>
	<script>$(document).ready(function(c) {
			$('.alert-close').on('click', function(c){
				$('.main-agile').fadeOut('slow', function(c){
					$('.main-agile').remove();
				});
			});
		});
	</script>
	 <!-- FlexSlider -->
	<script defer src="<?php echo base_url() ?>resource/login/js/jquery.flexslider.js"></script>
		<script type="text/javascript">
			$(function(){
			});
				$(window).load(function(){
					$('.flexslider').flexslider({
						animation: "slide",
						start: function(slider){
							 $('body').removeClass('loading');
						}
					});
				});
		</script>
	<!-- FlexSlider -->

	</body>
	</html>
	<style type="text/css">
		body {
		 background-image: url("<?php echo base_url() ?>resource/login/images/bann.jpg");
		 background-color: #cccccc;
	}
	</style>