<!DOCTYPE html PUBLIC>
<html lang="es">
<head>
    <title>Perfil de Usuario - Restaurante Pit-Stop</title>

    <meta charset="UTF-8">
    <meta name="description" content="Descripció web">
    <meta name="keywords" content="Paraules clau">
    <meta name="author" content="David Valero">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link href="assets/css/producto.css" rel="stylesheet" type="text/css" media="screen">
    
</head>
<body>
    <div class="mainContainer row no-margin-row">
        <div class="tituloContainer col-12">
            <h1 class="tituloProducto"><?=$producto->getNombre()?></h1>
        </div>
        <div class="productoContainer col-12 row no-margin-row">
            <img class="imagenProducto col-12 col-md-4" src="assets/images/<?=$producto->getImagen()?>" alt="<?=$producto->getImagen()?>">
            <div class="textoContainer col-12 col-md-8">
                <div class="descripcion textMargin"><?=$producto->getDescripcion()?>
                <?php if ($producto->getCategoria() == 5) { // Si el producto es una instancia de bebida mostrara los ml?>
                    <!-- Mostrar el campo ml solo si es una Bebida -->
                    <br>Cantidad: <?= $producto->getMl(); ?>ml
                <?php } ?>
                </div>
                <div class="flex-row row no-margin-row">
                    <div class="precio textMargin col-12 col-md-4">Precio: <?=number_format($producto->getPrecio(), 2,',','.')?>€/u</div>
                    <form class="producto-cantidad col-md-4" action="<?=url."?controlador=producto&accion=mostrarProducto"?>" method="POST">
                        <input type="hidden" name="id" value="<?=$producto->getId() ?>">
                        <input type="hidden" name="cantidad" value="<?=$cantidad ?>">
                        <button type="submit" name="Del" class="quantity-button restar"> - </button>
                        <div class="quantity-value"><?=$cantidad?></div>
                        <button type="submit" name="Add" class="quantity-button"> + </button>
                    </form>
                    <form class="container-btnInclinado-producto col-md-4" action="<?=url."?controlador=producto&accion=sel#".$producto->getId()?>" method="POST">
                        <input type="hidden" name="id" value="<?=$producto->getId()?>">
                        <input type="hidden" name="cantidad" value="<?=$cantidad?>">
                        <button type="submit "class="btnInclinado">
                        <div class="btnInclinado-textContainer">
                            <div class="btnInclinado-text">AÑADIR AL CARRITO</div>
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
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>