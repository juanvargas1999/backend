<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Incluir archivo de conexión
include '../conex/conexion.php';

// Verificar si es una solicitud OPTIONS (preflight)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

try {
    // Consultar todos los usuarios/aspirantes
    $stmt = $pdo->query("SELECT id_usuario, nombre_usuario, correo_electronico, fecha_registro FROM usuarios ORDER BY fecha_registro DESC");
    $aspirantes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode([
        'status' => 'success',
        'aspirantes' => $aspirantes
    ]);
    
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => 'Error al cargar aspirantes: ' . $e->getMessage()
    ]);
}
?>