<?php
require_once __DIR__ . '/../config/db.php';
// Variables para mostrar los errores y para rellenar los campos del formulario
$error = "";// Variables para mostrar los errores y para rellenar los campos del formulario
$nombre = ""; // Variable para el nombre del alumno
$email = "";// Variable para el correo electronico del alumno

//si el formulario se ha enviado (POST)
if( $_SERVER['REQUEST_METHOD'] == 'POST'){
    // 1.- Obtener los datos del formulario
    $nombre = trim($_POST['nombre'] ?? "");
    $email = trim($_POST['email'] ?? "");

    // 2.- Validaciones basicas
    if($nombre == "" || $email == ""){
        $error = "Todos los campos son obligatorios";
    }else if( !filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error = "El correo electronico no es valido";
    }else{
        try{
                    // 3.- Insertar los datos en la base de datos (Seguros contra inyeccion SQL)
            $sql = "INSERT INTO alumnos (nombre, email) VALUES (:nombre, :email)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'nombre' => $nombre, 
                'email' => $email
                ]);
            // Redireccionar a la pagina principal despues de insertar el alumno
            header("Location: index.php");
            exit();

        }catch(PDOException $e){
            $error = "Error al insertar el alumno: " . $e->getMessage();

        }

    }

}else{

}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear alumno</title>
</head>
<body>
    <h1>Crear alumno</h1>
    <p><a href="index.php">&lt; Volver</a></p>
    <?php if($error): ?>
        <p style="color:red;"><?=  htmlspecialchars($error)?></p>
    <?php endif; ?>
    <form method="post">
        <label for="">Nombre:</label>
        <input type="text" name="nombre" required id="" value="<?= htmlspecialchars($nombre)?>">
        <br>
        <label for="">Correo electronico:</label>
        <input type="email" name="email" required id="" value="<?= htmlspecialchars($email)?>">
        <br>
        <button type="submit">Crear</button>

    </form>
</body>
</html>
