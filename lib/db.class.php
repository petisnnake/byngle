<?php

class Db
{
	protected $dbh = false;

	function getHandler()
	{
		return $this->dbh;		
	}
	
	function connect()
	{
		$this->dbh = new PDO('mysql: host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
		$this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		
	}	
}
?>