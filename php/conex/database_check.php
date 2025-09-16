<?php


// Configuración de la base de datos --- INSTRUCTOR AQUI DEJÉ LOS DATOS DE CONEXION A MI BASE
// PONGA LOS DE SU USUARIO DE PREFERENCIA

$host = 'localhost';
$dbname = 'jeft_j';
$username = 'local';
$password = '123456';

try {
    
    // Crear conexión PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    
    // Configurar PDO para que lance excepciones en errores
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Ejecutar una consulta simple para verificar la conexión
    $stmt = $pdo->query("SELECT 1 as connection_test");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Si llegamos aquí, la conexión es exitosa
    echo json_encode([
        'status' => 'success',
        'message' => 'Conexión exitosa a la base de datos',
        'timestamp' => date('Y-m-d H:i:s')
    ]);
    
} catch (PDOException $e) {
    // Error en la conexión
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => 'Error de conexión: ' . $e->getMessage(),
        'timestamp' => date('Y-m-d H:i:s')
    ]);
}
?>