<?php
// cargar la configuracion de la base de datos

$config = require __DIR__ . "/config.php";

// Estraer las variables de configuracion de la base de datos
$host = $config["DB_HOST"];
$port = $config["DB_PORT"];
$db = $config["DB_NAME"];
$user = $config["DB_USER"];
$password = $config["DB_PASSWORD"];
$charset = $config["DB_CHARSET"];

// opciones recomendadas para PDO
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // lanzar excepciones en caso de error
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // devolver los resultados como un array asociativo
    PDO::ATTR_EMULATE_PREPARES => false, // desactivar la emulacion de consultas preparadas
];


try{
    // El DSN indica el motor + host + puerto + nombre + charset
    $dns = "mysql:host=$host;port=$port;dbname=$db;charset=$charset";
    // Crear una nueva instancia de PDO
    $pdo = new PDO($dns, $user, $password, $options);

}catch(PDOException $e){
    // Si hay un error al conectar a la base de datos, mostrar el mensaje de error
    die("Error al conectar a la base de datos: " . $e->getMessage());
}
