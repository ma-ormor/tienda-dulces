<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
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

  // Set u_clave and p_clave to delete
  $venta_pedido->v_clave = $data->v_clave; //llave primaria
  $venta_pedido->pe_clave = $data->pe_clave; //llave primaria
  
  // $carrito_compras->p_cantidad = $data->p_cantidad;

  // // Delete post
  // if($venta_pedido->delete()) {
  //   echo json_encode(
  //     array('message' => 'Pedido borrado.')
  //   );
  // } else {
  //   echo json_encode(
  //     array('message' => 'El pedido no se pudo borrar.')
  //   );
  // }

  // Delete carrito
  try {
    /* Código de eliminación */
    // Eliminar articulos
    if ($venta_pedido->delete()) {
  
      //Nuevos cambios respuesta servidor
      $success = true;
      $message = "Se ha eliminado exitosamente";
  
      echo json_encode(
        array('success' => $success, 'message' => $message, 'data' => $data)
      );
    } else {
      echo json_encode(
        array('success' => false, 'message' => 'Error al eliminar')
      );
    }
  } catch (PDOException $e) {
    echo json_encode(
      array('success' => false, 'message' => 'Error al eliminar')
    );
  }


