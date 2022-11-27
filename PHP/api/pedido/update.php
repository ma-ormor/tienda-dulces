<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Pedido.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $pedido = new Pedido($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Set u_clave and p_clave to update
  $pedido->pe_clave = $data->pe_clave; //llave primaria
  
  $pedido->pe_fecha_env = $data->pe_fecha_env;
  $pedido->pe_fecha_ent = $data->pe_fecha_ent;
  $pedido->pe_direccion = $data->pe_direccion;
  $pedido->pe_estado = $data->pe_estado;
  
  // Update post
  try {
    /* Código de actualizacion */
    // actualizar articulos
    if ($pedido->update()) {
  
      //Nuevos cambios respuesta servidor
      $success = true;
      $message = "Se ha actualizado exitosamente";
  
  
      echo json_encode(
        array('success' => $success, 'message' => $message, 'data' => $data)
      );
    } else {
      echo json_encode(
        array('success' => false, 'message' => 'Error al actualizar')
      );
    }
  } catch (PDOException $e) {
    echo json_encode(
      array('success' => false, 'message' => 'Error al actualizar')
    );
  }

