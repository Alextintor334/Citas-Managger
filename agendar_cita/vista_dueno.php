<?php
echo 'Vista del dueño';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registrar Establecimiento</title>
</head>
<body>
    <h2>Registrar Establecimiento</h2>
    <form action="guardar_establecimiento.php" method="post" enctype="multipart/form-data">
        <label for="nombre_establecimiento">Nombre del Establecimiento:</label>
        <input type="text" id="nombre_establecimiento" name="nombre_establecimiento" required><br><br>

        <label for="direccion">Dirección:</label>
        <input type="text" id="direccion" name="direccion" required><br><br>

        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" required></textarea><br><br>

        <label for="tipos_cita">Tipos de Cita (separados por comas):</label>
        <input type="text" id="tipos_cita" name="tipos_cita" required><br><br>

        <label for="horarios">Horarios:</label>
        <input type="text" id="horarios" name="horarios" required><br><br>

        <label for="correo">Correo:</label>
        <input type="email" id="correo" name="correo" required><br><br>

        <label for="telefono">Número Telefónico:</label>
        <input type="tel" id="telefono" name="telefono" required><br><br>

        <label for="imagen_establecimiento">Imagen del Establecimiento:</label>
        <input type="file" id="imagen_establecimiento" name="imagen_establecimiento" accept="image/*" required><br><br>

        <input type="submit" value="Enviar">
    </form>
</body>
</html>
