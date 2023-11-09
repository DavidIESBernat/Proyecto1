<!DOCTYPE html>
<html lang="es">
<head>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Modificar Producto</title>
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
                                <form action=<?=url.'?controlador=producto&accion=editarProducto'?> method='POST'>
                                        <input type='hidden' name='id' value="<?=$producto['idProducto']?>">
                                        <td><input name='idDesactivado' disabled value="<?=$producto['idProducto']?>"></td>
                                        <td><input type="text" name='nombre' value="<?=$producto['nombre']?>"></td>
                                        <td><input type="text" name='descripcion' size="100" value="<?= $producto['descripcion']?>"></td>
                                        <td><input type="double" name='precio' size="8" value="<?=$producto['precio']?>"></td>
                                        <td>
                                                <select name="categoria" required><
                                                        <option value="<?=$producto['categoria']?>" selected>Actual: <?=$producto['categoria']?></option>
                                                        <option disabled>- Asignar nueva -</option>
                                                        <option value="Hamburguesa">Hamburguesa</option>
                                                        <option value="Pizza">Pizza</option>
                                                        <option value="Pasta">Pasta</option>
                                                        <option value="Ensalada">Ensalada</option>
                                                        <option value="Bebida">Bebida</option>
                                                        <option value="Postre">Postre</option>
                                                </select>
                                        </td>
                                        <td><input name='imagen' value="<?=$producto['imagen']?>"></td>
                                        <td><input type="submit" name="editar" value="Modificar"></td>
                                </form>
                        </tr>
                </table>
        </body>
</html>