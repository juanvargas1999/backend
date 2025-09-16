
<?php
//EN CASO DE REQUERIR ACCESO DESDE UN FRONTEND EXTERNO EN UN DOMINIO DISTINTO O SERVIDOR DISTINTO
//DESCOMENTAR LO DE ABAJO

/*header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
*/

// Configuración de la base de datos
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
    
    // Si llegamos aquí, la conexión es exitosa - SOLO UN echo
    echo json_encode([
        'status' => 'success',
        'message' => 'Conexión exitosa a la base de datos',
        'timestamp' => date('Y-m-d H:i:s')
    ]);
    exit(); // Añadir exit() para asegurar que no se ejecute más código
    
} catch (PDOException $e) {
    // Error en la conexión
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => 'Error de conexión: ' . $e->getMessage(),
        'timestamp' => date('Y-m-d H:i:s')
    ]);
    exit(); // Añadir exit() aquí también
}
?>