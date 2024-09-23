<div class="contenedor">
        <img id="perro" src="assets/img/cartel.jpg" alt="imagen de presentacion">
    </div>

    <?php
$session   = session();
$nombre    = $session->get('Nombre');
$apellido  = $session->get('Apellido');
$perfil    = $session->get('Perfil_id');
?>

   <!--Barra/color de Producto-->
    <div style="background-color:rgb(118, 1, 141); padding: -1rem;">
    <h1 style="margin-top: 2rem; text-align: center; color: white;">Productos</h1>
</div>

      <!--Tarjetas - perros/Gatos/Accesorios-->
      <?php if ($perfil == 1) { ?>
      
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-6 col-sm-4 col-md-3 mb-4">
                <!-- Tarjeta 1: Alimentos para perros -->
                <div class="card">
                    <img src="assets/img/card-perros.png" class="card-img-top" alt="imagen alimento para perros">
                    <div class="card-body">
                        <h5 class="card-title">Alimentos para perros</h5>
                        <p class="card-text">Aquí encontrarás las mejores marcas de alimentos para tu perro.</p>
                        <form action="<?php echo base_url('categoria/2'); ?>">
                            <button class="text-boton">Lista</button>
                        </form>
                    </div>
                </div>
            </div>
           <div class="col-6 col-sm-4 col-md-3 mb-4">
            <div class="card">
                <img src="assets/img/card-gatos.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Alimentos para gatos</h5>
                    <p class="card-text">Aca encontraras las mejores marcas de alimentos para tu gato.</p>
                    <form action="<?php echo base_url('categoria/1'); ?>">
                        <button class="text-boton">Lista</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-4 col-md-3 mb-4">
            <div class="card">
                <img src="assets/img/card-accesorios.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Accesorios</h5>
                    <p class="card-text">Enterate de todos los accesorios que tenemos disponible para tu mascota.</p>
                    <form action="<?php echo base_url('categoria/3'); ?>">
                        <button class="text-boton">Lista</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div><br><br><br><br><br>
<?php } elseif ($perfil == 2) { ?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-6 col-sm-4 col-md-3 mb-4">
                <!-- Tarjeta 1: Alimentos para perros -->
                <div class="card">
                    <img src="assets/img/card-perros.png" class="card-img-top" alt="imagen alimento para perros">
                    <div class="card-body">
                        <h5 class="card-title">Alimentos para perros</h5>
                        <p class="card-text">Aquí encontrarás las mejores marcas de alimentos para tu perro.</p>
                        <form action="<?php echo base_url('categoria/2'); ?>">
                            <button class="text-boton">Lista</button>
                        </form>
                    </div>
                </div>
            </div>
           <div class="col-6 col-sm-4 col-md-3 mb-4">
            <div class="card">
                <img src="assets/img/card-gatos.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Alimentos para gatos</h5>
                    <p class="card-text">Aca encontraras las mejores marcas de alimentos para tu gato.</p>
                    <form action="<?php echo base_url('categoria/1'); ?>">
                        <button class="text-boton">Lista</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-4 col-md-3 mb-4">
            <div class="card">
                <img src="assets/img/card-accesorios.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Accesorios</h5>
                    <p class="card-text">Enterate de todos los accesorios que tenemos disponible para tu mascota.</p>
                    <form action="<?php echo base_url('categoria/3'); ?>">
                        <button class="text-boton">Lista</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div><br><br><br><br><br>
    <!-- Tarjetas para usuarios no registrados -->
    <?php } else { ?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-6 col-sm-4 col-md-3 mb-4">
		<div class="card">
                <img src="assets/img/card-perros.png" class="card-img-top" alt="imagen alimento para perros">
                <div class="card-body">
                    <h5 class="card-title">Alimentos para perros</h5>
                    <p class="card-text">Aca encontraras las mejores marcas de alimentos para tu perro.</p>
                    <form action="<?php echo base_url('perros'); ?>">
                        <button class="text-boton">Lista</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-4 col-md-3 mb-4">
                <div class="card">
                    <img src="assets/img/card-gatos.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Alimentos para gatos</h5>
                        <p class="card-text">Aquí encontrarás las mejores marcas de alimentos para tu gato.</p>
                        <form action="<?php echo base_url('gatos'); ?>">
                            <button class="text-boton">Lista</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-6 col-sm-4 col-md-3 mb-4">
            <div class="card">
                <img src="assets/img/card-accesorios.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Accesorios</h5>
                    <p class="card-text">Enterate de todos los accesorios que tenemos disponible para tu mascota.</p>
                    <form action="<?php echo base_url('accesorios'); ?>">
                        <button class="text-boton">Lista</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?> <br><br><br><br><br>

        <h2 style="margin-top: -5rem; text-align: center; background-color: rgb(118, 1, 141); padding: 0.5rem; color: white; width: 100%;">Novedades</h2>
        </div>
    <!--Tarjetas - Novedades-->
    <div class="contenedor">
    <div class="card-novedades">
    <img src="assets/img/novedad/alimHumedo.png" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">A tu gato le va a encantar</h5>
      <p class="card-text">Precio: $1,200.</p>
    </div>
    </div>
    <div class="card-novedades">
    <img src="assets/img/novedad/juguete.png" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">Juguetes para tu perro</h5>
      <p class="card-text">Precio: $2,250</p>
    </div>
    </div>
    <div class="card-novedades">
    <img src="assets/img/novedad/proteina.png" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">Proteína para tu perro</h5>
      <p class="card-text">Precio: $3,800</p>
      </div>
      </div>
      <div class="card-novedades">
      <img src="assets/img/novedad/rascador.png" class="card-img-top" alt="...">
      <div class="card-body">
      <h5 class="card-title">Rascadores para tu gato</h5>
      <p class="card-text">Precio: $2,650</p>
      </div>
    </div>
  </div><br><br><br><br><br>


