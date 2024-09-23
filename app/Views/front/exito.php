<?php
// Cargar el navbar
echo view('front/navbar2');
?>


<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <style>
        /* Estilos generales */
        body {
            font-family: Arial, sans-serif;
            background-color: rgba(240, 229, 74, 0.795); /* Cambiar el color de fondo a amarillo */
            padding-top: 20px;
            margin: 0; /* Añadido para evitar el margen predeterminado del body */
        }
        .container {
            width: 80%; /* Ajustado para ocupar todo el ancho */
            max-width: 800px;
            margin: auto;
            padding: 0 15px; /* Agregamos padding horizontal */
        }
        .titulo {
            color: #007bff;
        }
        .card {
            background-color: #fff; /* Fondo blanco */
            border: 1px solid #dee2e6;
            border-radius: .25rem;
            margin-bottom: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border-bottom: none;
        }
        .card-body {
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #dee2e6;
            padding: 8px;
            text-align: left;
            color: black;
        }
        th {
            background-color: #f7f7f9;
        }
        tfoot th {
            background-color: #e9ecef;
        }

        /* Estilos responsive */
        @media (max-width: 768px) {
            .container {
                padding: 0 10px; /* Reducir el padding horizontal */
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h1 class="titulo text-center">Pago Confirmado</h1>
    <p class="text-center">¡Gracias por tu compra! El pago se ha confirmado correctamente.</p>

    <!-- Mostrar el comprobante de pago -->
    <div class="card">
        <div class="card-header text-center">
            <h2>Comprobante de Pago</h2>
        </div>
        <div class="card-body">
            <?php if (isset($factura['id'])): ?>
                <p><strong>Número de Factura:</strong> <?= $factura['id'] ?></p>
            <?php endif; ?>

            <?php if (isset($factura['usuario'])): ?>
                <p><strong>Usuario:</strong> <?= $factura['usuario'] ?></p>
            <?php endif; ?>

            <!-- Detalles de la factura -->
            <h3 class="mt-4">Detalles de la Factura</h3>
            <table>
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Subtotal</th>
                        <th>Fecha de Compra</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($detalles as $detalle): ?>
                        <tr>
                            <td><?= $detalle['producto']->nombre ?></td>
                            <td><?= $detalle['cantidad'] ?></td>
                            <td>$<?= $detalle['producto']->precio ?></td>
                            <td>$<?= $detalle['subtotal'] ?></td>
                            <td><?= $factura['fecha'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3" class="text-end">Total:</th>
                        <th>$<?= $factura['importe_total'] ?></th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
            <!-- Fin de detalles de la factura -->
        </div>
    </div>
</div>

</body>
</html>
