<!DOCTYPE html>
<html>
<head>
    <title>Registro de Usuario</title>
</head>
<body>
    <h2>Registro de Usuario</h2>
    <form action="registro.php" method="post">
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" required><br><br>

    <label for="email">Correo electrónico:</label>
    <input type="email" id="email" name="email" required><br><br>

    <label for="password">Contraseña:</label>
    <input type="password" id="password" name="password" required><br><br>

    <label for="rol"></label>
    <select id="rol" name="rol" required>
        <option value="">Selecciona un rol</option>
        <option value="dueño">Dueño</option>
        <option value="cliente">Cliente</option>
    </select><br><br>

    <input type="submit" value="Registrarse">
</form>

</body>
</html>
