<!DOCTYPE html>
<html lang="es">
<head>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Añadir Producto - Administrador</title>
</head>
        <body>
                <h1>Añadir nuevo producto</h1>
                <a href="<?=url.'?controlador=producto&accion=mostrarProductos'?>">Volver</a>
                <table border="1">
                        <tr>
                                <th>Nombre*</th>
                                <th>Descripcion</th>
                                <th>Precio*</th>
                                <th>Categoria*</th>
                                <th>Imagen</th>
                                <th></th>
                        </tr>
                        <tr>
                                <form action=<?=url.'?controlador=producto&accion=añadirProducto'?> method='POST'>
                                        <td><input name='nombre' value="" required></td>
                                        <td><input name='descripcion' value=""></td>
                                        <td><input name='precio' value="" required></td>
                                        <td>
                                                <select name="categoria" required>
                                                        <?php foreach ($categorias as $categoria) {?>
                                                                <option value="<?=$categoria->getId()?>"><?=$categoria->getNombre() ?></option>
                                                        <?php } ?>
                                                </select>
                                        </td>
                                        <td><input name='imagen' value=""></td>
                                        <td><input type="submit" name="Añadir" value="Añadir"></td>
                                </form>
                        </tr>
                </table>
        </body>
</html>