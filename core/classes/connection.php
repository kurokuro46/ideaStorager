<?php

// try for connect with class

class Connect {
    protected static $servername = "localhost";
    protected static $db_name="ideastorager";
    protected static $username = "root";
    protected static $password = "";
    protected static $pdo;

    public static function connect() {
         $servername =self::$servername;
         $db_name = self::$db_name;
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$db_name", self::$username, self::$password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            //  echo "Connected successfully (connection.php)";

            } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            }
        
            return $conn;
    }

    public static function connectArray() {
        $servername =self::$servername;
        $db_name = self::$db_name;
       
        $conn = new PDO("mysql:host=$servername;dbname=$db_name", self::$username, self::$password, 
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`"));
            
       return $conn;
   }

}


