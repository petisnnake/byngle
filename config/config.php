<?php
define('URL', 'http://byngle.com');
define('DEVELOPMENT_ENVIORMENT', true);
define('DB_NAME', 'byngle');
define('DB_USER', 'root');
define('DB_PASSWORD', 'lol');
define('DB_HOST', 'localhost');
define('PRICE', 2);
define('NRQUESTIONS', 43);
define('TIME', 42);
define('EMAIL', 'petisn_1289511374_biz@yahoo.com');
$correct_answers = array('B', 'A', 'D', 'D', 'E',
						 'E', 'E', 'A', 'C', 'A',
						 'B', 'A', 'A', 'E', 'H',
						 'H', 'C', 'A', 'E', 'B',
						 'C', 'H', 'G', 'A', 'D',
						 'F', 'H', 'B', 'H', 'F',
						 'E', 'D', 'E', 'F', 'C',
						 'C', 'F', 'F', 'F', 'H',
						 'B', 'G', 'D');
$errors = array('The test you are trying to access does not exist.',
				'Can\'t connect to the database.',
				'Can\'t get retreive test information from the database. Please try again.',
				'Error processing payment. Please try again.',
				'Error connecting to paypal for payment verification.',
				'',
				'',
				'');
?>