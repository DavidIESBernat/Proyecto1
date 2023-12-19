<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Categoria - Administrador</title>
</head>
    <body>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Imagen</th>
                <th></th>
            </tr>
            <tr>
                <a href="<?=url.'?controlador=categoria&accion=mostrarCategorias'?>">Volver</a>
                <form action=<?=url.'?controlador=categoria&accion=editarCategoria'?> method='POST'>
                    <input type='hidden' name='id' value="<?=$id?>">
                    <td><input name='idDesactivado' disabled value="<?=$id?>"></td>
                    <td><input type="text" name='nombre' value="<?=$categoria->getNombre()?>"></td>
                    <td><input type="text" name='descripcion' size="100" value="<?= $categoria->getDescripcion()?>"></td>
                    <td><input name='imagen' value="<?=$categoria->getImagen()?>"></td>
                    <td><input type="submit" name="editar" value="Modificar"></td>
                </form>
            </tr>
        </table>
    </body>
</html>