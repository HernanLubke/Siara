<section id="registro" class="d-flex justify-content-center align-items-center">
  <div class="col-md-6">
    <div class="col-md-6 mx-auto">
      <br>
      <img src="" class="img-fluid" alt="" style="box-shadow: none; height: 90vh;">
    </div>

    <div class="col-md-6 mx-auto">
      <div class="modal-content border-3 border-dark " style="width: 90%; font-family: Georgia, serif ;">
        <div class="card-header">
          <h3>Crear usuario</h3>
        </div>

        <?php $validation = \Config\Services::validation(); ?>
        <form method="post" action="<?php echo base_url('/enviar-form') ?>">

            <div class="card-body" media="(max-width:750px)">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Ingresa tu nombre">
             <!-- Validación -->
             <?php if ($validation->getError('nombre')) { ?>
                <div class='alert alert-danger mt-2'>
                  <?= $error = $validation->getError('nombre'); ?>
                </div>
              <?php } ?>

             <div class="form-group">
                <label for="apellido">Apellido</label>
                <input type="text"  name="apellido" class="form-control" id="apellido" placeholder="Ingresa tu apellido">
             <!-- Validación -->
             <?php if ($validation->getError('apellido')) { ?>
                <div class='alert alert-danger mt-2'>
                  <?= $error = $validation->getError('apellido'); ?>
                </div>
              <?php } ?>

             <div class="form-group">
                <label for="usuario">Nombre de usuario</label>
                <input type="text"  name="usuario"class="form-control" id="usuario" placeholder="Ingresa tu nombre de usuario">
             <!-- Validación -->
             <?php if ($validation->getError('usuario')) { ?>
                <div class='alert alert-danger mt-2'>
                  <?= $error = $validation->getError('usuario'); ?>
                </div>
              <?php } ?>

             <div class="form-group">
                <label for="email">Correo electrónico</label>
                <input type="email"  name="email" class="form-control" id="email" placeholder="Ingresa tu correo electrónico">
             <!-- Validación -->
             <?php if ($validation->getError('email')) { ?>
                <div class='alert alert-danger mt-2'>
                  <?= $error = $validation->getError('email'); ?>
                </div>
              <?php } ?>

            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password"  name="pass" class="form-control" id="password" placeholder="Ingresa tu contraseña">
                <!-- Validación -->
              <?php if ($validation->getError('pass')) { ?>
                <div class='alert alert-danger mt-2'>
                  <?= $error = $validation->getError('pass'); ?>
                </div>
              <?php } ?>
                
             <br> 
            <button type="submit" class="btn btn-primary btn-block mb-5";>Registrarse</button>
        </form>
       </div>
    </div>
              </section>