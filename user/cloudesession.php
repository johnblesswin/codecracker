<?php

require('../session.php');
require('../user.php');
$user = new User();
if (!$user->isLoggedIn())
{
	echo "<script>alert('Session Expired');</script>";
	echo "<script>window.location.replace('../index.php');</script>";
	exit;
}

$unvregdres= $user->regdno;



try
	{

		$app_username = getenv('app_username');
		$app_password = getenv('app_password');
		$app_database = getenv('app_database');


	 $connection= new MongoClient("mongodb://$app_username:$app_password@ds145395.mlab.com:45395/$app_database");

	 $db = $connection->selectDB('codetest');
	 $collection = $db->selectCollection('registration');


	$registered_all= $collection->count();
	$nosql = $collection->find(array(
		"regdno" => $unvregdres
	));
	$nosql2 = $collection->find(array(
		"regdno" => $unvregdres
	))->count();
	foreach($nosql as $profile)
		{
		$profile["fullname"];
		$profile["_id"];
		$profile["regdno"];
		}
	}

catch(MongoConnectionException $e)
	{
	die("Connection not established..Contact System Administrator");
	}

catch(MongoException $e)
	{
	die("Exception Caught....Contact System Administrator");
	}



	
?>