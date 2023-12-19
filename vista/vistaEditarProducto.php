<!DOCTYPE html>
<html lang="es">
<head>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Modificar Producto - Administrador</title>
</head>
        <body>
                <table border="1">
                        <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Descripcion</th>
                                <th>Precio</th>
                                <th>Categoria</th>
                                <th>Imagen</th>
                                <th></th>
                        </tr>
                        <tr>
                                <a href="<?=url.'?controlador=producto&accion=mostrarProductos'?>">Volver</a>
                                <form action=<?=url.'?controlador=producto&accion=editarProducto'?> method='POST'>
                                        <input type='hidden' name='id' value="<?=$id?>">
                                        <td><input name='idDesactivado' disabled value="<?=$id?>"></td>
                                        <td><input type="text" name='nombre' value="<?=$producto->getNombre()?>"></td>
                                        <td><input type="text" name='descripcion' size="100" value="<?= $producto->getDescripcion()?>"></td>
                                        <td><input type="double" name='precio' size="8" value="<?=$producto->getPrecio()?>"></td>
                                        <td>
                                                <select name="categoria" required>
                                                <?php foreach ($categorias as $categoria) { 
                                                        if($categoria->getId() == $producto->getCategoria()) { ?>
                                                                <option value="<?=$categoria->getId()?>" selected><?=$categoria->getNombre()?> - Actual</option>
                                                        <?php } else { ?>
                                                                <option value="<?=$categoria->getId()?>"><?=$categoria->getNombre()?></option>
                                                <?php } }?>
                                                </select>
                                        </td>
                                        <td><input name='imagen' value="<?=$producto->getImagen()?>"></td>
                                        <td><input type="submit" name="editar" value="Modificar"></td>
                                </form>
                        </tr>
                </table>
        </body>
</html>