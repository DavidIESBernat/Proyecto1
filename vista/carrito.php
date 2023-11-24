<!DOCTYPE html PUBLIC>
<html lang="es">
<head>
    <title>Carrito - Restaurante Pit-Stop</title>

    <meta charset="UTF-8">
    <meta name="description" content="Descripció web">
    <meta name="keywords" content="Paraules clau">
    <meta name="author" content="Autor">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/full_estil.css" rel="stylesheet" type="text/css" media="screen">

</head>
<body class="bg-black">
    <div class="titulo-carrito">
        <h1 class="">Carrito</h1>
    </div>
    <div class="secciones-carrito">
        <div class="carrito">
            <?php if($_SESSION['selecciones']){
                foreach ($_SESSION['selecciones'] as $pedido) { ?>
                    <div class="producto">
                        <div class="producto-imagen" style="background-image:url(assets/images/<?= $pedido->getProducto()->getImagen()?>)"></div>
                        <div class="producto-info">
                            <div class="producto-text">
                                <div class="producto-nombre"><?= $pedido->getProducto()->getNombre() ?></div>
                                <div class="producto-precio"><?= number_format($pedido->getProducto()->getPrecio(), 2,',','.') ?>€</div>
                            </div>
                            <div class="producto-seccion-derecha">
                                
                                <div class="producto-ingredientes">
                                    <!-- Boton Ingredientes -->
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Ingredientes
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="#">Ingredientes</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                    </li>
                                </div>
                                <form class="producto-cantidad" action="" method="POST">
                                    <button type="submit" name="menos" class="quantity-button restar"> - </button>
                                    <input type="hidden" name="cantidad" value="<?=$pedido->getCantidad()?>">
                                    <div class="quantity-value"><?=$pedido->getCantidad()?></div>
                                    <button type="submit" name="mas" class="quantity-button"> + </button>
                                </form>
                            </div>
                            
                        </div>
                    </div>
                <?php }  } else {?>
                    <h1>El carrito esta vacio</h1>
                    <?php }?>
            </div>
            <div class="resumen-carrito">

            </div>
        </div>
    </div>
    



    <a href="<?=url.'?controlador=producto&accion=destruir_carrito'?>">Vaciar carrito</a>
    <table id="productos">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Cantidad</th>
        </tr>
        <!--Bucle para crear cada producto añadido al carrito en la tabla-->
        <?php foreach ($_SESSION['selecciones'] as $pedido) { ?>
        <tr>
            <td><?= $pedido->getProducto()->getId() ?></td>
            <td><?= $pedido->getProducto()->getNombre() ?></td>
            <td><?= $pedido->getProducto()->getDescripcion()?></td>
            <td><?= number_format($pedido->getProducto()->getPrecio(), 2,',','.') ?>€</td>
            <td><?= $pedido->getCantidad()?></td>
        </tr>
        <?php } ?>
    </table>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>