<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_citas_managger";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificación de conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recibir datos del formulario
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$password = $_POST['password'];
$codigo_secreto = $_POST['nombre']; // Se toma un campo específico para el código secreto
$rol_elegido = $_POST['rol']; // Se obtiene el rol seleccionado del formulario

// Definir el rol predeterminado como 'cliente'
$rol = 'cliente';

// Verificar si se ingresó el código secreto
if ($codigo_secreto === 'codigo_secreto_admin') {
    $rol = 'admin'; // Si coincide el código secreto, establecer el rol como 'admin'
} elseif ($rol_elegido === 'dueño') {
    $rol = 'dueño'; // Si se selecciona 'dueño', establecer el rol como 'dueño'
} elseif ($rol_elegido === 'cliente') {
    $rol = 'cliente'; // Si se selecciona 'cliente', establecer el rol como 'cliente'
}

// Encriptar la contraseña
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Consulta SQL para insertar usuario en la base de datos con el rol correspondiente
$sql = "INSERT INTO Usuarios (nombre, email, password, rol) VALUES ('$nombre', '$email', '$hashed_password', '$rol')";

if ($conn->query($sql) === TRUE) {
    echo "¡Usuario registrado exitosamente como $rol!";
} else {
    echo "Error al registrar el usuario: " . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>
