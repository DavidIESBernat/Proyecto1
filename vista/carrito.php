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
    <link href="assets/css/carrito.css" rel="stylesheet" type="text/css" media="screen">

</head>
<body class="bg-black">
    <div class="row no-margin-row secciones-carrito">
        <?php if($_SESSION['selecciones']){ ?>
            <div class="col-12 col-md-12 col-lg-10 carrito">
                <div class="fondo-carrito">
                    <div class="titulo-carrito">
                        <h1 class="">Carrito</h1>
                        <a class="btnVaciar" href="<?=url.'?controlador=pedido&accion=destruir_carrito'?>">Vaciar carrito</a>
                    </div>
                </div>
                <div class="row no-margin-row justify-content-center">
                    <div class="col-12 col-md-10 col-lg-8">
                        <?php
                        $pos = 0;
                        foreach ($_SESSION['selecciones'] as $pedido) { ?>
                            <div class="producto d-flex flex-direction-row">
                                <div class="producto-imagen" style="background-image:url(assets/images/<?= $pedido->getProducto()->getImagen()?>)"></div>
                                <div class="producto-info">
                                    <div class="producto-text">
                                        <div class="producto-nombre"><?= $pedido->getProducto()->getNombre() ?></div>
                                        <div class="producto-precio"><?= number_format($pedido->getProducto()->getPrecio(), 2,',','.') ?>€</div>
                                    </div>
                                    <div class="producto-seccion-derecha">
                                        <form class="producto-cantidad" action="<?=url?>?controlador=pedido&accion=carrito" method="POST">
                                            <input type="hidden" name="id" value="<?= $pedido->getProducto()->getId() ?>">
                                            <button type="submit" name="Del" value="<?=$pos?>" class="quantity-button restar"> - </button>
                                            <div class="quantity-value"><?=$pedido->getCantidad()?></div>
                                            <button type="submit" name="Add" value="<?=$pos?>"  class="quantity-button"> + </button>
                                        </form>
                                    </div>
                                </div>
                                <div class="boton-eliminar-producto">
                                    <form action="<?=url?>?controlador=pedido&accion=carrito" method="POST">
                                        <input type="hidden" name="id" value="<?= $pedido->getProducto()->getId() ?>">
                                        <input type="hidden" name="cantidad" value="0">
                                        <button type="submit" name="Eliminar" value="<?=$pos?>" class="quantity-button eliminar-button"> x </button>
                                    </form>
                                </div>
                            </div>
                        <?php $pos++; } ?>
                    </div>
                    <div class="col-12 col-md-10 col-lg-4 resumen-carrito">
                        <div>
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
                                            <td class="d-flex justify-content-end"><?= number_format($pedido->getProducto()->getPrecio() * $pedido->getCantidad(), 2,',','.') ?>€ * </td>
                                            <td><?= $pedido->getCantidad()?>u</td>
                                        </div>
                                    </tr>
                                    <tr><td colspan="3"><div class="product-line"></div></td></tr>
                                <?php } ?>
                            </table>
                        </div>
                        <div>
                            <div class="div-precio-total">
                                <div class="texto-precio-total">Total Selección:</div>
                                <div class="precio-total"><?= number_format($precioTotal, 2,',','.') ?> €<span class="iva-precio-total">IVA incluido</span></div>
                            </div>
                            <form class="container-btnInclinado" action="<?=url?>?controlador=pedido&accion=confirmarPedido" method="POST">
                                <button class="btnInclinado">
                                    <div class="btnInclinado-textContainer">
                                        <div class="btnInclinado-text">REALIZAR PEDIDO</div>
                                    </div>
                                    <div class="btnInclinado-arrow">
                                        <svg viewBox="-2.4 -2.4 28.80 28.80" id="btnInclinado-arrowImage" xmlns="http://www.w3.org/2000/svg" stroke="#000000" stroke-width="0.00024000000000000003" transform="matrix(1, 0, 0, 1, 0, 0)rotate(0)"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#fffCCCCCC" stroke-width="0.288"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M12.2929 4.29289C12.6834 3.90237 13.3166 3.90237 13.7071 4.29289L20.7071 11.2929C21.0976 11.6834 21.0976 12.3166 20.7071 12.7071L13.7071 19.7071C13.3166 20.0976 12.6834 20.0976 12.2929 19.7071C11.9024 19.3166 11.9024 18.6834 12.2929 18.2929L17.5858 13H4C3.44772 13 3 12.5523 3 12C3 11.4477 3.44772 11 4 11H17.5858L12.2929 5.70711C11.9024 5.31658 11.9024 4.68342 12.2929 4.29289Z"></path> </g></svg>
                                    </div>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php } else {?>
                <div class="col-12 carrito-vacio">
                    <h1>El carrito esta vacio</h1>
                </div>
            <?php }?>
        </div>
    </div>
    <div class="section-footer-bottom"></div>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>