<?php

class Time {

	/*
		Wrapper class for DateTime to make the syntax more concise

	    --- Usage Examples ---
		Time::last_month()->mysql; // 2012-07-15 01:08:44
		Time::tomorrow();            // Aug 16th, 2012
		new Time('now', 'l');        // Wednesday
	*/

	public static $short = 'M jS, Y';
	public static $long  = 'l, F jS, Y';
	public static $full  = 'D M j G:i:s T Y';
	public static $mysql = 'Y-m-d H:i:s';
	public static $year  = 'Y';

	protected $time;
	protected $default;

	public function __construct($time, $default = null) {
		if (is_null($default))
			$this->default = Time::$short;
		else
			$this->default = $default;
		$this->time = new DateTime($time, new DateTimeZone(Config::get('application.timezone')));
	}

	public static function __callStatic($function, $arguments) {
		$time = strtolower(str_replace(array('-', '_'), ' ', $function));
		if (empty($arguments))
			return new Time($time);
		else
			return new Time($time, $arguments[0]);
	}

	public static function make($time = 'now') {
		return new Time($time);
	}

	public function __call($function, $arguments) {
		$function = strtolower($function);
		$format = Time::$$function;

		return $this->time->format($format);
	}

	public function __get($function) {
		$function = strtolower($function);
		$format = Time::$$function;

		return $this->time->format($format);
	}

	public function __toString() {
		return $this->time->format($this->default);
	}

	public static function ago($time) {
		$now = new Time($time);
		$diff = $now->time->diff(new DateTime);
		$post = ($diff->invert) ? ' from now' : ' ago';

		if ($diff->y > 0)
			return $diff->y . ' ' . Str::plural('year', $diff->y) . $post;
		elseif ($diff->m > 0)
			return $diff->m . ' ' . Str::plural('month', $diff->m) . $post;
		elseif ($diff->d > 0)
			return $diff->d . ' ' . Str::plural('day', $diff->d) . $post;
		elseif ($diff->h > 0)
			return $diff->h . ' ' . Str::plural('hour', $diff->h) . $post;
		elseif ($diff->i > 0)
			return $diff->i . ' ' . Str::plural('minute', $diff->i) . $post;
		elseif ($diff->s > 0)
			return $diff->s . ' ' . Str::plural('second', $diff->s) . $post;

	}



}