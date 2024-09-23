<head>
    <meta charset="UTF-8">
    <title>Inicio de sesión</title>
    <!-- Diseño responsivo -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="display: flex; justify-content: center; align-items: center; height: 100vh; background-color: rgba(245, 233, 66, 0.795); margin: 0;">

    <div style="display: flex; align-items: center; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border-radius: 10px; overflow: hidden; background-color: #fff;">
        <!-- Imagen -->
        <img src="assets/img/login.png" alt="Bienvenida" style="width: 50%; max-width: 400px; height: auto;">

        <!-- Formulario -->
        <section id="login" style="padding: 20px; box-sizing: border-box; width: 70%;">
            <h4 style="margin-bottom: 20px; color: #b40d0d; text-align: center;">Inicio de sesión</h4>
            <?php $validation = \Config\Services::validation(); ?>
            <form method="POST" action="<?php echo base_url('enviar-login') ?>" class="form-login" style="display: flex; flex-direction: column;">
                <div class="mb-3 form-group" id="user-group" style="margin-bottom: 15px;">
                    <input type="text" name="usuario" class="form-control border-3 border-dark" style="padding: 10px; border-radius: 3px;" placeholder="Usuario">
                    <?php if ($validation->getError('usuario')) { ?>
                        <div class='alert alert-danger mt-2' style="color: red;"><?= $error = $validation->getError('usuario'); ?></div>
                    <?php } ?>
                </div>
                <div class="mb-3 form-group" id="pass-group" style="margin-bottom: 15px;">
                    <input name="password" type="password" class="form-control border-3 border-dark" style="padding: 10px; border-radius: 3px;" placeholder="Contraseña">
                    <?php if ($validation->getError('password')) { ?>
                        <div class='alert alert-danger mt-2' style="color: red;"><?= $error = $validation->getError('password'); ?></div>
                    <?php } ?>
                </div>
                <button type="submit" class="boton2" style="padding: 10px; background-color: #007bff; color: #fff; border: none; border-radius: 3px; cursor: pointer;">Ingresar</button>
                <hr style="margin: 20px 0;">
                <?php if(session()->getFlashdata('msg')):?>
                    <div class="alert alert-danger" style="color: red;"><?= session()->getFlashdata('msg') ?></div>
                <?php endif;?>
            </form>
        </section>
    </div>

</body>
</html>


