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
$sql = "SELECT id, nombre_dueno, email, nombre_mascota, tipo_mascota, fecha_cita, hora_cita, motivo_cita, numero_telefono FROM citas WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute([':id' => $id]);
$cita = $stmt->fetch();
// buscar el registro id de la cita
if(!$cita){
    echo ' <br> <p style="color:red;">Registro no encontrado.</p> <br>';
    die(' Registro no encontrado.');
}
// Enviar al furmulario los datos de la cita para actualizar

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nombre_dueno = trim($_POST['nombre_dueno'] ?? '');
    $email = trim($_POST['email'] ?? '');
        // if($nombre === "" ||$email === "")
    if(!$nombre_dueno || !$email){
        $error = "Todos los campos son obligatorios";
    }else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error = "El email no es valido";
    }else{
        try{
        // actualizar el registro en la base de datos
        $sql = "UPDATE citas SET nombre_dueno = :nombre_dueno, email = :email, nombre_mascota = :nombre_mascota, tipo_mascota = :tipo_mascota, fecha_cita = :fecha_cita, hora_cita = :hora_cita, motivo_cita = :motivo_cita, numero_telefono = :numero_telefono WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nombre_dueno' => $nombre_dueno,
            ':email' => $email,
            ':nombre_mascota' => $nombre_mascota,
            ':tipo_mascota' => $tipo_mascota,
            ':fecha_cita' => $fecha_cita,
            ':hora_cita' => $hora_cita,
            ':motivo_cita' => $motivo_cita,
            ':numero_telefono' => $numero_telefono,
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
    $nombre_dueno = $cita['nombre_dueno'];
    $email = $cita['email'];
    $nombre_mascota = $cita['nombre_mascota'];
    $tipo_mascota = $cita['tipo_mascota'];
    $fecha_cita = $cita['fecha_cita'];
    $hora_cita = $cita['hora_cita'];
    $motivo_cita = $cita['motivo_cita'];
    $numero_telefono = $cita['numero_telefono'];

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
        <label for="nombre_dueno">Nombre del dueño</label>
        <input type="text" name="nombre_dueno" required value="<?= htmlspecialchars($nombre_dueno) ?>">
        <br>
        <label for="email">Correo electronico</label>
        <input type="email" name="email" required value="<?= htmlspecialchars($email) ?>">
        <br>
        <label for="nombre_mascota">Nombre de la mascota</label>
        <input type="text" name="nombre_mascota" value="<?= htmlspecialchars($nombre_mascota) ?>">
        <br>
        <label for="tipo_mascota">Tipo de mascota</label>
        <input type="text" name="tipo_mascota" value="<?= htmlspecialchars($tipo_mascota) ?>">
        <br>
        <label for="fecha_cita">Fecha de la cita</label>
        <input type="date" name="fecha_cita" value="<?= htmlspecialchars($fecha_cita) ?>">
        <br>
        <label for="hora_cita">Hora de la cita</label>
        <input type="time" name="hora_cita" value="<?= htmlspecialchars($hora_cita) ?>">
        <br>
        <label for="motivo_cita">Motivo de la cita</label>
        <input type="text" name="motivo_cita" value="<?= htmlspecialchars($motivo_cita) ?>">
        <br>
        <label for="numero_telefono">Número de teléfono</label>
        <input type="tel" name="numero_telefono" value="<?= htmlspecialchars($numero_telefono) ?>">
        <br>
        <button type="submit">Actualizar</button>
    </form>
    
</body>
</html>
