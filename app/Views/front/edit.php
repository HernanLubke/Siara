<div class="contenedor" style="padding: 20px; background-color: rgba(240, 229, 74, 0.795);">
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Editar Usuario</title>
    </head>

    <body>
        <h1 style="color: rgb(92, 4, 4); text-align: center;">Editar Usuario</h1>
        
        <form action="<?= site_url('Usuario_controller/update/' . $usuario['Id_usuario']) ?>" method="post" style="max-width: 400px; margin: 0 auto;">
            <div class="form-group" style="margin-bottom: 15px;">
                <label for="nombre" style="font-weight: bold;">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?= htmlentities($usuario['Nombre']) ?>" required style="width: calc(100% - 22px); padding: 10px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box;">
            </div>
            <div class="form-group" style="margin-bottom: 15px;">
                <label for="apellido" style="font-weight: bold;">Apellido:</label>
                <input type="text" id="apellido" name="apellido" value="<?= htmlentities($usuario['Apellido']) ?>" required style="width: calc(100% - 22px); padding: 10px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box;">
            </div>
            <div class="form-group" style="margin-bottom: 15px;">
                <label for="usuario" style="font-weight: bold;">Usuario:</label>
                <input type="text" id="usuario" name="usuario" value="<?= htmlentities($usuario['Usuario']) ?>" required style="width: calc(100% - 22px); padding: 10px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box;">
            </div>
            <div class="form-group" style="margin-bottom: 15px;">
                <label for="email" style="font-weight: bold;">Email:</label>
                <input type="email" id="email" name="email" value="<?= htmlentities($usuario['Email']) ?>" required style="width: calc(100% - 22px); padding: 10px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box;">
            </div>
            
            <div class="form-group" style="margin-bottom: 15px;">
                <button type="submit" style="display: inline-block; padding: 10px 20px; color: #140101; background-color:#2a1ce4;; border: none; border-radius: 5px; cursor: pointer; text-decoration: none;">Guardar Cambios</button>
                <a href="<?= site_url('usuarios') ?>" class="btn-secondary" style="display: inline-block; padding: 10px 20px; color: #fff; background-color: #6c757d; border: none; border-radius: 5px; cursor: pointer; text-decoration: none; margin-right: 10px;">Cancelar</a>
            </div>
        </form>
    </body>
    </html>
</div>
