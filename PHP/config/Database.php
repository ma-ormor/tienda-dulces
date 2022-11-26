<?php 
  class Database {
    // DB Params
    private $host;
    private $db_name = 'tienda_dulces';
    private $username = 'root';
    private $password;
    private $conn;

    function __construct(){
      if(($this->host = getenv("HOST")) !== false) 
        $this->host = 'localhost';
      if(($this->password = getenv("DB_PASS")) !== false) 
        $this->password = '';
    }

    // DB Connect
    public function connect() {
      $this->conn = null;

      try { 
        $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch(PDOException $e) {
        echo 'Connection Error: ' . $e->getMessage();
      }

      return $this->conn;
    }
  }
