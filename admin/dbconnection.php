<?php
error_reporting(0); // stop error reporting
ini_set('session.use_strict_mode', '1');
ini_set('session.cookie_httponly', '1');


class DBConnection
{
   

    const HOST = 'localhost';
    const PORT = 27017;
    private static $instance;
    public $connection;
    public $database;
    private function __construct()
    {
        
        try {
            $this->connection = new MongoClient('mongodb://$app_username:$app_password@ds145395.mlab.com:45395/$app_database');

            $this->database   = $this->connection->selectDB($app_database);
        }
        catch (MongoConnectionException $e) {
            die("Server not connected");
        }
        
    }
    static public function instantiate()
    {
        if (!isset(self::$instance)) {
            $class          = __CLASS__;
            self::$instance = new $class;
        }
        return self::$instance;
    }
    public function getCollection($name)
    {
        return $this->database->selectCollection($name);
    }
}
?>