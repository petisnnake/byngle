<?php
class Iqtest extends Db
{
	function getTest($id)
	{	
		$row = $this->dbh->query('SELECT * FROM tests WHERE id = ' . $id)->fetch(PDO::FETCH_ASSOC);
		return($row);
	}
	
	function testExists($id)
	{	
		$row = $this->dbh->query('SELECT COUNT(*) AS count FROM tests WHERE id = ' . $id)->fetch();
		return($row['count']);	
	}
	
	function testPayed($id)
	{
		$row = $this->dbh->query("SELECT COUNT(*) AS count FROM TestPayment WHERE test_id = " . $id)->fetch();
		return($row['count']);		
	}
	
	function insertPayment($id, $payment_date, $last_name, $first_name, $residence_country, $payment_gross, $mc_currency, $payer_email, $txn_id, $payer_id)
	{
		$sth = $this->dbh->prepare('SELECT COUNT(*) AS count FROM payments WHERE txn_id = ?');
		$sth->execute(array($txn_id));
		$row = $sth->fetch(PDO::FETCH_ASSOC);
		
		// check if transaction (payment) has already been introduced in the database
		if($row['count'] != 0)
		{
			throw new PDOException("Transaction already exists in database. (txn_id).", 101);		
		}
			
		$sth = $this->dbh->prepare('INSERT INTO payments(
									id, 
									payment_date,
									last_name, 
									first_name, 
									residence_country, 
									payment_gross, 
									mc_currency, 
									payer_email, 
									txn_id, 
									payer_id) 
									
									VALUES(NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
		
		$sth->execute(array($payment_date, $last_name, $first_name, $residence_country, $payment_gross, $mc_currency, $payer_email, $txn_id, $payer_id));

		$row = $this->dbh->query('SELECT @@IDENTITY')->fetch();
		
		// Add the many-to-many relationship
		$sth = $this->dbh->prepare('INSERT INTO TestPayment(`test_id`, `payment_id`) VALUES(?, ?)');
		$sth->execute(array($id, $row['@@IDENTITY']));		
	}
}