<?php
class Database{
  
    // specify your own database credentials
    private $host = "localhost";
    private $port = "5432";
    private $db_name = "EBilly";
    private $username = "postgres";
    private $password = "WelKom7993";
    public $conn;
  
    // get the database connection
    public function getConnection(){
  
        $this->conn = null;
  
        try{
            $this->conn = new PDO("pgsql: host=" . $this->host . "; port=" . $this->port . " dbname=" . $this->db_name . " user=" . $this->username . " password=" . $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
  
        return $this->conn;
    }
}
?>