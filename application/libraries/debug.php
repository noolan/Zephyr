<?php

class Debug {

	public static function out() {
		$vars = func_get_args();
		echo '
<!doctype html>
<html>
	<head>
		<link href="/js/google-code-prettify/prettify.css" type="text/css" rel="stylesheet" />
		<script type="text/javascript" src="/js/google-code-prettify/prettify.js"></script>
	</head>
	<body onload="prettyPrint()" style="width: 960px;">
		<pre class="prettyprint" style="padding: 20px;">';
		foreach($vars as $var)
			var_dump($var);
		echo '
		</pre>
	</body>
</html>';
		die();
	}

}