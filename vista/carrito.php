<!DOCTYPE html PUBLIC>
<html lang="es">
<head>
    <title>Carta - Restaurante Pit-Stop</title>

    <meta charset="UTF-8">
    <meta name="description" content="Descripció web">
    <meta name="keywords" content="Paraules clau">
    <meta name="author" content="Autor">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/full_estil.css" rel="stylesheet" type="text/css" media="screen">

</head>
<body>
    <header></header>
    <main>
        <table id="productos">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
            </tr>
            <!--Bucle para crear cada producto añadido al carrito en la tabla-->
            <?php foreach ($_SESSION['selecciones'] as $pedido) { ?>
            <tr>
                <td><?= $pedido->getProducto()->getId() ?></td>
                <td><?= $pedido->getProducto()->getNombre() ?></td>
                <td><?= $pedido->getProducto()->getDescripcion()?></td>
                <td><?= number_format($pedido->getProducto()->getPrecio(), 2) ?>€</td>
            </tr>
            <?php } ?>
        </table>
    </main>
    <footer></footer>

</body>
</html>