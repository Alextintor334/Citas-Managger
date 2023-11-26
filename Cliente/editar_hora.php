<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<?php
// Verificar si se proporciona un ID de cita en la URL
if (isset($_GET['id'])) {
    // Obtener el ID de la cita de la URL
    $id_cita = $_GET['id'];

    // Aquí debes realizar la conexión a tu base de datos
    require_once 'db_conexion.php';

    // Inicializar la variable para los detalles de la cita
    $detalleCita = [];

// Verificar si se ha enviado el formulario para actualizar la hora
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener la nueva hora del formulario
    $nueva_hora = $_POST['hora'];

    // Obtener el valor actual antes de actualizar la hora
    $consulta = $cnnPDO->prepare("SELECT hora FROM agendar_cita WHERE id = :id_cita");
    $consulta->bindParam(':id_cita', $id_cita);
    $consulta->execute();
    $valor_anterior = $consulta->fetchColumn();

    // Actualizar la hora en la base de datos
    $consultaUpdate = $cnnPDO->prepare("UPDATE agendar_cita SET hora = :nueva_hora WHERE id = :id_cita");
    $consultaUpdate->bindParam(':nueva_hora', $nueva_hora);
    $consultaUpdate->bindParam(':id_cita', $id_cita);
    $consultaUpdate->execute();

    // Redirigir de vuelta al formulario después de actualizar con un ancla en la URL
    header("Location: salud.php?id=$id_cita#staticBackdrop");
    exit(); // Asegura que el script se detenga después de redirigir
} else {
        // Si no se ha enviado el formulario, obtener los detalles de la cita actual
        $consulta = $cnnPDO->prepare("SELECT * FROM agendar_cita WHERE id = :id_cita");
        $consulta->bindParam(':id_cita', $id_cita);
        $consulta->execute();
        $detalleCita = $consulta->fetch(PDO::FETCH_ASSOC);
    }

    // Verificar si se obtuvieron los detalles de la cita correctamente
    if ($detalleCita) {
        // Mostrar el formulario para editar la hora
        echo '
        <form method="post">
            <label for="hora">Editar Hora:</label>
            <input type="time" name="hora" value="' . $detalleCita['hora'] . '">
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>';

        // Botón para ver los datos actualizados en el modal
        echo '
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            Ver datos actualizados
        </button>
        ';

        // Modal para mostrar los datos actualizados
        echo '
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Detalles de la cita actualizada</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Hora anterior: . <?php echo $valor_anterior; ?> . </p>
                        <p>Nueva hora: ' .$detalleCita['hora'] . '</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>';
    } else {
        echo 'No se encontraron detalles de la cita para el ID proporcionado.';
    }
}
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
