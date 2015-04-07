<?php
	$encrypter = app('Illuminate\Encryption\Encrypter');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<meta name="csrf-token" content="{{ $encrypter->encrypt(csrf_token()) }}" />


	<title>Trendy</title>

	<link href="/assets/css/app.min.css" rel="stylesheet">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top navbar-effect">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="/"><img src="/img/logo_small.png" alt="Trendy"></a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					@if (Auth::check())
						@if (Auth::user()->type == 'admin')
							<li><a href="/articleapp"><i class="glyphicon glyphicon-list-alt"></i>&nbsp;Admin</a></li>
						@endif
					@endif
				</ul>

				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<li><a href="/auth/login"><i class="glyphicon glyphicon-user"></i>&nbsp;Login</a></li>
						<li><a href="/auth/register"><i class="glyphicon glyphicon-pencil"></i>&nbsp;Register</a></li>
					@else
						<li><a href=""><i class="glyphicon glyphicon-star"></i>&nbsp;Wishlist</a></li>
						<li><a href=""><i class="glyphicon glyphicon-shopping-cart"></i>&nbsp;Cart</a></li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="glyphicon glyphicon-user"></i>&nbsp;{{ Auth::user()->name }} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="/auth/logout"><i class="glyphicon glyphicon-log-out"></i>&nbsp;Logout</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>

	<div class="content">
		@yield('content')
	</div>

	<script src="/assets/js/app.min.js"></script>

</body>
</html>
