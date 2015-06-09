<!DOCTYPE html>
<?php
	$encrypter = app('Illuminate\Encryption\Encrypter');
?>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ $encrypter->encrypt(csrf_token()) }}" />
	<title>Rubix</title>
	<link href="/assets/css/app.min.css" rel="stylesheet">
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>

	<nav class="navbar-wrapper">
		<div class="navbar-main">
			<a class="logo" href="/"><img src="/img/site/logo_small.png" alt="Rubix"></a>
			<ul class="navbar-main-items">
				@if (Auth::guest())
					<li><a href="/browse"><i class="glyphicon glyphicon-eye-open"></i>&nbsp;Browse</a></li>
					<li><a href="/auth/login"><i class="glyphicon glyphicon-user"></i>&nbsp;Login</a></li>
					<li><a href="/auth/register"><i class="glyphicon glyphicon-pencil"></i>&nbsp;Register</a></li>
				@else
					<li class="dropdown">
						<a href="/user/profile/main" class="dropdown-toggle" data-toggle="dropdown" role="button">{{ Auth::user()->name }} <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="/user/profile/main"><i class="glyphicon glyphicon-user"></i>&nbsp;Profile</a></li>
							<li><a href=""><i class="glyphicon glyphicon-cog"></i>&nbsp;Settings</a></li>
							<li><a href="/auth/logout"><i class="glyphicon glyphicon-log-out"></i>&nbsp;Logout</a></li>
						</ul>
					</li>
					<li><a href="/browse"><i class="glyphicon glyphicon-eye-open"></i>&nbsp;Browse</a></li>
					<li><a href="/user/profile/wishlist"><i class="glyphicon glyphicon-star"></i>&nbsp;Wishlist</a></li>
					<li><a href="/user/profile/cart"><i class="glyphicon glyphicon-shopping-cart"></i>&nbsp;Cart</a></li>
				@endif
				@if (Auth::check())
					@if (Auth::user()->type == 'admin')
						<li><a href="/articleapp"><i class="glyphicon glyphicon-list-alt"></i>&nbsp;Admin</a></li>
					@endif
				@endif
			</ul>
			<ul class="show-navbar">
				<li class="dropdown">
					<a href="" class="dropdown-toggle" data-toggle="dropdown" role="button"><i class="glyphicon glyphicon-list-alt"></i>&nbsp;Menu <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						@if (Auth::guest())
							<li><a href="/browse"><i class="glyphicon glyphicon-eye-open"></i>&nbsp;Browse</a></li>
							<li><a href="/auth/login"><i class="glyphicon glyphicon-user"></i>&nbsp;Login</a></li>
							<li><a href="/auth/register"><i class="glyphicon glyphicon-pencil"></i>&nbsp;Register</a></li>
						@else
							<li><a href="/user/profile/main"><i class="glyphicon glyphicon-user"></i>&nbsp;Profile</a></li>
							<li><a href="/browse"><i class="glyphicon glyphicon-eye-open"></i>&nbsp;Browse</a></li>
							<li><a href="/user/profile/wishlist"><i class="glyphicon glyphicon-star"></i>&nbsp;Wishlist</a></li>
							<li><a href="/user/profile/cart"><i class="glyphicon glyphicon-shopping-cart"></i>&nbsp;Cart</a></li>
							<li><a href=""><i class="glyphicon glyphicon-cog"></i>&nbsp;Settings</a></li>
							<li><a href="/auth/logout"><i class="glyphicon glyphicon-log-out"></i>&nbsp;Logout</a></li>
						@endif
						@if (Auth::check())
							@if (Auth::user()->type == 'admin')
								<li><a href="/articleapp"><i class="glyphicon glyphicon-list-alt"></i>&nbsp;Admin</a></li>
							@endif
						@endif
					</ul>
				</li>
			</ul>
		</div>
	</nav>


	@yield('content')


	<div class="footer-wrapper">
		<div class="footer-main">
			<div class="row">
				<div class="follow-us hidden-xs col-sm-4">
					<span class="small-text">Follow us&nbsp;</span>
					<a href="" target="_blank"><img src="/img/site/icons/facebook_icon.png" alt="facebook"></a>
					<a href="" target="_blank"><img src="/img/site/icons/twitter_icon.png" alt="twitter"></a>
					<a href="" target="_blank"><img src="/img/site/icons/instagram_icon.png" alt="instagram"></a>
					<a href="" target="_blank"><img src="/img/site/icons/pinterest_icon.png" alt="pinterest"></a>
				</div>
				<div class="footer-menu col-xs-12 col-sm-4">
					<a href="/"><img src="/img/site/logoW_small.png" alt="Rubix"></a>
					<div class="footer-menu-content">
						<div class="footer-menu-left">
							<ul>
								<li><a href="/user/profile/main">Profile</a></li>
								<li><a href="/user/profile/cart">Cart</a></li>
								<li><a href="/user/profile/wishlist">Wishlist</a></li>
								<li><a href="/user/profile/like">Likes</a></li>
								<li><a href="">Settings</a></li>
							</ul>
						</div>
						<div class="footer-menu-middle">
							<img src="/img/site/footer_bar.png">
						</div>
						<div class="footer-menu-right">
							<ul>
								<li><a href="">About us</a></li>
								<li><a href="">Contact</a></li>
								<li><a href="">Information</a></li>
								<li><a href="">FAQ</a></li>
								<li><a href="">Legal</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="payment-icons hidden-xs col-sm-4">
					<img src="/img/site/icons/paypal_icon.png" alt="paypal">
					<img src="/img/site/icons/mastercard_icon.png" alt="mastercard">
					<img src="/img/site/icons/visa_icon.png" alt="visa">
				</div>
			</div>
		</div>
	</div>

	<script src="/assets/js/app.min.js"></script>

	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-63550778-1', 'auto');
	  ga('send', 'pageview');

	</script>
</body>
</html>
