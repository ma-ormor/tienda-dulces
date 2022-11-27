<?php 
  class VentaPedido {
    // DB stuff
    private $conn;
    private $table = 'venta_pedido';

    // Materias Properties
    public $v_clave;
    public $pe_clave;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get Materias
    public function read() {
      // Create query
      $query = 'SELECT *  FROM ' . $this->table;
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Create Post
    public function create() {
          // Create query
          $query = 'INSERT INTO ' . $this->table . ' SET v_clave = :v_clave, pe_clave = :pe_clave';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->v_clave = htmlspecialchars(strip_tags($this->v_clave));
          $this->pe_clave = htmlspecialchars(strip_tags($this->pe_clave));
      
          

          // Bind data
          $stmt->bindParam(':v_clave', $this->v_clave );
          $stmt->bindParam(':pe_clave', $this->pe_clave);


          // Execute query
          if($stmt->execute()) {
            return true;
          }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
    }

    

    // Delete Post
    public function delete() {
          // Create query
          $query = 'DELETE FROM ' . $this->table . ' WHERE v_clave = :v_clave AND pe_clave = :pe_clave';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->v_clave = htmlspecialchars(strip_tags($this->v_clave));
          $this->pe_clave = htmlspecialchars(strip_tags($this->pe_clave));

          // Bind data
          $stmt->bindParam(':v_clave', $this->v_clave);
          $stmt->bindParam(':pe_clave', $this->pe_clave);
        

          // Execute query
          if($stmt->execute()) {
            return true;
          }

          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);

          return false;
    }
    
  }