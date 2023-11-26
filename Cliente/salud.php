<?php
require_once 'db_conexion.php';

$verDatos = ''; 

# Código de ELIMINAR
if (isset($_POST['eliminar'])) {
    $id_cita = $_POST['id'];

    if (!empty($id_cita)) {
        $query = $cnnPDO->prepare('DELETE from agendar_cita WHERE id = :id');
        $query->bindParam(':id', $id_cita);

        $query->execute();
        echo '<div class="alert alert-danger" role="alert">Datos eliminados</div>';
    }
}
# Termina Código de ELIMINAR

# Inicia código de Registro
if (isset($_POST['confirmar'])) {
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $tipo_cita = $_POST['tipo_cita'];

    if (!empty($fecha) && !empty($hora) && !empty($tipo_cita)) {
        $sql = $cnnPDO->prepare("INSERT INTO agendar_cita (fecha, hora, tipo_cita) VALUES (:fecha, :hora, :tipo_cita)");
        $sql->bindParam(':fecha', $fecha);
        $sql->bindParam(':hora', $hora);
        $sql->bindParam(':tipo_cita', $tipo_cita);
        $sql->execute();

        // Obtener la última cita agendada
        $ultimaCita = $cnnPDO->query("SELECT * FROM agendar_cita ORDER BY id DESC LIMIT 1")->fetch(PDO::FETCH_ASSOC);

        // Mostrar los detalles de la última cita en el modal
        if ($ultimaCita) {
            $verDatos = '
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Detalles de la Cita
                </button>
                
                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Día de la cita: ' . $ultimaCita['fecha'] . '</p>
                                <p>Hora: ' . $ultimaCita['hora'] . '</p>
                                <p>Tipo de cita: ' . $ultimaCita['tipo_cita'] . '</p>
                                <p>ID de cita: ' . $ultimaCita['id'] . '</p>
                                <form method="post" action="">
                                    <input type="hidden" name="id" value="' . $ultimaCita['id'] . '">
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">Cancelar Cita</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>';
        
            // Modal de confirmación de eliminación
            echo '
            <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmación</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            ¿Estás seguro de cancelar tu cita?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                            <form method="post" action="">
                                <input type="hidden" name="id" value="' . $ultimaCita['id'] . '">
                                <button type="submit" class="btn btn-danger" name="eliminar">Sí</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>';
        }
    }
}
# Termina código de Registrar
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <form method="post">
        <!-- Campos del formulario -->
        <input type="date" placeholder="Escoge el día" name="fecha" min="<?php echo date('Y-m-d', strtotime('-1 day')); ?>" required>        
        <input type="time" placeholder="Escoge la hora" name="hora">
        <label for="rol"></label>
        <select id="" name="tipo_cita" required>
            <option value="">Selecciona tu tipo de cita</option>
            <option value="a">A</option>
            <option value="b">B</option>
        </select><br><br>
        <!-- Botón de confirmar -->
        <button type="submit" class="btn btn-primary" name="confirmar">Confirmar</button>
        <a href="index.php" class="btn btn-primary">Inicio</a>
    </form>

    <!-- Mostrar el botón "Ver datos" solo si se ha registrado una cita -->
    <?php echo $verDatos; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
