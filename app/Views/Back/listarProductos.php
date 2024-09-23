<?php $titulo = "Lista de Productos"; ?>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success text-center">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>
<div class="container mt-5">
    <h2 class="text-center mb-4">Listas de Productos</h2>
    <div class="row mb-4">
        <div class="col-md-4">
            <a class="btn btn-success" href="<?= base_url('agregarProducto') ?>">Agregar Producto</a>
        </div>
        <div class="col-md-4 text-end">
            <a class="btn btn-dark" href="<?= base_url('ProductosDadosDeBaja') ?>">Ver Productos dados de baja</a>
        </div>
    </div>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger">
            <?= $error ?>
        </div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-light table-bordered text-center">
                <thead class="thead-light">
                    <tr>
                        <th>Categoría</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Imagen</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productos as $producto): ?>
                        <?php if ($producto['activo'] !== 'no'): ?>
                            <tr>
                                <td>
                                    <?php
                                    // Obtener la categoría del producto
                                    $categoriaModel = new \App\Models\CategoriaModel();
                                    $categoria = $categoriaModel->find($producto['id_categoria']);
                                    echo $categoria ? $categoria['nombre'] : 'Sin categoría';
                                    ?>
                                </td>
                                <td><?= $producto['nombre'] ?></td>
                                <td><?= $producto['descripcion'] ?></td>
                                <td><?= $producto['precio'] ?></td>
                                <td><?= $producto['cantidad'] ?></td>
                                <td>
                                    <img src="<?= base_url('uploads/' . $producto['url_imagen']) ?>" alt="Imagen del producto" class="img-fluid" style="max-width: 100px;">
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="<?= base_url('ProductosController/editar/' . $producto['id_producto']); ?>" class="btn btn-success">Editar</a>
                                        <a href="<?= site_url('ProductosController/darDeBaja/' . $producto['id_producto']) ?>" class="btn btn-danger">Dar de baja</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>
<br></br><br></br><br></br><br></br>
