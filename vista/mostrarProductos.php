<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tabla Productos</title>
    </head>
    <style>
        img {
            width: 100px;
        }
    </style>
    <body>
        <a href="<?=url.'?controlador=producto'?>">Volver</a>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Imagen
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Categoría</th>
                <th>Modificar</th>
                <th>Eliminar</th>
            </tr>
            <?php foreach ($productos as $producto) { ?>
                <tr>
                    <td><?= $producto['idProducto'] ?></td>
                    <td><img src="assets/images/<?= $producto['imagen'] ?>"></td>
                    <td><?= $producto['nombre'] ?></td>
                    <td><?= $producto['descripcion'] ?></td>
                    <td><?= number_format($producto['precio'], 2) ?>€</td>
                    <td><?= $producto['categoria']?></td>
                    <td>
                        <form action="<?= url.'?controlador=producto&accion=modificarProducto&id=' . $producto['idProducto'] ?>" method="POST">
                            <input type="submit" value="Modificar">
                        </form>
                    </td>
                    <td>
                        <form action="<?= url.'?controlador=producto&accion=eliminarProducto&id=' . $producto['idProducto'] ?>" method="POST">
                            <input type="submit" value="Eliminar">
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </table>
        <form action="<?= url.'?controlador=producto&accion=nuevoProducto'?>" method="POST">
            <input type="submit" value="Añadir Producto">
        </form>
    </body>
</html>