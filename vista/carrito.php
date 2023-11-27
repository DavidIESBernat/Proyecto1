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
        <a href="<?=url.'?controlador=producto&accion=destruir_carrito'?>">Vaciar carrito</a>
    </div>
    <div class="secciones-carrito">
        <?php if($_SESSION['selecciones']){ ?>
            <div class="carrito">
                <?php foreach ($_SESSION['selecciones'] as $pedido) { ?>
                    <div class="producto">
                        <div class="producto-imagen" style="background-image:url(assets/images/<?= $pedido->getProducto()->getImagen()?>)"></div>
                        <div class="producto-info">
                            <div class="producto-text">
                                <div class="producto-nombre"><?= $pedido->getProducto()->getNombre() ?></div>
                                <div class="producto-precio"><?= number_format($pedido->getProducto()->getPrecio(), 2,',','.') ?>€</div>
                            </div>
                            <div class="producto-seccion-derecha">
                                
                                <!--<div class="producto-ingredientes">
                                    Boton Ingredientes *funcion eliminada*
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
                                </div>-->

                                <form class="producto-cantidad" action="" method="POST">
                                    <button type="submit" name="menos" class="quantity-button restar"> - </button>
                                    <input type="hidden" name="cantidad" value="<?=$pedido->getCantidad()?>">
                                    <div class="quantity-value"><?=$pedido->getCantidad()?></div>
                                    <button type="submit" name="mas" class="quantity-button"> + </button>
                                </form>
                            </div>
                        </div>
                        <div class="boton-eliminar-producto">
                            <form action="" method="POST">
                            <input type="hidden" name="cantidad" value="0">
                                <button type="submit" name="eliminar" class="quantity-button eliminar-button"> x </button>
                            </form>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="resumen-carrito">
                <p class="title-resumen-carrito">TU SELECCIÓN</p>
                <div class="product-line"></div>
                <table class="tabla-carrito">
                    <!--Bucle para crear cada producto añadido al carrito en la tabla-->
                    <?php foreach ($_SESSION['selecciones'] as $pedido) { ?>
                        <tr>
                            <div>
                                <td class="capitalize"><?= $pedido->getProducto()->getNombre() ?></td>
                            </div>
                            <div>
                                <td class="d-flex justify-content-end"><?= number_format($pedido->getProducto()->getPrecio(), 2,',','.') ?>€ * </td>
                                <td><?= $pedido->getCantidad()?>u</td>
                            </div>
                        </tr>
                        <tr><td colspan="3" class="product-line"></td></tr>
                    <?php } ?>
                </table>
            </div>
            <?php } else {?>
                <h1>El carrito esta vacio</h1>
            <?php }?>
        </div>
    </div>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>