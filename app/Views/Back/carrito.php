<?php
// Cargar el head
echo view('front/head');
?>

<?php
// Cargar el navbar
echo view('front/navbar2');
?>

<section class="carrito">
 <div class="contenedor">
        <?php if (session()->has('mensaje')): ?>
            <div class="alert text-center alert-danger">
                <?= session('mensaje') ?>
            </div>
        <?php endif; ?>

        <div class="row">
            <h1 class="titulo text-center">Carrito de compras</h1>
        </div>
        <?php if (!empty($productos)): ?>
            <div class="row mt-4">
                <div class="col-lg-12">
                    <table class="table">
                        <thead class="text-uppercase">
                            <tr>
                                <th>Producto</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Subtotal</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($productos as $producto): ?>
                                <tr>
                                    <td>
                                        <?= esc($producto['nombre']) ?>
                                    </td>
                                    <td>$
                                        <?= esc($producto['precio']) ?>
                                    </td>
                                    <td>
                                        <?= esc($producto['cantidad']) ?>

                                        <a href="<?= base_url('carrito/disminuir/' . $producto['id_producto']) ?>"
                                            class="btn btn-sm btn-secondary">-</a>
                                        <a href="<?= base_url('carrito/aumentar/' . $producto['id_producto']) ?>"
                                            class="btn btn-sm btn-secondary">+</a>

                                    </td>
                                    <td>$
                                        <?= esc($producto['subtotal']) ?>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('CarritoController/eliminar/' . $producto['id_producto']) ?>"
                                            class="btn btn-danger btn-sm">Eliminar</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>

                                <td colspan="3"></td>
                                <td>Total:</td>
                                <td>$
                                    <?= esc($total) ?>
                                </td>

                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        <?php else: ?>
            <div class="row mt-4">
                <div class="col-lg-12">
                    <div class="alert  text-center alert-secondary" role="alert">
                        No hay productos en el carrito.
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="row mt-4 mb-5 text-center">
    <div class="col-lg-12 text-center">
        <a href="<?= base_url('catalogoIngresado') ?>" class="btn btn-secondary">Seguir comprando</a>
        <a href="<?= base_url('carrito/checkout') ?>" class="btn btn-success" id="confirmButton">Confirmar compra</a>
        <a href="<?= base_url('carrito/vaciar') ?>" class="btn btn-danger">Vaciar carrito</a>
    </div>
</div>

