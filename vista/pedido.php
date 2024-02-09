<!DOCTYPE html PUBLIC>
<html lang="es">
<head>
    <title>Pedido Nº<?=$idPedido?> - Restaurante Pit-Stop</title>

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
    <div class="col-10 pedidoContainer">
        <div class="tituloContainer">
            <h1 class="titulo">Pedido Nº<?=$idPedido?></h1>
            <input type="hidden" name="idPedido" id="idPedido" value="<?=$idPedido?>">
        </div>
            <div class="row no-margin-row pedido">
                <div class="col-12 col-md-8 col-lg-12 pedidoInfo">
                    <div class="text-align-center fecha textPedido">Fecha: <?= date('d-m-Y', strtotime($pedido->fecha)) ?></div>
                    <div class="text-align-center textPedido">Pedido n.º<?=$idPedido?></div>
                    <div class="text-align-center precioTotal textPedido">Total productos: <?=number_format($pedido->precioTotal, 2,',','.')?>€</div>
                </div>
                <div class="row no-margin-row">
                    <?php foreach($productosPedido as $productoPedido) {?>
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
                    <?php } ?>
                </div>
                <div class="col-12 pedidoInfoInferior">
                    <div class="text-align-center fecha textPedido">Puntos aplicados: <?=$pedido->puntos?></div>
                    <div class="text-align-center textPedido">Propina: <?=$pedido->porcentajePropina?>%</div>
                    <div class="text-align-center precioTotal textPedido">Importe Total: <?=number_format($pedido->importeTotal, 2,',','.')?>€</div>
                </div>
            </div>
            <div class="sectionQR col-12 pedidoInfoInferior">
                <h4>Escanea el codigo QR para compartir el pedido actual</h4>
                <div id="codigoQR"></div>
            </div>
        </div>
        
    </div>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
    <script src="assets/js/QR_API.js"></script>
</body>
</html>