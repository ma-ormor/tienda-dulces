<?php 
  class Database {
    private $host;
    private $db_name = 'tienda_dulces';
    private $username = 'root';
    private $password;
    private $conn;

    function __construct(){
      if(!isset($_ENV['DB_HOST']))
        $this->host = 'localhost:3306';
      else $this->host = $_ENV['DB_HOST'].':3306';

      if(!isset($_ENV['DB_PASSWORD'])) 
        $this->password = '';
      else $this->password = $_ENV['DB_PASSWORD'];
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