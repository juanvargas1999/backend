<?php
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
    
    // NO hacer echo aquí - solo establecer la conexión
    // De lo contrario se ejecutrala una accion aqui que interferira con la lectura en 
    // el frontend
    
} catch (PDOException $e) {
    // Error en la conexión
    error_log("Error de conexión a la base de datos: " . $e->getMessage());
    throw new Exception("Error de conexión a la base de datos: " . $e->getMessage());
}
?>