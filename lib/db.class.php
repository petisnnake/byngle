<?php

class Db
{
	protected static $dbh = false;
	protected $result;
	
	function connect()
	{
		self::$dbh = new PDO('mysql: host=' . DB_HOST . ';dbname=' . DB_NAME . ';' . DB_USER . DB_PASSWORD);
		self::$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		
	}	
}
?>