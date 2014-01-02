<?php
class DatabaseConnection {
    //put your code here
    private static $instance;
    // the actual connection resource
    private $conn;
    // the hostname for the database server
    private $hostname;
    // the name of the database to use
    private $database;
	public $database_name;
    // the username to use to access the database
    private $username;
    // the password to use to access the database
    private $password;
    function __construct(){
	/*	$this->database = "db_fudgedelic";
		$this->database_name = "db_fudgedelic";
		$this->hostname = "localhost";
		$this->username = "qualia_fudge";
		$this->password = "fudgedelic";
    }*/
	//if($_SERVER['HTTP_HOST']=='localhost'){
		$this->database = "midnight";
		$this->database_name = "midnight";
		$this->hostname = "localhost";
		$this->username = "midnight";
		$this->password = "midnight";
	//}
    }
    function serverConnection(){
        if (is_null($this->database))
        die("MySQL database not selected");
        if (is_null($this->hostname))
        die("MySQL hostname not set");
        $this->conn = @mysql_connect($this->hostname, $this->username, $this->password);
        if ($this->conn === false)
        	die("Could not connect to database. Check your username and password then try again.\n");
        if (!mysql_select_db($this->database, $this->conn)) {
            die("Could not select database");
        }
    }
	function close_connection(){
	   mysql_close($this->conn);
    }
}
$db =new DatabaseConnection;
$db->serverConnection();
?>