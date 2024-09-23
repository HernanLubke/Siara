
<?php
$session   = session();
$nombre    = $session->get('Nombre');
$apellido  = $session->get('Apellido');
$perfil    = $session->get('Perfil_id');
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de productos</title>
    <!-- Bootstrap CSS -->
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/estilos.css') ?>" rel="stylesheet">
    <link rel="icon" href="<?= base_url('assets/img/logoicon.png') ?>" type="image/icon type">
</head>
<body style="background-color: rgba(240, 229, 74, 0.795);">
<header>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color: rgb(88, 2, 105);">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?php echo base_url('inicio'); ?>">
                <img src="<?php echo base_url('assets/img/siara-logo2.png'); ?>" alt="Siara" width="105" height="34">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <?php if ($perfil == 1) { ?>
                    <!-- Admin -->
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link text-white" aria-current="page" href="<?php echo base_url('inicio'); ?>">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" aria-current="page" href="<?php echo base_url('usuarios'); ?>">Listado de usuarios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" aria-current="page" href="<?php echo base_url('listarProductos'); ?>">Listado de productos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" aria-current="page" href="<?php echo base_url('CarritoController/compra'); ?>">Compras</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" aria-current="page" href="<?php echo base_url('listarConsulta'); ?>">Consultas recibidas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" aria-current="page" href="<?php echo base_url('logout'); ?>">Cerrar sesión</a>
                        </li>
                    </ul>
                    <a style="color: white;">¡Hola <?=$nombre?>, <?=$apellido?>!</a>
                <?php } elseif ($perfil == 2) { ?>
                    <!-- Cliente -->
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link text-white" aria-current="page" href="<?php echo base_url('inicio'); ?>">Inicio</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Categorías</a>
                            <ul class="dropdown-menu" style="background-color:  rgb(82, 1, 99);">
                                <li><a class="dropdown-item text-white" href="<?php echo base_url('perros'); ?>">Perros</a></li>
                                <li><a class="dropdown-item text-white" href="<?php echo base_url('gatos'); ?>">Gatos</a></li>
                                <li><a class="dropdown-item text-white" href="<?php echo base_url('accesorios'); ?>">Accesorios</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="<?php echo base_url('Comercializacion'); ?>">Comercialización</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="<?php echo base_url('quienesSomos'); ?>">¿Quienes somos?</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="<?php echo base_url("consulta"); ?>">Consulta</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="<?= base_url("CarritoController/compraUsuario") ?>"><i class="bi bi-pass-fill"></i> Mis compras</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="<?= base_url("carrito"); ?>" style="font-size: 20px;">🛒</a>
                            <span id="cantidad-carrito" class="text-white"></span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="<?php echo base_url('logout'); ?>">Cerrar sesión</a>
                        </li>
                    </ul>
                    <a style="color: white;">¡Hola <?=$nombre?>, <?=$apellido?>!</a>
                <?php } else { ?>
                    <!-- Cliente visitante -->
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link text-white" aria-current="page" href="<?php echo base_url('inicio'); ?>">Inicio</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Categorías</a>
                            <ul class="dropdown-menu" style="background-color:  rgb(82, 1, 99);">
                                <li><a class="dropdown-item text-white" href="<?php echo base_url('perros'); ?>">Perros</a></li>
                                <li><a class="dropdown-item text-white" href="<?php echo base_url('gatos'); ?>">Gatos</a></li>
                                <li><a class="dropdown-item text-white" href="<?php echo base_url('accesorios'); ?>">Accesorios</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="<?php echo base_url('Comercializacion'); ?>">Comercialización</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="<?php echo base_url('Contacto'); ?>">Contacto</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="<?php echo base_url('quienesSomos'); ?>">¿Quienes somos?</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="<?php echo base_url('registro'); ?>">Registrarse</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="<?php echo base_url('login'); ?>">Login</a>
                        </li>
                    </ul>
                <?php } ?>
            </div>
        </div>
    </nav>
</header><br><br>

<!-- Contenido de la página -->
<div class="container mt-5">
    <!-- Aquí va tu contenido -->
</div>

<!-- Bootstrap JS y dependencias -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

