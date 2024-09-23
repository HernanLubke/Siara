<?php $titulo = "ProductosBaja"; ?>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success text-center">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>
<div class="container mt-5">
    <h2 class="text-center mb-4">Productos dados de baja</h2>
    <div class="row mb-4">
        
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
                    <?php if ($producto['activo'] == 'no'): ?>
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
                                        <!-- Aquí está el botón de editar -->
                                        <a href="<?= base_url('editar/' . $producto['id_producto']); ?>" class="btn btn-success"
                                            type="button">Editar</a>

                                        <a href=" <?= site_url('ProductosController/darDeAlta/' . $producto['id_producto']) ?>"
                                            class="btn btn-success">Dar de alta</a>
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
