<?php
// uso de base de datos importacion
require_once  __DIR__ . '/../config/db.php';
 $error = "";
//  1,- tomar el ID desde la URL
$id = (int)($_GET['id'] ?? 0);
// 2.- validar que el ID es valido
if($id <= 0){
    header('Location: index.php');
    exit;
}

// 3.- obtener el registro de la base de datos
$sql = "SELECT id, nombre, email FROM alumnos WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute([':id' => $id]);
$alumno = $stmt->fetch();
// buscar el registro id del alumno
if(!$alumno){
    echo ' <br> <p style="color:red;">Registro no encontrado.</p> <br>';
    die(' Registro no encontrado.');
}
// Enviar al furmulario los datos del alumno para actualizar

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nombre = trim($_POST['nombre'] ?? '');
    $email = trim($_POST['email'] ?? '');
        // if($nombre === "" ||$email === "")
    if(!$nombre || !$email){
        $error = "Todos los campos son obligatorios";
    }else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error = "El email no es valido";
    }else{
        try{
        // actualizar el registro en la base de datos
        $sql = "UPDATE alumnos SET nombre = :nombre, email = :email WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nombre' => $nombre,
            ':email' => $email,
            ':id' => $id
        ]);
        // redireccionar a la lista de registros
        header('Location: index.php');
        exit;
        }catch(PDOException $e){
            $error = "Error al actualizar el registro: " . $e->getMessage();
        }
    }
}else{
    $nombre = $alumno['nombre'];
    $email = $alumno['email'];

}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar registro</title>
</head>
<body>
    <h1>Editar registro</h1>
    <p><a href="index.php"><-Volver a la lista</a></p>
    <br>
    <?php if($error):?>
        <p style="color:red;"><?=  htmlspecialchars($error)?></p>
    <?php endif; ?>
    <form method="post">
        <label for="">Nombre</label>
        <input type="text" name="nombre" required value="<?= htmlspecialchars($nombre) ?>">
        <br>
        <label for="">Correo electronico</label>
        <input type="email" name="email" required value="<?= htmlspecialchars($email) ?>">
        <br>
        <button type="submit">Actualizar</button>
    </form>
    
</body>
</html>
