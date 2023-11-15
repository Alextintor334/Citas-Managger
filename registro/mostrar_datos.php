<?php 
require_once 'db_conexion.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD</title>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">

    <!-- Icono del Sitio Web -->
    <link rel="icon" href="images/favicono.jpg">
</head>
<body style="background-color: #E8F8F5">
    <!-- Section NavBar -->
    <section>
        <nav class="navbar fixed-top " style="background-color: #FFFFFF;">
            <div class="container-fluid">
                <div class="page-header" style="color: #2E86C1;">
                    <h3>Servicios Médicos</h3>
                </div>
                <div align="right">
                    <a href="index.php" class="btn btn-dark btn-rounded"><strong>Nueva Captura</strong></a>&nbsp;&nbsp;&nbsp;
                    <label><strong>Vista de Admin&nbsp;</strong></label>
                    <img src="images/db.png">
                </div>
            </div>
        </nav>
    </section>
    <!-- Section NavBar -->

    <!-- Section de la Tabla -->
    <section>
        <div class="container" style="width:90%;margin-top:120px;">
            <table class="table">
                <thead class="black white-text">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Dirección</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Tipo de Cita</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Hora</th>
                        <th scope="col">Número telefónico</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Imagen</th><th scope="col">Código</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = $cnnPDO->prepare("SELECT * FROM salud");
                    $sql->execute();
                    $contador = 1;

                    while ($campo = $sql->fetch(PDO::FETCH_ASSOC)) {
                        echo '<tr>';
                        echo '<td>' . $contador . '</td>';
                        echo '<td>' . $campo['nombre'] . '</td>';
                        echo '<td>' . $campo['direccion'] . '</td>';
                        echo '<td>' . $campo['descripcion'] . '</td>';
                        echo '<td>' . $campo['cita'] . '</td>';

                        // Formatear la fecha
                        $fechaFormateada = date('d/m/Y', strtotime($campo['fecha']));
                        echo '<td>' . $fechaFormateada . '</td>';

                        echo '<td>' . $campo['hora'] . '</td>';
                        echo '<td>' . $campo['numero'] . '</td>';
                        echo '<td>' . $campo['correo'] . '</td>';
                        echo '<td>' . '<img class="rounded-circle" src="data:image/png;base64,' . base64_encode($campo['imagen']) . '" width="150px" height="150px"/>' . '</td>';
                        echo '<td>' . $campo['codigo'] . '</td>';
                        echo '</tr>';

                        $contador++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
</body>
</html>