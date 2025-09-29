<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Incluir archivo de conexión
include '../conex/conexion.php';


if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

$input = json_decode(file_get_contents('php://input'), true);

if (!isset($input['id_usuario']) || !isset($input['nombre_usuario']) || !isset($input['correo_electronico'])) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Datos incompletos']);
    exit();
}

$id_usuario = $input['id_usuario'];
$nombre_usuario = trim($input['nombre_usuario']);
$correo_electronico = trim($input['correo_electronico']);

// Validaciones
if (empty($nombre_usuario) || empty($correo_electronico)) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Todos los campos son obligatorios']);
    exit();
}

if (!filter_var($correo_electronico, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Correo electrónico no válido']);
    exit();
}

try {
    // Verificar si el correo ya existe en otro usuario
    $stmt = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE correo_electronico = ? AND id_usuario != ?");
    $stmt->execute([$correo_electronico, $id_usuario]);
    
    if ($stmt->rowCount() > 0) {
        http_response_code(409);
        echo json_encode(['status' => 'error', 'message' => 'El correo electrónico ya está en uso']);
        exit();
    }

    // Actualizar el usuario
    $stmt = $pdo->prepare("UPDATE usuarios SET nombre_usuario = ?, correo_electronico = ? WHERE id_usuario = ?");
    $stmt->execute([$nombre_usuario, $correo_electronico, $id_usuario]);

    if ($stmt->rowCount() > 0) {
        echo json_encode([
            'status' => 'success', 
            'message' => 'Aspirante actualizado exitosamente'
        ]);
    } else {
        echo json_encode([
            'status' => 'success', 
            'message' => 'No se realizaron cambios'
        ]);
    }

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Error en la base de datos: ' . $e->getMessage()]);
}
?>