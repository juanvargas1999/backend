<?php
session_start();
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    echo json_encode([
        'status' => 'success',
        'usuario' => [
            'id' => $_SESSION['usuario_id'],
            'nombre' => $_SESSION['nombre_usuario'],
            'correo' => $_SESSION['correo']
            // No incluir 'tipo' ya que no existe en la sesión
        ]
    ]);
} else {
    http_response_code(401);
    echo json_encode(['status' => 'error', 'message' => 'No autenticado']);
}
?>