<!DOCTYPE html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Tracker">
    <meta name="author" content="Smart Consulting Group">

    <title>{{ $title }}</title>

    <!-- <link href="/lib/bootstrap_2.3.1/css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- <link href="/lib/bootstrap_2.3.1/css/bootstrap-responsive.min.css" rel="stylesheet"> -->

    <link rel="stylesheet" href="/lib/bootstrap_3.0_wip/css/bootstrap.css" />
    <link rel="stylesheet" href="/lib/redactor/redactor.css" />
    
    <!--[if lt IE 9]>
      <script src="/assets/js/html5shiv.js"></script>
      <script src="/assets/js/respond/respond.min.js"></script>
    <![endif]-->
    
    @if(Auth::check())
    <style>
      body { padding-top: 60px; }
    </style>
    @endif
    <style>
      div.description {
        color:#aaa;
        font-size: 16px;
        margin-bottom: 5px;
      }
    </style>
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
        <a class="navbar-brand" href="#">Zephyr</a>
        <div class="nav-collapse collapse">
          <ul class="nav">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Pages <span class="glyphicon glyphicon-file"></span></a>
              <ul class="dropdown-menu">
                <li><a href="{{ URL::to('assets') }}" class="glyphicon glyphicon-globe"> All</a></li>
                <li><a href="{{ URL::to('asset') }}" class="glyphicon glyphicon-plus"> Add new</a></li>
                <li class="divider"></li>
                <li class="nav-header">By Category</li>
                
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Streams <span class="glyphicon glyphicon-list"></span></a>
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
        <ul class="nav pull-right">
          <li class="dropdown">
            <a class="dropdown-toggle glyphicon glyphicon-globe" data-toggle="dropdown" href="#">
              {{ ucwords(Lang::get('messages.language')) }}
              </a>
            <ul class="dropdown-menu">
              @foreach($languages as $language)
              <li>
                <a href="{{ URL::to($language->abbreviation) }}">{{ ucwords($language->name) }}</a>
              </li>
              @endforeach
            </ul>
          </li>
        </ul>
      </div>
    </div>
    @endif

    <div class="container">
      @section('content')

      <div class="page-header">
        <h2>{{ $siteName }} <small>{{ $siteNameExtended }}</small></h2>
      </div>

      @if(Auth::check())
      <div class="row description">
        <div class="col col-lg-4">
          Active Pages
        </div>
        <div class="col col-lg-1 pull-right">
          
        </div>
        <div class="col col-lg-2 pull-right" style="text-align:right; padding-right:32px;">
          Unused Pages
        </div>
      </div>
      @endif


      <ul class="nav nav-tabs" style="margin-bottom:20px;">
        @foreach($links as $link)
        <li{{ ($link->slug == Request::segment(2)) ? ' class="active"' : '' }}>
          <a href="{{ URL::to(Language::current()->abbreviation.'/'.$link->slug) }}">{{ $link->name }}</a>
        </li>
        @endforeach
        @unless(Auth::check())
        <li class="dropdown pull-right">
          <a class="dropdown-toggle glyphicon glyphicon-globe" data-toggle="dropdown" href="#">
            {{ ucwords(Lang::get('messages.language')) }}
            </a>
          <ul class="dropdown-menu">
            @foreach($languages as $language)
            <li>
              <a href="{{ URL::to($language->abbreviation) }}">{{ ucwords($language->name) }}</a>
            </li>
            @endforeach
          </ul>
        </li>
        @endunless
        @if(Auth::check())
        <li class="pull-right{{ Request::is('*/page') ? ' active' : '' }}">
          <a href="{{ URL::to(Language::current()->abbreviation.'/page') }}" class="glyphicon glyphicon-plus"> new page</a>
        </li>
        @foreach($orphanPages as $page)
        <li class="pull-right{{ ((Request::segment(2) == 'page') && ($page->id == Request::segment(3))) ? ' active' : '' }}">
          <a href="{{ URL::to(Language::current()->abbreviation.'/page/'.$page->id) }}">page: {{ $page->id }}</a>
        </li>
        @endforeach
        @endif
      </ul>

      @if(Session::has('alert'))
      <div class="alert alert-{{ Session::get('alert') }} fade in">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>{{ Session::get('alert') }} -</strong> {{ Session::get('alert-message') }}
      </div>
      @endif

      @show

    </div>

    <script src="/lib/jquery/jquery-1.9.1.min.js"></script>
    <!-- <script src="/lib/bootstrap_2.3.1/js/bootstrap.min.js"></script> -->
    <script src="/lib/bootstrap_3.0_wip/js/bootstrap.min.js"></script>
    <!-- <script src="/lib/bootstrap-wysiwyg/bootstrap-wysiwyg.js"></script> -->
    <script src="/lib/redactor/redactor.min.js"></script>
    <script>
      $(document).ready(function() {
        setTimeout(function() {
          $('.alert').alert('close');
        }, 5000);
      });
    </script>
    @yield('scripts')

  </body>
</html>