<!DOCTYPE html PUBLIC>
<html lang="es">
<head>
    <title>Carta - Restaurante Pit-Stop</title>

    <meta charset="UTF-8">
    <meta name="description" content="Descripció web">
    <meta name="keywords" content="Paraules clau">
    <meta name="author" content="David Valero">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/full_estil.css" rel="stylesheet" type="text/css" media="screen">

</head>
<body class="bg-black">
    <!--Seccion Header/Titulo-->
    <div class="section-header bg-white text-center d-flex align-items-center justify-content-center ">
        <div class="header-text">
            <h2 class="title-section">Carta del restaurante <strong class="text-red">Pit-Stop</strong></h2>
            <p class="text-section">¡Disfruta de una amplia gama de productos con los que se te hara la boca agua!</p>
        </div>
    </div>
    <!--Container Categorias-->
    <div class="row no-margin-row container-categories d-flex justify-content-center">
        <div class="col-10 category-header">
            <h1 class="category-title">Categorías</h1>
        </div>
        <!--Mostrar todas las Categorias-->
        <?php foreach ($categorias as $categoria) {?>
            <a href="#<?= $categoria->getId()?>" class="col-4 card category">
            <div class="product-image" style="background-image:url(assets/images/<?= $categoria->getImagen()?>)"></div>
                <div class="card-body">
                    <div class="card-body-top">
                        <h5 class="card-title"><?= $categoria->getNombre()?></h5>
                        <p class="card-text"><?= $categoria->getDescripcion()?></p>
                    </div>
                    <div class="card-body-bottom">
                        <p class="red-button">VER MÁS</p>
                        <svg width="15" id="arrow_svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"><path d="m31.71 15.29-10-10-1.42 1.42 8.3 8.29H0v2h28.59l-8.29 8.29 1.41 1.41 10-10a1 1 0 0 0 0-1.41z" data-name="3-Arrow Right"/></svg>
                    </div>
                </div>
            </a>
        <?php } ?>

    <!--CONTAINER PRODUCTOS-->
    <div class="row no-margin-row container-products d-flex justify-content-center">
        <!-- Mostrar todos los productos por su categoria -->
        <!-- Bucle para crear el titulo de la categoria actual-->
        <?php foreach ($categorias as $categoria) { ?>
            <div id="<?=$categoria->getId()?>" class="col-10 category-header">
                <h1 class="category-title"><?=$categoria->getNombre()?></h1>
            </div>
            <!-- Mostrar productos para la categoria actual-->
            <div class="col-10 row no-margin-row d-flex justify-content-center">
                <?php foreach ($productos as $producto) { 
                    if($producto->getCategoria() == $categoria->getId()) {?>
                        <form action="<?=url."?controlador=producto&accion=sel#".$producto->getId() ?>" method="POST" class="col-4 card category">
                            <button id="0<?=$producto->getId()?>" class="btn btn-no-margin" type="submit">
                                <input type="hidden" name="id" value="<?=$producto->getId()?>">
                                <div class="product-image" style="background-image:url(assets/images/<?= $producto->getImagen() ?>)"></div>
                                <div class="card-body section-text">
                                    <div class="card-body-top">
                                        <h5 class="card-title"><?= $producto->getNombre() ?></h5>
                                        <p class="precio"><?= number_format($producto->getPrecio(), 2,',','.') ?>€</p>
                                        <p class="card-text"><?= $producto->getDescripcion() ?></p>
                                    </div>
                                    <div class="card-body-bottom align-items-bottom btnAñadir">
                                        <form action="<?=url."?controlador=producto&accion=sel#".$producto->getId() ?>" method="POST" class="btn">
                                            <p class="red-button">AÑADIR AL CARRITO</p>
                                        </form>
                                        <svg width="15" id="arrow_svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"><path d="m31.71 15.29-10-10-1.42 1.42 8.3 8.29H0v2h28.59l-8.29 8.29 1.41 1.41 10-10a1 1 0 0 0 0-1.41z" data-name="3-Arrow Right"/></svg>
                                    </div>
                                </div>
                            </button>
                        </form>
                    <?php }
                }  ?>
            </div>
        <?php } ?>  
        </div>
    </div>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>