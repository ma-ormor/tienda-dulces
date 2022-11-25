<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Carrito.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog post object
$carrito_compras = new Carrito($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

$carrito_compras->u_clave = $data->u_clave; //llave primaria
$carrito_compras->p_clave = $data->p_clave; //llave primaria
$carrito_compras->p_cantidad = $data->p_cantidad;

try {
  /* Código de inserción */
  // Añadir nuevos articulos
  if ($carrito_compras->create()) {

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
