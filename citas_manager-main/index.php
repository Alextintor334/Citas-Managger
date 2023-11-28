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
        <title>Citas Managger</title>
</head>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<body>

<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="./index.php">
                <img class="icon_logo" width="32" height="32" src="https://img.icons8.com/windows/32/000000/baby-calendar.png" alt="baby-calendar"/>
                    CitaManager
            </a>
              
          <div class="collapse navbar-collapse justify-content-end" id="navbarCollapse">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
                <li class="nav-item">
                    <a class="nav-link" href="registrarse.php">¿Tienes un establecimiento?</a>
                </li>
                <li class="nav-item"  type="button" class="btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    <a class="nav-link" href="inicio_sesion.php">Inicia Sesión</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="registrarse.php">Registrarse</a>
                </li>
                    <li class="nav-item">
                      <a class="nav-link" href="inicio_sesion.php">Agendar Cita.</a>
                    </li>
            </ul>
          </div>
        </div>
</nav>    



<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="./images/restaurant.webp" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Restaurantes</h5>
        <p>¿Para qué hacer la cena hoy si puedes ir a comer en un restaurante?</p>
      </div>
    </div>
    
    <div class="carousel-item">
    <img src="./images/doctor1.webp" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Sector Salud.</h5>
        <p>Profesionales de la salud dispuestos a ayudarte.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="./images/peluqueria.webp" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Belleza y cuidado personal.</h5>
        <p>Some representative placeholder content for the third slide.</p>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>

  <div class="mb-5 container mt-5">
     <div class="row">
      <div class="col">
        <div class="card" style="width: 22rem;">
          <div class="card-body">
              <h5 class="card-title mb-3">
                  <img width="48" height="48" src="https://img.icons8.com/pulsar-color/48/search-more.png" alt="search-more"/>
                    Agenda tus citas de manera mas eficiente 
              </h5>
              <p class="card-text">Elige tu hora preferida y solicita cita sin llamar. Fácil, cómodo y rápido.</p>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="card" style="width: 22rem;">
          <div class="card-body">
              <h5 class="card-title">
                  <img width="48" height="48" src="https://img.icons8.com/pulsar-color/48/web-account.png" alt="web-account"/>
                    Agenda tus citas de manera mas eficiente 
              </h5>
              <p class="card-text">Elige tu hora preferida y solicita cita sin llamar. Fácil, cómodo y rápido.</p>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="card" style="width: 22rem;">
          <div class="card-body">
              <h5 class="card-title">
                <img width="48" height="48" src="https://img.icons8.com/pulsar-color/48/clock.png" alt="clock"/>
                  Encuentra tu especialista
              </h5>
              <p class="card-text">Elige tu hora preferida y solicita cita sin llamar. Fácil, cómodo y rápido.</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php
    include('./footer.php');
  ?>

</div>
</body>
</html>