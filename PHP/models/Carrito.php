<?php 
  class Carrito {
    // DB stuff
    private $conn;
    private $table = 'carrito_compras';

    // Materias Properties
    public $u_clave;
    public $p_clave;
    public $p_cantidad;


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

    public function read_single(){
      //Create query
      $query = 'SELECT * FROM `carrito_compras` WHERE u_clave = ?;';

      //Prepare statement
      $stmt = $this->conn->prepare($query);

      //Bind u_clave
      $stmt->bindParam(1, $this->u_clave);

      //Execute query
      $stmt->execute();

      return $stmt;

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      //Set properties
      $this->u_clave = $row['u_clave'];
      $this->p_clave = $row['p_clave'];
      $this->p_cantidad = $row['p_cantidad'];
      
    }

    // Create Post
    public function create() {
          // Create query
          $query = 'INSERT INTO ' . $this->table . ' SET u_clave = :u_clave, p_clave = :p_clave, p_cantidad = :p_cantidad';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->u_clave = htmlspecialchars(strip_tags($this->u_clave));
          $this->p_clave = htmlspecialchars(strip_tags($this->p_clave));
          $this->p_cantidad  = htmlspecialchars(strip_tags($this->p_cantidad ));
          

          // Bind data
          $stmt->bindParam(':u_clave', $this->u_clave );
          $stmt->bindParam(':p_clave', $this->p_clave);
          $stmt->bindParam(':p_cantidad', $this->p_cantidad);

          // Execute query
          if($stmt->execute()) {
            return true;
          }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
    }

    // Update Post
    public function update() {
          // Create query
          $query = 'UPDATE ' . $this->table . '
                                SET p_cantidad = :p_cantidad
                                WHERE u_clave = :u_clave AND p_clave = :p_clave';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->p_cantidad = htmlspecialchars(strip_tags($this->p_cantidad));
          //Llaves
          $this->u_clave = htmlspecialchars(strip_tags($this->u_clave));
          $this->p_clave = htmlspecialchars(strip_tags($this->p_clave));

          // Bind data
          $stmt->bindParam(':p_cantidad', $this->p_cantidad);
          $stmt->bindParam(':u_clave', $this->u_clave );
          $stmt->bindParam(':p_clave', $this->p_clave);
          

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
          $query = 'DELETE FROM ' . $this->table . ' WHERE u_clave = :u_clave AND p_clave = :p_clave';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->u_clave = htmlspecialchars(strip_tags($this->u_clave));
          $this->p_clave = htmlspecialchars(strip_tags($this->p_clave));

          // Bind data
          $stmt->bindParam(':u_clave', $this->u_clave);
          $stmt->bindParam(':p_clave', $this->p_clave);
        

          // Execute query
          if($stmt->execute()) {
            return true;
          }

          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);

          return false;
    }
    
  }