<?php $titulo = "Agregar Productos"; ?>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titulo ?></title>
</head>
<body style="display: flex; justify-content: center; align-items: center; height: 100vh; background-color: rgba(245, 233, 66, 0.795); margin: 0;">

    <div style="display: flex; align-items: center; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border-radius: 10px; overflow: hidden; background-color: #fff;">
        <!-- Imagen -->
        <img src="assets/img/siara-logo1.png" alt="Imagen" style="width: 300px; height: auto; padding: 20px;">

        <!-- Formulario -->
        <section id="producto" style="padding: 40px; box-sizing: border-box; max-width: 500px; width: 100%;">
            <h4 style="margin-bottom: 15px; color: #b40d0d; text-align: center;">Ingresar los datos del producto</h4>
            <form action="<?= base_url('productosController/store') ?>" method="post" enctype="multipart/form-data" style="display: flex; flex-direction: column;">
                <div style="max-width: 400px; margin: 0 auto;"> <!-- Ajuste del ancho máximo -->
                    <div class="form-group">
                        <label for="nombre" style="color: #000;">Nombre:</label>
                        <input id="nombre" value="<?= old('nombre') ?>" class="form-control border-dark" type="text" name="nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="descripcion" style="color: #000;">Descripción:</label>
                        <input id="descripcion" value="<?= old('descripcion') ?>" class="form-control border-dark" type="text" name="descripcion" required>
                    </div>
                    <div class="form-group">
                        <label for="precio" style="color: #000;">Precio:</label>
                        <input id="precio" value="<?= old('precio') ?>" class="form-control border-dark" type="number" name="precio" min="0" required>
                    </div>
                    <div class="form-group">
                        <label for="cantidad" style="color: #000;">Cantidad:</label>
                        <input id="cantidad" value="<?= old('cantidad') ?>" class="form-control border-dark" type="number" name="cantidad" min="0" required>
                    </div>
                    <div class="form-group">
                        <label for="categoria" style="color: #000;">Categoría:</label>
                        <select id="categoria" name="categoria" class="form-control border-dark" required>
                            <option value="" selected>Seleccione una categoría</option>
                            <?php foreach ($categorias as $categoria): ?>
                                <option value="<?= $categoria['id_categoria'] ?>"><?= $categoria['nombre'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="imagen" style="color: #000;">Imagen:</label>
                        <input id="imagen" class="form-control-file border-dark" type="file" name="imagen" required>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-primary" type="submit">Guardar</button>
                        <a href="<?= base_url('listarProductos') ?>" class="btn btn-secondary">Cancelar</a>
                    </div>
                </div></br>
            </form>
        </sec>
     </section> 
   </div>
  </body>
</html></br></br></br>
                    
