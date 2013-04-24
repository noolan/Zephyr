<!DOCTYPE html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Tracker">
    <meta name="author" content="Smart Consulting Group">

    <title>Tracker - {{ $title }}</title>

    <link href="/lib/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!--[if lt IE 9]>
      <script src="/assets/js/html5shiv.js"></script>
      <script src="/assets/js/respond/respond.min.js"></script>
    <![endif]-->
    
    @if(Auth::check())
    <style>
      body { padding-top: 50px; }
    </style>
    @endif

    @yield('styles')

  </head>
  <body>

    @if(Auth::check())
    <div class="navbar navbar-fixed-top">
      <div class="container">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".nav-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">Tracker</a>
        <div class="nav-collapse collapse">
          <ul class="nav">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Assets  <span class="glyphicon glyphicon-barcode"></span></a>
              <ul class="dropdown-menu">
                <li><a href="{{ URL::to('assets') }}" class="glyphicon glyphicon-globe"> All</a></li>
                <li><a href="{{ URL::to('asset') }}" class="glyphicon glyphicon-plus"> Add new</a></li>
                <li class="divider"></li>
                <li class="nav-header">By Category</li>
                @foreach($categories as $category)
                <li><a href="{{ URL::to('assets/'.Str::plural($category)) }}">{{ $category }}</a></li>
                @endforeach
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Reports <span class="glyphicon glyphicon-file"></span></a>
              <ul class="dropdown-menu">
                <li><a href="{{ URL::to('assets') }}" class="glyphicon glyphicon-group"> Users</a></li>
                <li><a href="{{ URL::to('categories') }}" class="glyphicon glyphicon-folder-open"> Categories</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Settings <span class="glyphicon glyphicon-wrench"></span></a>
              <ul class="dropdown-menu">
                <li><a href="{{ URL::to('assets') }}" class="glyphicon glyphicon-user"> Users</a></li>
                <li><a href="{{ URL::to('categories') }}" class="glyphicon glyphicon-folder-open"> Categories</a></li>
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
    @endif

    <div class="container">
      @section('content')
      @if(Session::has('alert'))
      <div class="alert alert-{{ Session::get('alert') }} fade in">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>{{ Session::get('alert') }} -</strong> {{ Session::get('alert-message') }}
      </div>
      @endif

      @show

    </div>

    <script src="/lib/jquery/jquery-1.9.1.min.js"></script>
    <script src="/lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="/lib/mistral/mistral.jquery.js"></script>
    <script>
      /*$(document).ready(function() {
        setTimeout(function() {
          $('.alert').alert('close');
        }, 5000);
      });*/
    </script>
    @yield('scripts')

  </body>
</html>