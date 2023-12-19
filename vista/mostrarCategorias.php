<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tabla Categorias - Administrador</title>
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
                <h1>Gestionar Categorias</h1>
                <td>
                    <form action="<?= url.'?controlador=producto&accion=mostrarProductos'?>" method="POST">
                        <input type="submit" value="Mostrar Productos">
                    </form>
                </td>
                <td>
                    <form action="<?= url.'?controlador=categoria&accion=nuevaCategoria'?>" method="POST">
                        <input type="submit" value="Nueva Categoria">
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
                <th>Modificar</th>
                <th>Eliminar</th>
            </tr>
            <?php foreach ($categorias as $categoria) { ?>
                <tr>
                    <td><?= $categoria->getId() ?></td>
                    <td><img src="assets/images/<?=$categoria->getImagen() ?>"></td>
                    <td><?= $categoria->getNombre() ?></td>
                    <td><?= $categoria->getDescripcion() ?></td>       
                    <td>
                        <form action="<?= url.'?controlador=categoria&accion=modificarCategoria'?>" method="POST">
                            <input type="hidden" name="id" value="<?=$categoria->getId()?>">
                            <input type="submit" value="Modificar">
                        </form>
                    </td>
                    <td>
                        <form action="<?= url.'?controlador=categoria&accion=eliminarCategoria'?>" method="POST">
                            <input type="hidden" name="id" value="<?=$categoria->getId()?>">
                            <input type="submit" value="Eliminar">
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </body>
</html>