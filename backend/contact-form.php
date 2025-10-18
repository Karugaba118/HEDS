<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the Autoloader (see "Libraries" for install instructions)
require 'vendor/autoload.php';

// Use the Mailgun class from mailgun/mailgun-php v4.2
use Mailgun\Mailgun;

// Instantiate the client.
$mg = Mailgun::create(getenv('API_KEY') ?: '203df66ddbffdffdeaf159ba4ebab4be-5e1ffd43-23fa96cf');
// When you have an EU-domain, you must specify the endpoint:
// $mg = Mailgun::create(getenv('API_KEY') ?: 'API_KEY', 'https://api.eu.mailgun.net');


if($_POST['submit'] == 1){
	//all from post of contact
	$fname = $_POST['firstname'];
	$lname = $_POST['lastname'];
	$email = $_POST['email'];
	$inquery = $_POST['inquery'];
	$subject = $_POST['subject'];

	// Compose and send your message.
	$result = $mg->messages()->send(
		'sandbox72b8bb82d09245ecb2d93b26d1e619ee.mailgun.org',
		[
			'from' => "HEDS-Visitor  $fname $lname <$email>",
			'to' => "Karugaba Mwesigwa <confortmwesigwa@gmail.com>",
			'subject' => "$inquery",
			'text' => "$subject"
		]
	);

	//print_r($result->getMessage());
	print_r($result->getMessage());





	//$msg = "inquiry submitted thanks";
	//echo $msg;

	//header("Location: ../frontend/contact.php");
	//die();




}




?>
