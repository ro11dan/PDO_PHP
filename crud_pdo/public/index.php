<?php

require_once __DIR__ . '/../config/db.php';

    // declaracion de la consulta SQL para obtener los datos de la tabla "alumnos"
    $sql = "SELECT * FROM alumnos ORDER BY id DESC";
    // ejecucion de la consulta SQL
    $stm = $pdo->query($sql);
    // obtener los resultados de la consulta SQL como un array asociativo
    $alumnos = $stm->fetchAll();   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud Alumnos PDO</title>
</head>
<body>
    <h1>Crud con PDO (Alumnos) </h1>
    <a class="btn" href="create.php"> + Nuevo Alumno</a>
    <br>
    <h2>Listado</h2>
    <table>
        <thead>
            <th>ID</th>
            <th>NOMBRE</th>
            <th>EMAIL</th>
            <th>CREADO</th>
            <th>ACCIONES</th>
        </thead>
    <tbody>
        <!-- si no hay alumnos ? -->
         <?php if(count($alumnos) === 0):  ?>
            <tr><td colspan="5">No hay registros</td></tr>
        <?php else: ?>
            <?php foreach($alumnos as $a): ?>
                <tr>
                    <td><?= htmlspecialchars($a["id"])?></td>
                    <td><?= htmlspecialchars($a["nombre"])?></td>
                    <td><?= htmlspecialchars($a["email"])?></td>
                    <td><?= htmlspecialchars($a["created_at"])?></td>
                    <td>
                        <a href="edit.php?id=<?= urlencode($a["id"]) ?>">Editar</a>
                        <a href="delete.php?id=<?= urlencode($a["id"]) ?>">Eliminar</a>
                    </td>
                </tr>
            <?php  endforeach;?>
        <?php endif; ?>
    </tbody>
    </table>
    
</body>
</html>
