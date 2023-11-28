<?php 
  require_once './dbconexion.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300&family=Raleway:wght@500&display=swap" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="./style.css">
       
    <title>Registrarse</title>
</head>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<body>


<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="./index.php">
                <img class="icon_logo" width="32" height="32" src="https://img.icons8.com/windows/32/000000/baby-calendar.png" alt="baby-calendar"/>
                    CitaManager
            </a>
            
              <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="collapse navbar-collapse justify-content-end">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
               
                        <li class="nav-item"  type="button" class="btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            <a class="nav-link" href="inicio_sesion.php">Inicia Sesión</a>
                        </li>
                        
            </ul>
                    </div>
              </div>
        </div>

</nav>   

<div class="box_registro">
      <div class="login form">
            <div class="wrapper bg-white">
                  <div class="h4 text-muted text-center pt-2">Ingresa Tus Datos</div>
                        <form class="pt-2" method="POST">

<?php
require_once './dbconexion.php';

# Inicia Código de REGISTRAR
if (isset($_POST['registrar'])) {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $username = $_POST['username'];
    $contra = $_POST['contra'];
    $rol_elegido = $_POST['rol'];
    $activo="si";

    if ($username === 'admin') {
        $rol_elegido = 'admin';
    }


    if (!empty($nombre) && !empty($apellido) && !empty($email) && !empty($telefono) && !empty($username) && !empty($contra) && !empty($rol_elegido)) {
        try {
            // Verifica si el correo electrónico ya existe
            $query = "SELECT * FROM usuarios_reg WHERE email = :email";
            $statement = $cnnPDO->prepare($query);
            $statement->bindParam(':email', $email);
            $statement->execute();
            $resultsCorreo = $statement->fetchAll();

            if ($resultsCorreo) {
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Ups! El correo electrónico ya existe.</strong> Prueba con otro.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            } else {
                // Verifica si el nombre de usuario ya existe
                $query = "SELECT * FROM usuarios_reg WHERE username = :username";
                $statement = $cnnPDO->prepare($query);
                $statement->bindParam(':username', $username);
                $statement->execute();
                $resultsUsuario = $statement->fetchAll();

                if ($resultsUsuario) {
                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Ups! El usuario ya existe.</strong> Prueba con otro.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                } else {
                    // Inserta el nuevo usuario
                    $sql = $cnnPDO->prepare("INSERT INTO usuarios_reg (nombre, apellido, email, telefono, username, password, rol, activo) VALUES (:nombre, :apellido, :email, :telefono, :username, :contra, :rol, :activo)");

                    $sql->bindParam(':nombre', $nombre);
                    $sql->bindParam(':apellido', $apellido);
                    $sql->bindParam(':email', $email);
                    $sql->bindParam(':telefono', $telefono);
                    $sql->bindParam(':username', $username);
                    $sql->bindParam(':contra', $contra);
                    $sql->bindParam(':rol', $rol_elegido);
                    $sql->bindParam(':activo',$activo);


                    if ($sql->execute()) {
                        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Usuario Registrado.</strong> Te has registrado.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';

                    } else {
                        echo "Error al ejecutar la consulta de inserción.";
                    }
                }
            }
        } catch (PDOException $e) {
            echo "Error en la consulta: " . $e->getMessage();
        }
    }
}

unset($cnnPDO);
?>

                              <div class="form-group py-2" form method="POST">
                                    <div class="input-field"> <span class="far p-2"></span> <input type="text" placeholder="Nombre:" required class="input" name="nombre">
                                    </div>
                              </div>
                              <div class="form-group py-1 pb-2">
                                    <div class="input-field"> <span class="fas p-2"></span> <input type="text"  placeholder="Apellido:" required class="input" name="apellido"> 
                                    </div>
                              </div>
                              <div class="form-group py-1 pb-2">
                                    <div class="input-field"> <span class="fas fa-lock p-2"></span> <input type="email"  placeholder="Correo:" required class="input" name="email"> 
                                    </div>
                              </div>
                              <div class="form-group py-1 pb-2">
                                    <div class="input-field"> <span class="fas fa-lock p-2"></span> <input type="tel"  placeholder="Telefono:" required class="input" name="telefono"> 
                                    </div>
                              </div>
                              <div class="form-group py-1 pb-2">
                                    <div class="input-field"> <span class="fas p-2"></span> <input type="text"  placeholder="Usuario:" required class="input" name="username"> 
                                    </div>
                              </div>
                              <div class="form-group py-1 pb-2">
                                    <div class="input-field"> <span class="fas fa-lock p-2"></span> <input type="password"  placeholder="Contraseña:" required class="input" name="contra"> 
                                    </div>
                              </div>
                              <div>
                                    <label for="rol"></label>
                                    <select id="rol" name="rol" required>
                                        <option value="">Selecciona un rol</option>
                                        <option value="dueño">Dueño</option>
                                        <option value="cliente">Cliente</option>
                                    </select><br><br>
                              </div>
                              
                              <div class="d-flex align-items-start">
                                     </div> <button class="btn btn-block text-center my-3" name="registrar" type="submit">Registrarme</button>
                                    
                                    <div class="text-center pt-1 text-muted">¿Ya tienes cuenta?<a href="inicio_sesion.php">Iniciar Sesion</a></div>

                                    </form> 
                                

                            </div>
                                <div class="">
                            </div>
</div>


</body>
</html>