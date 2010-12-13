<?php
class IqtestController extends Controller
{
	function __construct($model, $controller_url, $action)
	{
		parent::__construct($model, $controller_url, $action);
		
		try
		{
			$this->Iqtest->connect();
		}
		catch(PDOException $e)
		{
			header(URL . '/error/1');
			exit();
		}
	}
	
	function index()
	{
				
		
		
	}
	
	function results($query)
	{
		try
		{
			$count = $this->Iqtest->testExists($query);			
		}
		catch(PDOException $e)
		{
			header('Location: ' . URL . "/error/2");
			exit();					
		}
		
		if($count == 0)
		{
			header('Location: ' . URL . "/error/0");
			exit();				
		}
		
		$this->set('id', $query);
	}
	
	function full($query)
	{
		//Tell the view that the payment has already been done in a previous occasion
		//(will be changed if the proper post / get data is set - the payment is just being made)
		$this->set('just_payed', '0');
		$this->set('css', 'full');
		$this->set('js', 'full');
		
		try
		{
			$count = $this->Iqtest->testExists($query);
			
		}
		catch(PDOException $e)
		{
			header('Location: ' . URL . "/error/2");
			exit();					
		}
			
		// Check if the text whos full info we are trying to access, exists.
		if($count == 0)
		{
			header('Location: ' . URL . "/error/0");
			exit();				
		}
			
		try
		{
			$test = $this->Iqtest->getTest($query);		
		}
		catch(PDOException $e)
		{
			header('Location: ' . URL . "/error/2");
			exit();					
		}

		//Set the info on the test
		$this->set('test', $test);
		
		try
		{
			$count = $this->Iqtest->testPayed($query);						
		}
		catch(PDOException $e)
		{
			header('Location: ' . URL . "/error/1");
			exit();						
		}

		//Check if the user payed for this test	
		if($count != 1)
		{
			//The user is probably trying to pay for the test
			if(isset($_GET['tx']))
			{
				//----------------------------------------------------
				// read the post from PayPal system and add 'cmd'
				$req = 'cmd=_notify-synch';
				
				$tx_token = $_GET['tx'];
				$auth_token = "SyRqsdW5iSjjkGdAYUM3KsK8ZapIcDKAGCVIcKQ5dd6YapSBOr2JckAG-Gm";
				$req .= "&tx=$tx_token&at=$auth_token";
				
				// post back to PayPal system to validate
				$header = "POST /cgi-bin/webscr HTTP/1.0\r\n";
				$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
				$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
				$fp = fsockopen ('www.sandbox.paypal.com', 80, $errno, $errstr, 30);
				
				if (!$fp) 
				{
					// can't connect to paypal and verify
					header('Location: ' . URL . "/error/4");
					exit();	
				} 
				else 
				{
					fputs ($fp, $header . $req);
					// read the body data 
					$res = '';
					$headerdone = false;
					while (!feof($fp)) {
					$line = fgets ($fp, 1024);
					if (strcmp($line, "\r\n") == 0) {
					// read the header
					$headerdone = true;
					}
					else if ($headerdone)
					{
					// header has been read. now read the contents
					$res .= $line;
					}
					}
					// parse the data
					$lines = explode("\n", $res);
					$keyarray = array();
					if (strcmp ($lines[0], "SUCCESS") == 0) 
					{
						array_pop($lines);
						for ($i=1; $i<count($lines);$i++)
						{
							list($key,$val) = explode("=", $lines[$i]);
							$keyarray[urldecode($key)] = urldecode($val);
						}
						
						// check the payment_status is Completed
						// check that txn_id has not been previously processed
						// check that receiver_email is your Primary PayPal email
						// check that payment_amount/payment_currency are correct
						// process payment

						if(($keyarray['receiver_email'] != EMAIL) || ($keyarray['payment_status'] != "Completed") || ($keyarray['payment_gross'] != PRICE) || ($keyarray['mc_currency'] != 'USD'))
						{
							header('Location: ' . URL . "/error/3");
							exit();							
						}
						
						// we must now update the database
						try 
						{
							$this->Iqtest->insertPayment(
							$query,
							$keyarray['payment_date'], 
							$keyarray['last_name'], 
							$keyarray['first_name'], 
							$keyarray['residence_country'], 
							$keyarray['payment_gross'], 
							$keyarray['mc_currency'], 
							$keyarray['payer_email'], 
							$keyarray['txn_id'], 
							$keyarray['payer_id']);
						}
						catch(PDOException $e)
						{
							// Can't insert payment details in to database
							header('Location: ' . URL . "/error/3");
							exit();							
						}
						
						//Tell the views that the test was just now payed for (aka: display the thank you messages)
						$this->set('just_payed', '1');
						$this->set('info', $keyarray);
					}
					else if(strcmp($lines[0], "FAIL")==0) 
					{
						// log for manual investigation
						header('Location: ' . URL . "/error/3");
						exit();	
					}
					else
					{
						// no status was returned
						header('Location: ' . URL . "/error/3");
						exit();	
					}				
				}				
				fclose ($fp);
				//----------------------------------------------------
			}
		}
	}
}