<?php
// Verificar si se reciben los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexión a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "db_citas_managger";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Recibir y limpiar los datos del formulario
    $nombre_establecimiento = mysqli_real_escape_string($conn, $_POST['nombre_establecimiento']);
    $direccion = mysqli_real_escape_string($conn, $_POST['direccion']);
    $descripcion = mysqli_real_escape_string($conn, $_POST['descripcion']);
    $tipos_cita = mysqli_real_escape_string($conn, $_POST['tipos_cita']);
    $horarios = mysqli_real_escape_string($conn, $_POST['horarios']);
    $correo = mysqli_real_escape_string($conn, $_POST['correo']);
    $telefono = mysqli_real_escape_string($conn, $_POST['telefono']);

    // Procesar la imagen
    $imagen_nombre = $_FILES['imagen_establecimiento']['name'];
    $imagen_temporal = $_FILES['imagen_establecimiento']['tmp_name'];

    // Obtener los datos binarios de la imagen
    $imagen_binaria = file_get_contents($imagen_temporal);

    // Consulta SQL para insertar los datos en la tabla 'establecimientos' con la imagen binaria
    $sql = "INSERT INTO establecimientos (nombre_establecimiento, direccion, descripcion, tipos_cita, horarios, correo, telefono, imagen)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    // Preparar la consulta
    $stmt = $conn->prepare($sql);

    // Vincular parámetros
    $stmt->bind_param("sssssssb", $nombre_establecimiento, $direccion, $descripcion, $tipos_cita, $horarios, $correo, $telefono, $imagen_binaria);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        // Obtener el ID del último registro insertado
        $ultimo_id = $conn->insert_id;
        // Redirigir a la página de detalles del establecimiento recién registrado
        header("Location: detalles_establecimiento.php?id=$ultimo_id");
        exit();
    } else {
        echo "Error al guardar el establecimiento con la imagen: " . $conn->error;
    }

    // Cerrar la conexión
    $stmt->close();
    $conn->close();
}
?>
