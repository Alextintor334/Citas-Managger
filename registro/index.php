<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Establecimiento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <h1>Registro de Establecimiento</h1>
    <form method="post" action="registrar_datos.php" enctype="multipart/form-data">
        <label for="nombre">Nombre del lugar:</label>
        <input type="text" name="nombre"><br>
        
        <label for="direccion">Dirección:</label>
        <input type="text" name="direccion" ><br>
        
        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion"></textarea><br>

        <label for="cita">Tipo de Cita:</label>
        <select name="cita">
            <option value="consulta">Consulta General</option>
            <option value="examenes">Exámenes Médicos</option>
            <option value="urgencia">Urgencia</option>
        </select><br>
        
        <label for="fecha">Fecha:</label>
        <input type="date" name="fecha" ><br>
        
        <label for="hora">Hora:</label>
        <input type="time" name="hora" ><br>
        
        <label for="numero">Número telefónico:</label>
        <input type="tel" name="numero" ><br>

        <label for="correo">Correo de contacto:</label>
        <input type="email" name="correo" ><br>

        <input type="text" placeholder="Ingrese Código" name="codigo">
        <input type="file" accept="image/jpg" name="imagen">
        <br><br>
        
        <input type="submit" name="registrar" value="Registrar">
    </form>

    <p><a href="mostrar_datos.php">Ver Establecimientos Registrados</a></p>
</body>
</html>
