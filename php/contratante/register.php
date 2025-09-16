<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Incluir archivo de conexión
include '../conex/conexion.php';

// Verificar si es una solicitud OPTIONS (preflight)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Verificar que sea POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Método no permitido']);
    exit();
}

// Obtener y decodificar los datos JSON
$input = json_decode(file_get_contents('php://input'), true);

// Validar datos
if (!isset($input['nombre_usuario']) || !isset($input['correo_electronico']) || !isset($input['contrasena'])) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Datos incompletos']);
    exit();
}

$nombre_usuario = trim($input['nombre_usuario']);
$correo_electronico = trim($input['correo_electronico']);
$contrasena = $input['contrasena'];

// Validaciones básicas
if (empty($nombre_usuario) || empty($correo_electronico) || empty($contrasena)) {
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
    // Verificar si el usuario ya existe
    $stmt = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE nombre_usuario = ? OR correo_electronico = ?");
    $stmt->execute([$nombre_usuario, $correo_electronico]);
    
    if ($stmt->rowCount() > 0) {
        http_response_code(409);
        echo json_encode(['status' => 'error', 'message' => 'El usuario o correo electrónico ya existe']);
        exit();
    }

    // Encriptar contraseña
    $contrasena_hash = password_hash($contrasena, PASSWORD_DEFAULT);

    // Insertar nuevo usuario
    $stmt = $pdo->prepare("INSERT INTO usuarios (nombre_usuario, correo_electronico, contrasena, fecha_registro) 
                          VALUES (?, ?, ?, NOW())");
    $stmt->execute([$nombre_usuario, $correo_electronico, $contrasena_hash]);

    if ($stmt->rowCount() > 0) {
        echo json_encode([
            'status' => 'success', 
            'message' => 'Usuario registrado exitosamente',
            'id_usuario' => $pdo->lastInsertId()
        ]);
    } else {
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => 'Error al registrar usuario']);
    }

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Error en la base de datos: ' . $e->getMessage()]);
}
?>