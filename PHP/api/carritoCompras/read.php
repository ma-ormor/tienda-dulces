<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Carrito.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog Carrito object
  $carrito_compras = new Carrito($db);

  // Blog post query
  $result = $carrito_compras->read();
  // Get row count
  $num = $result->rowCount();

  // Check if any articulos
  if($num > 0) {
   
    //Nuevos cambios respuesta servidor
    $success = true;
    $message = "Se ha obtenido exitosamente";
    $data = array();

     // carrito_compras array
    $carrito_compras_arr = array();
    // $posts_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $carrito_compras_item = array(
        'u_clave' => $u_clave,
        'p_clave' => $p_clave,
        'p_cantidad' => $p_cantidad
      );

      // Push to "data"
      array_push($carrito_compras_arr, $carrito_compras_item);
      // array_push($posts_arr['data'], $post_item);
      array_push($data, $carrito_compras_item);
    }

    // Turn to JSON & output
    //Nuevo formato
    $arr = array('success' => $success, 'message' => $message, 'data' => $data);
    echo json_encode($arr);
    
    // echo json_encode($carrito_compras_arr);
  

  } else {
    // Estado error, no hay articulos
    echo json_encode(
      array('success' => false, 'message' => 'No ha añadido articulos')
    );
  }
