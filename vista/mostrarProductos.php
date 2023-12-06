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
        <table>
            <tr>
                <td>
                    <form action="<?= url.'?controlador=producto'?>" method="POST">
                        <input type="submit" value="Volver">
                    </form>
                </td>
                <h1>Gestionar Productos</h1>
                <td>
                    <form action="<?= url.'?controlador=categoria&accion=mostrarCategorias'?>" method="POST">
                        <input type="submit" value="Mostrar Categorias">
                    </form>
                </td>    
                <td>
                    <form action="<?= url.'?controlador=producto&accion=nuevoProducto'?>" method="POST">
                        <input type="submit" value="Nuevo Producto">
                    </form>
                </td>
            </tr>
        </table>

        <table border="1">
            <tr>
                <th>ID</th>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Categoría</th>
                <th>Modificar</th>
                <th>Eliminar</th>
            </tr>
            <?php foreach ($productos as $producto) { ?>
                <tr>
                    <td><?= $producto->getId() ?></td>
                    <td><img src="assets/images/<?= $producto->getImagen() ?>"></td>
                    <td><?= $producto->getNombre() ?></td>
                    <td><?= $producto->getDescripcion() ?></td>
                    <td><?= number_format($producto->getPrecio(), 2) ?>€</td>
                    <?php foreach ($categorias as $categoria) { 
                        if($categoria->getId() == $producto->getCategoria()) { ?>
                            <td><?= $categoria->getId()?> - <?=$categoria->getNombre()?></td>
                    <?php } }?>
                    
                    <td>
                        <form action="<?= url.'?controlador=producto&accion=modificarProducto'?>" method="POST">
                            <input type="hidden" name="id" value="<?=$producto->getId()?>">
                            <input type="submit" value="Modificar">
                        </form>
                    </td>
                    <td>
                        <form action="<?= url.'?controlador=producto&accion=eliminarProducto'?>" method="POST">
                            <input type="hidden" name="id" value="<?=$producto->getId()?>">
                            <input type="submit" value="Eliminar">
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </body>
</html>