<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Usuarios</title>
</head>
<body>

<h1 style="text-align: center;">Lista de Usuarios</h1>
<a href="<?= site_url('registro') ?>" style="display: inline-block; margin-bottom: 1px; padding: 8px 12px; background-color: #007bff; color: #fff; text-decoration: none; border-radius: 3px; margin-left: 193px;  width: 120px;">Crear Usuario</a>
   <div style="overflow-x: auto; max-width: 980px; margin: 0 auto;"> <!-- Aquí se centra el formulario horizontalmente -->
        <table border="6" style="border-collapse: collapse;">
            <tr style="background-color: #f2f2f2;">
                <th style="padding: 6px; text-align: left; width: 80px;">ID</th>
                <th style="padding: 6px; text-align: left; width: 160px;">Nombre</th>
                <th style="padding: 6px; text-align: left; width: 160px;">Apellido</th>
                <th style="padding: 6px; text-align: left; width: 140px;">Usuario</th>
                <th style="padding: 6px; text-align: left; width: 250px;">Email</th>
                <th style="padding: 6px; text-align: left; width: 180px;">Acciones</th>
            </tr>
            <?php foreach ($usuarios as $usuario): ?>
            <tr>
                <td style="padding: 5px; text-align: left;"><?= $usuario['Id_usuario'] ?></td>
                <td style="padding: 5px; text-align: left;"><?= $usuario['Nombre'] ?></td>
                <td style="padding: 5px; text-align: left;"><?= $usuario['Apellido'] ?></td>
                <td style="padding: 5px; text-align: left;"><?= $usuario['Usuario'] ?></td>
                <td style="padding: 5px; text-align: left;"><?= $usuario['Email'] ?></td>
                <td style="padding: 5px; text-align: left;">
                    <!-- Enlace para editar el usuario -->
                    <a href="<?= site_url('Usuario_controller/edit/' . $usuario['Id_usuario']) ?>" style="padding: 6px 8px; background-color: #28a745; color: #fff; text-decoration: none; border: none; border-radius: 3px;">Editar</a>

                    <!-- Formulario para eliminar el usuario -->
                    <form action="<?= site_url('Usuario_controller/delete/' . $usuario['Id_usuario']) ?>" method="post" style="display:inline;">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" style="padding: 4px 8px; background-color: #dc3545; color: #fff; text-decoration: none; border: none; border-radius: 3px;">Eliminar</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>


