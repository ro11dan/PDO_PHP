<?php
// 1.- Conectar a la base de datos
require_once __DIR__ . '/../config/db.php';
// 2.- Obtener el ID del producto a eliminar
$id = (int)($_GET['id'] ?? 0);
if ($id <= 0) {
    die('ID de producto no válido.');
}else{
    //Eliminar con una consulta preparada para evitar inyección SQL
    $sql = "DELETE FROM alumnos WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'id' => $id
        ]);
    // Redireccionar a la pagina principal despues de eliminar el alumno
    header("Location: index.php");
    exit();

} 
