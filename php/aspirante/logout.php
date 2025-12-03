<?php
session_start();
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

// Destruir la sesión
session_unset();
session_destroy();

echo json_encode(['status' => 'success', 'message' => 'Sesión cerrada exitosamente']);
?>