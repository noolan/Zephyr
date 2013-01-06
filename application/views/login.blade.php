@layout('bootstrap')

@section('content')
		<form class="form-signin" action="{{ URL::to('login') }}" method="post">
			<h2 class="form-signin-heading">Please sign in</h2>
			<input type="text" class="input-block-level" placeholder="Email address" name="email">
			<input type="password" class="input-block-level" placeholder="Password" name="password">
			<label class="checkbox">
				<input type="checkbox" value="remember-me"> Remember me
			</label>
			<button class="btn btn-large" type="submit">Sign in</button>
		</form>
@endsection <!-- content -->

@section('styles')
		<style type="text/css">
			body {
				padding-top: 40px;
				padding-bottom: 40px;
				background-color: #ffffff;
			}

			.form-signin {
				max-width: 300px;
				padding: 19px 29px 29px;
				margin: 0 auto 20px;
				color: #666;
				background-color: #fff;
				border: 1px solid #f0f0f0;
				-webkit-border-radius: 5px;
					 -moz-border-radius: 5px;
								border-radius: 5px;
				-webkit-box-shadow: 5px 5px 5px rgba(0,0,0,.1);
					 -moz-box-shadow: 5px 5px 5px rgba(0,0,0,.1);
								box-shadow: 5px 5px 5px rgba(0,0,0,.1);
			}
			.form-signin .form-signin-heading,
			.form-signin .checkbox {
				margin-bottom: 10px;
			}
			.form-signin input[type="text"],
			.form-signin input[type="password"] {
				font-size: 16px;
				height: auto;
				margin-bottom: 15px;
				padding: 7px 9px;
			}

		</style>
@endsection <!-- styles -->