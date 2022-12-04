<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/VentaPedido.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $venta_pedido = new VentaPedido($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  $venta_pedido->v_clave = $data->v_clave;
  $venta_pedido->pe_clave = $data->pe_clave;

  // Añadir nuevos articulos
  // if($venta_pedido->create()) {
  //   echo json_encode(
  //     array('message' => 'Venta realizada')
  //   );
  // } else {
  //   echo json_encode(
  //     array('message' => 'Venta no realizada')
  //   );
  // }

  try {
    /* Código de inserción */
    // Añadir nuevos articulos
    if ($venta_pedido->create()) {
  
      //Nuevos cambios respuesta servidor
      $success = true;
      $message = "Se ha insertado exitosamente";
  
  
      echo json_encode(
        array('success' => $success, 'message' => $message, 'data' => $data)
      );
    } else {
      echo json_encode(
        array('success' => false, 'message' => 'Error al insertar')
      );
    }
  } catch (PDOException $e) {
    echo json_encode(
      array('success' => false, 'message' => 'Error al insertar')
    );
  }
