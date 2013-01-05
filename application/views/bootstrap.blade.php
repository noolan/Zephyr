<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>{{ $title }}</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		{{ Asset::styles() }}
		<style>
			body {
				padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
			}
		</style>
		@yield('styles')

		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
	</head>

	<body>
		@if(!Auth::guest())
		<div class="navbar navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">
					<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
					<a class="brand" href="#">Zephyr</a>
					<div class="nav-collapse collapse">
						<ul class="nav">
							<li><a href="#about">Add Page</a></li>
							<li><a href="#contact">Settings</a></li>
						</ul>
					</div><!--/.nav-collapse -->
				</div>
			</div>
		</div>
		@endif

		<div class="container">
			@yield('content')
		</div> <!-- /container -->


		<!-- Template scripts -->
		{{ Asset::scripts() }}

		<!-- View specific scripts -->
		@yield('scripts')

	</body>
</html>