<?php

class Schema extends Laravel\Database\Schema {

	public static function table_exists($table_name) {
		$database_name = Config::get('database.connections.' . Config::get('database.default') . '.database');
		return (bool) DB::only("select case when exists (select * from INFORMATION_SCHEMA.TABLES where TABLE_SCHEMA = '" . $database_name . "' and TABLE_NAME = '" . $table_name . "') then 1 else 0 end");
	}
}