<?php
require_once __DIR__ . '/../config/db.php';
// Variables para mostrar los errores y para rellenar los campos del formulario
$error = "";// Variables para mostrar los errores y para rellenar los campos del formulario
$nombre_dueno = ""; // Variable para el nombre del dueño
$email = "";// Variable para el correo electronico del dueño
$nombre_mascota = ""; // Variable para el nombre de la mascota
$tipo_mascota = ""; // Variable para el tipo de mascota
$fecha_cita = ""; // Variable para la fecha de la cita
$hora_cita = ""; // Variable para la hora de la cita
$motivo_cita = ""; // Variable para el motivo de la cita
$numero_telefono = ""; // Variable para el número de teléfono del dueño

//si el formulario se ha enviado (POST)
if( $_SERVER['REQUEST_METHOD'] == 'POST'){
    // 1.- Obtener los datos del formulario
    $nombre_dueno = trim($_POST['nombre_dueno'] ?? "");
    $email = trim($_POST['email'] ?? "");
    $nombre_mascota = trim($_POST['nombre_mascota'] ?? "");
    $tipo_mascota = trim($_POST['tipo_mascota'] ?? "");
    $fecha_cita = trim($_POST['fecha_cita'] ?? "");
    $hora_cita = trim($_POST['hora_cita'] ?? "");
    $motivo_cita = trim($_POST['motivo_cita'] ?? "");
    $numero_telefono = trim($_POST['numero_telefono'] ?? "");

    // 2.- Validaciones basicas
    if($nombre_dueno == "" || $email == "" || $nombre_mascota == "" || $tipo_mascota == "" || $fecha_cita == "" || $hora_cita == "" || $motivo_cita == "" || $numero_telefono == ""){
        $error = "Todos los campos son obligatorios";
    }else if( !filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error = "El correo electronico no es valido";
    }else{
        try{
                    // 3.- Insertar los datos en la base de datos (Seguros contra inyeccion SQL)
            $sql = "INSERT INTO citas (nombre_dueno, email, nombre_mascota, tipo_mascota, fecha_cita, hora_cita, motivo_cita, numero_telefono) VALUES (:nombre_dueno, :email, :nombre_mascota, :tipo_mascota, :fecha_cita, :hora_cita, :motivo_cita, :numero_telefono)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'nombre_dueno' => $nombre_dueno,
                'email' => $email,
                'nombre_mascota' => $nombre_mascota,
                'tipo_mascota' => $tipo_mascota,
                'fecha_cita' => $fecha_cita,
                'hora_cita' => $hora_cita,
                'motivo_cita' => $motivo_cita,
                'numero_telefono' => $numero_telefono
            ]);
                ]);
            // Redireccionar a la pagina principal despues de insertar el dueno
            header("Location: index.php");
            exit();

        }catch(PDOException $e){
            $error = "Error al insertar el dueno: " . $e->getMessage();

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
    <title>Crear citas</title>
</head>
<body>
    <h1>Crear cita</h1>
    <p><a href="index.php">&lt; Volver</a></p>
    <?php if($error): ?>
        <p style="color:red;"><?=  htmlspecialchars($error)?></p>
    <?php endif; ?>
    <form method="post">
        <label for="nombre_dueno">Nombre del dueño:</label>
        <input type="text" name="nombre_dueno" required id="nombre_dueno" value="<?= htmlspecialchars($nombre_dueno)?>">
        <br>
        <label for="email">Correo electrónico:</label>
        <input type="email" name="email" required id="email" value="<?= htmlspecialchars($email)?>">
        <br>
        <label for="nombre_mascota">Nombre de la mascota:</label>
        <input type="text" name="nombre_mascota" required id="nombre_mascota" value="<?= htmlspecialchars($nombre_mascota)?>">
        <br>
        <label for="tipo_mascota">Tipo de mascota:</label>
        <input type="text" name="tipo_mascota" required id="tipo_mascota" value="<?= htmlspecialchars($tipo_mascota)?>">
        <br>
        <label for="fecha_cita">Fecha de la cita:</label>
        <input type="date" name="fecha_cita" required id="fecha_cita" value="<?= htmlspecialchars($fecha_cita)?>">
        <br>
        <label for="hora_cita">Hora de la cita:</label>
        <input type="time" name="hora_cita" required id="hora_cita" value="<?= htmlspecialchars($hora_cita)?>">
        <br>
        <label for="motivo_cita">Motivo de la cita:</label>
        <textarea name="motivo_cita" required id="motivo_cita"><?= htmlspecialchars($motivo_cita)?></textarea>
        <br>
        <label for="numero_telefono">Número de teléfono:</label>
        <input type="tel" name="numero_telefono" required id="numero_telefono" value="<?= htmlspecialchars($numero_telefono)?>">
        <br>
        <button type="submit">Crear</button>

    </form>
</body>
</html>
