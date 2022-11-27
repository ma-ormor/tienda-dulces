<?php 
  class Pedido {
    // DB stuff
    private $conn;
    private $table = 'pedido';

    // Materias Properties
    public $pe_clave;
    public $pe_fecha_env;
    public $pe_fecha_ent;
    public $pe_direccion;
    public $pe_estado;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get Pedido
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
          $query = 'INSERT INTO ' . $this->table . ' SET pe_clave = :pe_clave, pe_fecha_env = :pe_fecha_env, pe_fecha_ent = :pe_fecha_ent, pe_direccion = :pe_direccion, pe_estado = :pe_estado';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->pe_clave = htmlspecialchars(strip_tags($this->pe_clave));
          $this->pe_fecha_env = htmlspecialchars(strip_tags($this->pe_fecha_env));
          $this->pe_fecha_ent  = htmlspecialchars(strip_tags($this->pe_fecha_ent ));
          $this->pe_direccion  = htmlspecialchars(strip_tags($this->pe_direccion ));
          $this->pe_estado  = htmlspecialchars(strip_tags($this->pe_estado ));
         
          // Bind data
          $stmt->bindParam(':pe_clave', $this->pe_clave );
          $stmt->bindParam(':pe_fecha_env', $this->pe_fecha_env);
          $stmt->bindParam(':pe_fecha_ent', $this->pe_fecha_ent);
          $stmt->bindParam(':pe_direccion', $this->pe_direccion);
          $stmt->bindParam(':pe_estado', $this->pe_estado);

          // Execute query
          if($stmt->execute()) {
            return true;
          }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
    }

    // Update Pedido
    public function update() {
          // Create query
          $query = 'UPDATE ' . $this->table . '
                                SET pe_fecha_env = :pe_fecha_env, pe_fecha_ent = :pe_fecha_ent, pe_direccion = :pe_direccion, pe_estado = :pe_estado 
                                WHERE pe_clave = :pe_clave';

          // Prepare statement
          $stmt = $this->conn->prepare($query);
          
          // Clean data
          $this->pe_fecha_env = htmlspecialchars(strip_tags($this->pe_fecha_env));
          $this->pe_fecha_ent = htmlspecialchars(strip_tags($this->pe_fecha_ent));
          $this->pe_direccion = htmlspecialchars(strip_tags($this->pe_direccion));
          $this->pe_estado = htmlspecialchars(strip_tags($this->pe_estado));
          //Llaves
          $this->pe_clave = htmlspecialchars(strip_tags($this->pe_clave));

          // Bind data
          $stmt->bindParam(':pe_fecha_env', $this->pe_fecha_env);
          $stmt->bindParam(':pe_fecha_ent', $this->pe_fecha_ent );
          $stmt->bindParam(':pe_direccion', $this->pe_direccion);
          $stmt->bindParam(':pe_estado', $this->pe_estado);
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
          $query = 'DELETE FROM ' . $this->table . ' WHERE pe_clave = :pe_clave';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->pe_clave = htmlspecialchars(strip_tags($this->pe_clave));

          // Bind data
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