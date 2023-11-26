<?php
// Iniciar la sesión
session_start();

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
$email = $_POST['email'];
$password = $_POST['password'];

// Consulta SQL para obtener los datos del usuario
$sql = "SELECT id, nombre, password, rol FROM Usuarios WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Existe un usuario con ese correo electrónico
    $row = $result->fetch_assoc();
    $hashed_password = $row['password'];

    // Verificar la contraseña
    if (password_verify($password, $hashed_password)) {
        // Iniciar sesión y guardar datos del usuario en variables de sesión
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_name'] = $row['nombre'];
        $_SESSION['rol'] = $row['rol']; // Guardar el rol del usuario en la sesión

        // Determinar la redirección según el rol del usuario
        if ($_SESSION['rol'] === 'admin') {
            // Si es un admin, redirigir a la vista de administrador o mostrar contenido especial
            header('Location: vista_admin.php'); // Cambiar a la URL de la vista de administrador
            exit();
        } else if ($_SESSION['rol'] === 'dueno') {
            // Si es un dueño, redirigir a la vista de dueño o mostrar contenido especial
            header('Location: vista_dueno.php'); // Cambiar a la URL de la vista de dueño
            exit();
        } else if ($_SESSION['rol'] === 'cliente') {
            // Si es un cliente, redirigir a la vista de cliente o mostrar contenido especial
            header('Location: vista_cliente.php'); // Cambiar a la URL de la vista de cliente
            exit();
        } else {
            // Otro rol no definido
            echo "Rol no válido.";
        }
    } else {
        echo "Correo electrónico o contraseña incorrectos.";
    }
} else {
    echo "No se encontró ningún usuario con ese correo electrónico.";
}


// Cerrar la conexión
$conn->close();
?>
