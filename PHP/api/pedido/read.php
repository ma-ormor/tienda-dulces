<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Pedido.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog Carrito object
  $pedido = new Pedido($db);

  // Blog post query
  $result = $pedido->read();
  // Get row count
  $num = $result->rowCount();

  // Check if any articulos
  if($num > 0) {

    // carrito_compras array
    $success = true;
    $message = "Se ha obtenido exitosamente";
    $data = array();
    // $posts_arr['data'] = array();
    $pedido_arr = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $pedido_item = array(
        'pe_clave' => $pe_clave,
        'pe_fecha_env' => $pe_fecha_env,
        'pe_fecha_ent' => $pe_fecha_ent,
        'pe_direccion' => $pe_direccion,
        'pe_estado' => $pe_estado
      );

      // Push to "data"
      array_push($pedido_arr, $pedido_item);
      // array_push($posts_arr['data'], $post_item);
      array_push($data, $pedido_item);
    }

    // Turn to JSON & output
    $arr = array('success' => $success, 'message' => $message, 'data' => $data);
    echo json_encode($arr);

  } else {
    // No articulos
    echo json_encode(
      array('success' => false, 'message' => 'No hay pedidos')
    );
  }
