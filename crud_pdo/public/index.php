<?php

require_once __DIR__ . '/../config/db.php';

    // declaracion de la consulta SQL para obtener los datos de la tabla "citas" ordenados por id de forma descendente
    $sql = "SELECT * FROM citas ORDER BY id DESC";
    // ejecucion de la consulta SQL
    $stm = $pdo->query($sql);
    // obtener los resultados de la consulta SQL como un array asociativo
    $citas = $stm->fetchAll();   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud Citas PDO</title>
</head>
<body>
    <h1>Crud con PDO (Citas) </h1>
    <a class="btn" href="create.php"> + Nueva cita</a>
    <br>
    <h2>Listado</h2>
    <table>
        <thead>
            <th>ID</th>
            <th>NOMBRE_DEL_DUEÑO</th>
            <th>NOMBRE_DE_LA_MASCOTA</th>
            <th>TIPO_DE_MASCOTA</th>
            <th>FECHA_DE_LA_CITA</th>
            <th>HORA_DE_LA_CITA </th>
            <th>MOTIVO_DE_LA_CITA</th>
            <th>ESTADO_DE_LA_CITA</th>
            <th>EMAIL</th>
            <th>NUMERO_DE_TELEFONO</th>
            <th>CREADO</th>
            <th>ACCIONES</th>
        </thead>
    <tbody>
        <!-- si no hay alumnos ? -->
         <?php if(count($citas) === 0):  ?>
            <tr><td colspan="5">No hay registros</td></tr>
        <?php else: ?>
            <?php foreach($citas as $c): ?>
                <tr>
                    <td><?= htmlspecialchars($c["id"])?></td>
                    <td><?= htmlspecialchars($c["nombre_dueno"])?></td>
                    <td><?= htmlspecialchars($c["nombre_mascota"])?></td>
                    <td><?= htmlspecialchars($c["tipo_mascota"])?></td> 
                    <td><?= htmlspecialchars($c["fecha_cita"])?></td>   
                    <td><?= htmlspecialchars($c["hora_cita"])?></td>
                    <td><?= htmlspecialchars($c["motivo_cita"])?></td>
                    <td><?= htmlspecialchars($c["estado_cita"])?></td>
                    <td><?= htmlspecialchars($c["email"])?></td>
                    <td><?= htmlspecialchars($c["telefono"])?></td>
                    <td><?= htmlspecialchars($c["created_at"])?></td>
                    <td>
                        <a href="edit.php?id=<?= urlencode($c["id"]) ?>">Editar</a>
                        <a href="delete.php?id=<?= urlencode($c["id"]) ?>">Eliminar</a>
                    </td>
                </tr>
            <?php  endforeach;?>
        <?php endif; ?>
    </tbody>
    </table>
    
</body>
</html>
