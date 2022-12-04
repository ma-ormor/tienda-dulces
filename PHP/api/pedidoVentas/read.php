<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/VentaPedido.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog Carrito object
  $venta_pedido = new VentaPedido($db);

  // Blog post query
  $result = $venta_pedido->read();
  // Get row count
  $num = $result->rowCount();

  // Check if any articulos
  if($num > 0) {

     //Nuevos cambios respuesta servidor
     $success = true;
     $message = "Se ha obtenido exitosamente";
     $data = array();
 
    // carrito_compras array
    $venta_pedido_arr = array();
    // $posts_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $venta_pedido_item = array(
        'v_clave' => $v_clave,
        'pe_clave' => $pe_clave
      );

      // Push to "data"
      array_push($venta_pedido_arr, $venta_pedido_item);
      // array_push($posts_arr['data'], $post_item);
       array_push($data, $venta_pedido_item);
    }

    // Turn to JSON & output
    $arr = array('success' => $success, 'message' => $message, 'data' => $data);
    echo json_encode($arr);

  } else {
    // No articulos
    echo json_encode(
      array('success' => false, 'message' => 'No ha añadido articulos')
    );
  }
