<?php
require_once 'db_conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['registrar'])) {
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $descripcion = $_POST['descripcion'];
    $cita = $_POST['cita'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $numero = $_POST['numero'];
    $correo = $_POST['correo'];
    $codigo = $_POST['codigo'];

    // Check if the image file is selected
    if ($_FILES['imagen']['error'] == 0 && !empty($_FILES['imagen']['tmp_name'])) {
        $cargarImagen = $_FILES['imagen']['tmp_name'];
        $imagen = fopen($cargarImagen, 'rb');
    } else {
        // Set $imagen to NULL if no image is selected
        $imagen = null;
    }

    if (!empty($nombre) && !empty($direccion) && !empty($descripcion) && !empty($cita) && !empty($fecha) && !empty($hora) && !empty($numero) && !empty($correo)) {
        try {
            // Verificar si los datos ya existen en la base de datos
            $checkQuery = "SELECT * FROM salud WHERE nombre = :nombre AND direccion = :direccion AND fecha = :fecha AND hora = :hora AND numero = :numero AND correo = :correo";
            $checkStmt = $cnnPDO->prepare($checkQuery);
            $checkStmt->bindParam(':nombre', $nombre);
            $checkStmt->bindParam(':direccion', $direccion);
            $checkStmt->bindParam(':fecha', $fecha);
            $checkStmt->bindParam(':hora', $hora);
            $checkStmt->bindParam(':numero', $numero);
            $checkStmt->bindParam(':correo', $correo);
            $checkStmt->execute();

            if ($checkStmt->rowCount() > 0) {// Los datos ya existen, mostrar alerta
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Alerta!</strong> Los datos ya existen en la base de datos.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
            } else {
                // Los datos no existen, realizar la inserción
                $insertQuery = "INSERT INTO salud (nombre, direccion, descripcion, cita, fecha, hora, numero, correo, imagen, codigo) VALUES (:nombre, :direccion, :descripcion, :cita, :fecha, :hora, :numero, :correo, :imagen, :codigo)";
                $insertStmt = $cnnPDO->prepare($insertQuery);

                $insertStmt->bindParam(':nombre', $nombre);
                $insertStmt->bindParam(':direccion', $direccion);
                $insertStmt->bindParam(':descripcion', $descripcion);
                $insertStmt->bindParam(':cita', $cita);

                // Format the date as "day month year" (d M Y)
                $formattedDate = date("d M Y", strtotime($fecha));
                $insertStmt->bindParam(':fecha', $formattedDate);

                $insertStmt->bindParam(':hora', $hora);
                $insertStmt->bindParam(':numero', $numero);
                $insertStmt->bindParam(':correo', $correo);
                $insertStmt->bindParam(':imagen', $imagen, PDO::PARAM_LOB);
                $insertStmt->bindParam(':codigo', $codigo);

                if ($insertStmt->execute()) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Operación realizada!</strong> Se agregó con éxito.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <a href="index.php" class="btn btn-primary">Volver al formulario</a>
                          </div>';
                } else {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error!</strong> No se pudo agregar el establecimiento.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>';
                }
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        } finally {
            unset($checkStmt);
            unset($insertStmt);
        }
    }
}
?>