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

			
			

	 			$connection= new MongoClient('mongodb://'.getenv('app_username').':'.getenv('app_password').'@ds145395.mlab.com:45395/'.getenv('app_database'));
	 			
				$db= $connection->selectDB(getenv('app_database'));
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