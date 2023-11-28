<?php
 session_start();
 require_once 'dbconexion.php';
 
 if($_SESSION['act'] =="no"){
  header('location:index.php');
exit();
}
 if (isset($_POST['cerrar_sesion'])){
  session_destroy();
  header('location:index.php');
 }
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
        <title>Cliente</title>
</head>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
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
            <button href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Ver perfil</button>
            
            <form method="POST">
                <button type="submit" class="btn btn-outline-danger" name="cerrar_sesion">Cerrar sesión</button>
            </form>
        </div>
    </div>
</nav><br><br><br><br><br>
    <div class="container mt-5 mb-9 d-flex flex-column justify-content-center align-items-center">
        <h2>Agenda cita en los diferentes tipos de servicios</h2><br>
        <div style="text-align: center;" class="row">
            <div class="col-md-4">
                <img src="./images/sector_salud.webp" alt="sector salud" class="img-top circular-image"><br><br>
                <h5>Sector Salud</h5><br>
                <a href="establecimientos_.php" class="btn btn-dark">Ver establecimientos</a>     
            </div>

            <div class="col-md-4">
                <img src="./images/barber.webp" alt="estilistas" class="img-top circular-image"><br><br>
                <h5>Barber's Y Estéticas</h5><br>
                <a href="#" class="btn btn-dark">Ver establecimientos</a>     
            </div>

            <div class="col-md-4">
                <img src="./images/restaurantes.webp" alt="restaurantes" class="img-top circular-image"><br><br>
                <h5>Restaurantes</h5><br>
                <a href="#" class="btn btn-dark">Ver establecimientos</a>     
            </div>
        </div>
    </div>

    
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog" >
    <div class="modal-content" >
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h4>Usuario: <?php echo $_SESSION['username'];?></h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<?php
    include('./footer.php');
?>

</body>
</html>
