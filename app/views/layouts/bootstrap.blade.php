<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <meta name="description" content=""> --}}
    {{-- <meta name="author" content=""> --}}

    
    <link href="/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/lib/bootstrap/bootstrap-responsive.min.css" rel="stylesheet">

    @if(Auth::check())
    <link href="/lib/jquery-ui/jquery-ui-1.9.2.custom.min.css" rel="stylesheet">
    <link href="/lib/redactor/redactor.css" rel="stylesheet">
    @endif

    @section('styles')
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }

      @media (max-width: 980px) {
        /* Enable use of floated navbar text */
        .navbar-text.pull-right {
          float: none;
          padding-left: 5px;
          padding-right: 5px;
        }
      }
    </style>
    @show
    

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="/lib/html5shiv/html5shiv.js"></script>
    <![endif]-->

  </head>

  <body>

    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="#">Project name</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="active"><a href="#">Home</a></li>
              <li><a href="#about">About</a></li>
              <li><a href="#contact">Contact</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">

      <h1>Bootstrap starter template</h1>
      <p>Use this document as a way to quick start any new project.<br> All you get is this message and a barebones HTML document.</p>

    </div> <!-- /container -->


    <script src="/lib/jquery/jquery-1.8.3.min.js"></script>
    <script src="/lib/bootstrap/js/bootstrap.min.js"></script>

    @if(Auth::check())
    <script src="/lib/jquery-ui/jquery-ui-1.9.2.custom.min.js"></script>
    <script src="/lib/redactor/redactor.min.js"></script>
    @endif

    @yield('scripts')

  </body>
</html>