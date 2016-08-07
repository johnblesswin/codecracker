<?php
error_reporting(0); // stop error reporting
ini_set('session.use_strict_mode', '1');
ini_set('session.cookie_httponly', '1');


class DBConnection
{
    $app_username = getenv('app_username');
    $app_password = getenv('app_password');
    $app_database = getenv('app_database');

    const HOST = 'localhost';
    const PORT = 27017;
    const DBNAME = $app_database;
    const USERNAME = $app_password;
    const PASSWORD = $app_password;
    private static $instance;
    public $connection;
    public $database;
    private function __construct()
    {
       
        $connectionString = sprintf('mongodb://%s:%s@ds145395.mlab.com:45395/%d', 
            DBConnection::USERNAME,DBConnection::PASSWORD, 
            DBConnection::DBNAME);

        try {
            $this->connection = new MongoClient($connectionString);
            $this->database   = $this->connection->selectDB(DBConnection::DBNAME);
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