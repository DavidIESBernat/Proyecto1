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
                        </tr>
                        <tr>
                                <form action=<?=url.'?controlador=producto&accion=editarProducto'?> method='POST'>
                                        <input type='hidden' name='id' value=<?=$producto['idProducto']?>>
                                        <td><input name='idDesactivado' disabled value=<?=$producto['idProducto']?>></td>
                                        <td><input name='nombre' value=<?=$producto['nombre']?>></td>
                                        <td><input name='descripcion' value=<?=$producto['descripcion']?>></td>
                                        <td><input name='precio' value=<?=$producto['precio']?>></td>
                                        <td><input name='categoria' value=<?=$producto['categoria']?>></td>
                                        <td><input name='imagen' value=<?=$producto['imagen']?>></td>
                                        <td><input type="submit" name="editar" value="Modificar"></td>
                                </form>
                        </tr>
                </table>
        </body>
</html>