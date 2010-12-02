<?php
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));

require(ROOT . DS . 'config' . DS . 'config.php');
require(ROOT . DS . 'lib' . DS . 'db.class.php');

$answers_string = $_POST['answers'];
$order_string = $_POST['order'];
$answers = explode(',', $answers_string);
$order = explode(',', $order_string);
$iq = 0;
$wrongs = '';

for($i = 0; $i < NRQUESTIONS; $i++)
{
	if($answers[$i] == $correct_answers[$i])
	{
		$iq = $iq + 3.25;
	}
	else 
	{
		$wrongs .= ',' . $i;
	}
}

$wrongs = trim($wrongs, ',');

$iq = ceil($iq);

if($iq < 70) $iq = 70;

$ip = $_SERVER['REMOTE_ADDR'];

$db = new Db();
$db->connect();
$sth = $db->getHandler()->prepare('INSERT INTO tests(`id`, `ip`, `wrong`, `date`, `iq`, `status`) VALUES(NULL, INET_ATON(?), ?, NOW(), ?, 0)');
$sth->execute(array($ip, $wrongs, $iq));

// return the id of the inserted iq-test.
$sth = $db->getHandler()->prepare('SELECT @@IDENTITY');
$sth->execute();
$row = $sth->fetch(PDO::FETCH_ASSOC);
print ($row['@@IDENTITY']);
?>