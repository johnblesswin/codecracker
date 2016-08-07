<?php
require('../session.php');
require('../user.php');
$user = new User();
if (!$user->isLoggedIn()){
	
echo "<script>alert('Session Expired');</script>";
echo "<script>window.location.replace('../index.php');</script>";	

exit;
}

			try
			{

			
				$app_username = getenv('app_username');
				$app_password = getenv('app_password');
				$app_database = getenv('app_database');


	 			$connection= new MongoClient("mongodb://$app_username:$app_password@ds145395.mlab.com:45395/$app_database");
				$db= $connection->selectDB('codetest');
			}
			catch(MongoConnectionException $e)
			{
				
				die("Server not Connected....");
			
			}
			catch(MongoException $e)
			{
			
				die("Exception");
			
			}
			

	
?>