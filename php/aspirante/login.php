<?php
session_start();
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
if (!isset($input['nombre_usuario']) || !isset($input['contrasena'])) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Datos incompletos']);
    exit();
}

$nombre_usuario = trim($input['nombre_usuario']);
$contrasena = $input['contrasena'];

// Validaciones básicas
if (empty($nombre_usuario) || empty($contrasena)) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Usuario y contraseña son obligatorios']);
    exit();
}

try {
    // CORRECCIÓN: Solo seleccionar las columnas que existen
    $stmt = $pdo->prepare("SELECT id_usuario, nombre_usuario, correo_electronico, contrasena 
                          FROM usuarios WHERE nombre_usuario = ? OR correo_electronico = ?");
    $stmt->execute([$nombre_usuario, $nombre_usuario]);
    
    if ($stmt->rowCount() === 0) {
        http_response_code(401);
        echo json_encode(['status' => 'error', 'message' => 'Usuario o contraseña incorrectos']);
        exit();
    }

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verificar contraseña - IMPORTANTE: usar password_verify
    if (!password_verify($contrasena, $usuario['contrasena'])) {
        http_response_code(401);
        echo json_encode(['status' => 'error', 'message' => 'Usuario o contraseña incorrectos']);
        exit();
    }

    // Crear sesión
    $_SESSION['usuario_id'] = $usuario['id_usuario'];
    $_SESSION['nombre_usuario'] = $usuario['nombre_usuario'];
    $_SESSION['correo'] = $usuario['correo_electronico'];
    $_SESSION['logged_in'] = true;

    echo json_encode([
        'status' => 'success', 
        'message' => 'Login exitoso',
        'usuario' => [
            'id' => $usuario['id_usuario'],
            'nombre' => $usuario['nombre_usuario'],
            'correo' => $usuario['correo_electronico']
            // No incluir 'tipo' ya que no existe
        ]
    ]);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Error en la base de datos: ' . $e->getMessage()]);
}
?>