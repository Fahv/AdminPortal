<?php
require_once 'medoo.php';

class DatabaseConfig{
	//Required
	private static $database_type = 'mysql';
	private static $database_name = 'testdb';
	private static $database_server = 'localhost';
	private static $database_username = 'root';
	private static $database_password = '';

	//Optional
	private static $database_port = 3306;
	private static $database_charset = 'utf8';
	// driver_option for connection, r
	private static $database_options = [
		PDO::ATTR_CASE => PDO::CASE_NATURAL
		];
		
	public static function Initialize_DataBase(){
		
		return new medoo(['database_type' => self::$database_type,'database_name' => self::$database_name,
		'server' => self::$database_server,'username' => self::$database_username,'password' => self::$database_password,
		'port' => self::$database_port,'charset' => self::$database_charset,'option' => self::$database_options]);
	}
}
?>
