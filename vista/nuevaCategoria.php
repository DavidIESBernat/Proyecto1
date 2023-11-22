<!DOCTYPE html>
<html lang="es">
<head>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Añadir Categoria</title>
</head>
        <body>
                <h1>Añadir  nueva categoria</h1>
                <a href="<?=url.'?controlador=producto&accion=mostrarProductos'?>">Volver</a>
                <table border="1">
                        <tr>
                                <th>Nombre*</th>
                                <th>Descripcion</th>
                                <th>Imagen</th>
                        </tr>
                        <tr>
                                <form action=<?=url.'?controlador=producto&accion=añadirCategoria'?> method='POST'>
                                        <td><input name='nombre' value="" required></td>
                                        <td><input name='descripcion' value=""></td>
                                        <td><input name='imagen' value=""></td>
                                        <td><input type="submit" name="Añadir" value="Añadir"></td>
                                </form>
                        </tr>
                </table>
        </body>
</html>