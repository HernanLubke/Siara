<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Catálogo de productos</title>
    <!-- Diseño responsivo -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: rgba(240, 229, 74, 0.795);"> <!-- Cambia el color de fondo a amarillo claro -->
<div class="container mt-5">
    <h2 class="text-center mb-4">Catálogo de productos</h2>
    <div class="row">
        <?php foreach ($productos as $producto): ?>
            <div class="col-6 col-sm-4 col-md-3 mb-4">
                <div class="card">
                    <img src="<?= base_url('uploads/' . $producto['url_imagen']) ?>" class="card-img-top" alt="<?= $producto['nombre'] ?>">
                    <div class="card-body">
                        <h5 class="card-title" style="color: black;"><?= $producto['nombre'] ?></h5>
                        <p class="card-text" style="color: black;"><?= isset($producto['descripcion']) ? $producto['descripcion'] : 'No hay descripción disponible' ?></p>
                        <p class="card-text" style="color: black;"><strong>Precio: </strong><?= $producto['precio'] ?></p>
                        <p class="card-text" style="color: black;"><strong>Cantidad: </strong><?= $producto['cantidad'] ?></p>
                        <form action="<?php echo base_url('CarritoController/agregar/' . $producto['id_producto']); ?>">
                            <button class="btn btn-primary btn-block">Carrito</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</body>
</html>
