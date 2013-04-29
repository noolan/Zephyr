@extends('layout.bootstrap')

@section('styles')
	<style>
	  body {
	    padding-top: 40px;
	    padding-bottom: 40px;
	    background-color: #eee;
	  }

	  .form-signin {
	    max-width: 330px;
	    padding: 15px;
	    margin: 0 auto;
	  }
	  .form-signin .form-signin-heading,
	  .form-signin .checkbox {
	    margin-bottom: 10px;
	  }
	  .form-signin .checkbox {
	    font-weight: normal;
	  }
	  .form-signin input[type="text"],
	  .form-signin input[type="password"] {
	    position: relative;
	    font-size: 16px;
	    height: auto;
	    padding: 10px;
	    -webkit-box-sizing: border-box;
	       -moz-box-sizing: border-box;
	            box-sizing: border-box;
	  }
	  .form-signin input[type="text"]:focus,
	  .form-signin input[type="password"]:focus {
	    z-index: 2;
	  }
	  .form-signin input[type="text"] {
	    margin-bottom: -1px;
	    border-bottom-left-radius: 0;
	    border-bottom-right-radius: 0;
	  }
	  .form-signin input[type="password"] {
	    margin-bottom: 10px;
	    border-top-left-radius: 0;
	    border-top-right-radius: 0;
	  }
	</style>
@stop

@section('content')
	<form class="form-signin" action="{{ URL::to(Language::current()->abbreviation.'/login') }}" method="POST">
    <h2 class="form-signin-heading">Please log in</h2>
    @if(Session::has('alert'))
      <div class="alert alert-{{ Session::get('alert') }} fade in">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>{{ Session::get('alert') }} -</strong> {{ Session::get('alert-message') }}
      </div>
    @endif
    <input type="text" name="email" class="input-block-level" placeholder="Email address" value="{{ Input::old('email') }}" autofocus>
    <input type="password" name="password" class="input-block-level" placeholder="Password">
    <label class="checkbox">
      <input type="checkbox" name="remember" value="remember" checked="{{ Input::old('remember') }}"> Remember me
    </label>
    <button class="btn btn-large btn-primary btn-block" type="submit">Log in</button>
  </form>
@stop