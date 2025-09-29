<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Incluir archivo de conexión
include '../conex/conexion.php';


if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Para DELETE requests, leer el input
$input = json_decode(file_get_contents('php://input'), true);

if (!isset($input['id_usuario'])) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'ID de usuario no proporcionado']);
    exit();
}

$id_usuario = $input['id_usuario'];

try {
    // Eliminar el usuario
    $stmt = $pdo->prepare("DELETE FROM usuarios WHERE id_usuario = ?");
    $stmt->execute([$id_usuario]);

    if ($stmt->rowCount() > 0) {
        echo json_encode([
            'status' => 'success', 
            'message' => 'Aspirante eliminado exitosamente'
        ]);
    } else {
        http_response_code(404);
        echo json_encode(['status' => 'error', 'message' => 'Aspirante no encontrado']);
    }

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Error en la base de datos: ' . $e->getMessage()]);
}
?>