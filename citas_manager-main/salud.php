<?php
session_start();

if ($_SESSION['act'] == "no") {
    header('location:index.php');
    exit();
}
if (isset($_POST['cerrar_sesion'])) {
    session_destroy();
    header('location:index.php');
}

require_once 'dbconexion.php';

            $verDatos = '';


# Código de ELIMINAR
if (isset($_POST['eliminar'])) {
    $id_cita = $_POST['id'];

    if (!empty($id_cita)) {
        $query = $cnnPDO->prepare('DELETE from agendar_cita WHERE id = :id');
        $query->bindParam(':id', $id_cita);

        $query->execute();
        echo '<div class="alert alert-danger" role="alert">Cita cancelada</div>';
    }
}
# Termina Código de ELIMINAR

# Inicia código de Registro

if (isset($_POST['confirmar'])) {
    
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $tipo_cita = $_POST['tipo_cita'];

    if (!empty($fecha) && !empty($hora) && !empty($tipo_cita)) {
        // Insertar la cita si no hay otra a la misma hora
        $sql = $cnnPDO->prepare("INSERT INTO agendar_cita (fecha, hora, tipo_cita) VALUES (:fecha, :hora, :tipo_cita)");
        $sql->bindParam(':fecha', $fecha);
        $sql->bindParam(':hora', $hora);
        $sql->bindParam(':tipo_cita', $tipo_cita);
        $sql->execute();

        // Obtener la última cita agendada
        $ultimaCita = $cnnPDO->query("SELECT * FROM agendar_cita ORDER BY id DESC LIMIT 1")->fetch(PDO::FETCH_ASSOC);
        $verDatos = '';
        // Mostrar los detalles de la última cita debajo del formulario
        if ($ultimaCita) {

            $verDatos = '
                <div class="container mt-4" style="color: black;">
                    <h3>Detalles de la Cita</h3>
                    <div style="color: black;">
                        <p>Día de la cita: ' . $ultimaCita['fecha'] . '</p>
                        <p>Hora: ' . $ultimaCita['hora'] . '</p>
                        <p>Tipo de cita: ' . $ultimaCita['tipo_cita'] . '</p>
                        <p>ID de cita: ' . $ultimaCita['id'] . '</p>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">Cancelar Cita</button>
                    </div>
                </div>';

            // Modal de confirmación de eliminación
            $verDatos .= '
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="./style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300&family=Raleway:wght@500&display=swap" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="./index.php">
            <img class="icon_logo" width="32" height="32" src="https://img.icons8.com/windows/32/000000/baby-calendar.png" alt="baby-calendar"/>
            CitaManager
        </a>
        
        <div class="text-white">
            <h3><?php echo $_SESSION['username']; ?><br><?php echo $_SESSION['email']; ?></h3>
        </div>

        <div class="collapse navbar-collapse justify-content-end">
            <a href="modal_perfil.php" class="btn btn-outline-secondary me-2">Ver perfil</a>
            <form method="POST">
                <button type="submit" class="btn btn-outline-danger" name="cerrar_sesion">Cerrar sesión</button>
            </form>
        </div>
    </div>
</nav><br><br><br><br>

<form method="POST">
    <!-- Campos del formulario -->
    <input type="date" placeholder="Escoge el día" name="fecha" min="<?php echo date('Y-m-d', strtotime('0 day')); ?>" required>        
    <input type="time" placeholder="Escoge la hora" name="hora">
    <label for="rol"></label>
    <select id="" name="tipo_cita" required>
        <option value="">Selecciona tu tipo de cita</option>
        <option value="a">A</option>
        <option value="b">B</option>
    </select><br><br>
    <!-- Botón de confirmar -->
    <button type="submit" class="btn btn-primary" name="confirmar">Confirmar</button>
    <a href="vista_cliente.php" class="btn btn-primary">Inicio</a>
</form>


<?php 
echo '<div class="texto2">'.$verDatos. '</div>'; ?>

</body>
</html>
