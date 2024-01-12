<!DOCTYPE html PUBLIC>
<html lang="es">
<head>
    <title>Mis Pedidos - Restaurante Pit-Stop</title>

    <meta charset="UTF-8">
    <meta name="description" content="Descripció web">
    <meta name="keywords" content="Paraules clau">
    <meta name="author" content="Autor">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link href="assets/css/pedidos.css" rel="stylesheet" type="text/css" media="screen">

</head>
<body>
    <div class="row no-margin-row mainContainer">
        <!--Solo entra si detecta que $pedidos existe y contiene mas de un valor, en caso contrario mostrara que no hay pedidos-->
        <?php if(isset($pedidos) && count($pedidos) > 0) { ?>
            <div class="col-10 pedidoContainer">
                <div class="tituloContainer">
                    <h1 class="titulo">Mis pedidos</h1>
                </div>
                <?php foreach($pedidos as $pedido) { ?>
                    <div class="row no-margin-row pedido">
                        <div class="col-12 col-md-8 col-lg-12 pedidoInfo">
                            <div class="text-align-center fecha textPedido">Fecha: <?= date('d-m-Y', strtotime($pedido->fecha)) ?></div>
                            <div class="text-align-center textPedido">Pedido n.º<?=$pedido->idPedido?></div>
                            <div class="text-align-center precioTotal textPedido">Total: <?=number_format($pedido->precioTotal, 2,',','.')?>€</div>
                        </div>
                        <div class="row no-margin-row">
                            <?php foreach($productosPedido as $productoPedido) {
                                if($productoPedido->idPedido == $pedido->idPedido) { ?>
                                    <div class="col-12 col-md-8 col-lg-6 producto">
                                    <?php foreach($productos as $producto) {
                                        if($producto->getId() == $productoPedido->idProducto) { ?>
                                            <div class="imagen" style="background-image:url(assets/images/<?= $producto->getImagen() ?>)"></div>
                                            <div class="productoInfo">
                                                <div class="infoLeft">
                                                    <div class="textProducto textTituloProducto"><?=$producto->getNombre()?></div>
                                                    <div class="textProducto"><?=number_format($producto->getPrecio(), 2,',','.')?>€/u</div> 
                                                </div>
                                                <div class="infoRight">
                                                    <div class="textProducto">Cantidad: <?=$productoPedido->cantidad?></div>
                                                    <div class="textProducto"><?=number_format($productoPedido->precio, 2,',','.')?>€</div> 
                                                </div>
                                            </div>
                                        <?php } } ?>
                                    </div>
                            <?php } } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php } else {?>
            <div class="col-12 pedidos-vacio">
                <h1>No hay pedidos que mostrar</h1>
            </div>
        <?php }?>
    </div>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>