<?php

class If {

	public static function set() {
		foreach (func_get_args() as $argument) {
			if (isset($argument))
				return $argument;
		}
		return '';
	}

	public static function null() {
		foreach (func_get_args() as $argument) {
			if (!is_null($argument))
				return $argument;
		}
		return '';
	}

	public static function object($object, $property) {
		if (isset($object) && is_object($object))
			return $object->$property;
		return '';
	}
}