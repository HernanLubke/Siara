<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" integrity=" " crossorigin="">
    <link href= "assets/css/estilos.css" rel="stylesheet">
    <title>Hola mundo!</title>
  </head>
  <body>
    <h1>Hola mundo!</h1>
  
   <!--Inicio carrusel-->
   <div class="carousel slide"  id="carrusel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carrusel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carrusel" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carrusel" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="assets/img/carrusel1.avif" class= "carrusel1">
      <div>
        <h5>La mejor marca</h5>
        <p>Alimento balanceado.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="assets/img/carrusel2.jpeg" class= "carrusel2" >
      <div>
        <h5>Accesorios</h5>
        <p>Todo lo que buscas para tu mascota.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="assets/img/carrusel3.avif" class= "carrusel3">
      <div>
        <h5>La mejor calidad</h5>
        <p>De diferentes tamaños.</p>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carrusel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carrusel" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

<!--Fin carrusel-->

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>