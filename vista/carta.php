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
    <header>
        <!--Navegador-->
    </header>
    <main>
        <!--Seccion Header/Titulo-->
        <div class="section-header bg-white text-center d-flex align-items-center justify-content-center ">
            <div class="header-text">
              <h2 class="title-section">Carta del restaurante <strong class="text-red">Pit-Stop</strong></h2>
              <p class="text-section">¡Disfruta de una amplia gama de productos con los que se te hara la boca agua!</p>
            </div>
        </div>
        <!--Container Categorias-->
        <div class="row no-margin-row container-categories d-flex justify-content-center">
            <div class="col-12 category-header">
                <h1 class="category-title">Categorías</h1>
                <div class="category-line"></div>
            </div>
            <!--Categoria Hamburguesa-->
            <a href="#hamburguesas" class="col-4 card category" style="width: 360px">
                <img src="assets/images/smash-burger.jpg" class="card-img-top" alt="Hamburguesa">
                <div class="card-body">
                    <div class="card-body-top">
                        <h5 class="card-title">HAMBURGUESAS</h5>
                        <p class="card-text">Descubre la amplia variedad de hamburguesas y elige tu favorita</p>
                    </div>
                    <div class="card-body-bottom">
                        <p class="red-button">VER MÁS</p>
                    </div>
                </div>
            </a>
            <!--Categoria Pizza-->
            <a href="#pizzas" class="col-4 card category" style="width: 360px">
                <img src="assets/images/PIZZA.jpeg" class="card-img-top" alt="Pizza">
                <div class="card-body">
                    <div class="card-body-top">
                        <h5 class="card-title">PIZZAS</h5>
                        <p class="card-text">Descubre nuestras pizzas y elige tu favorita, disponibles en tamaño individual, mediana y familiar</p>
                    </div>
                    <div class="card-body-bottom">
                        <p class="red-button">VER MÁS</p>
                    </div>
                </div>
            </a>
            <!--Categoria Pasta-->
            <a href="#pasta" class="col-4 card category" style="width: 360px">
                <img src="assets/images/pasta.jpg" class="card-img-top" alt="Pasta">
                <div class="card-body">
                    <div class="card-body-top">
                        <h5 class="card-title">PASTA</h5>
                        <p class="card-text">Descubre nuestra pasta para los mas fans de la comida italiana</p>
                    </div>
                    <div class="card-body-bottom">
                        <p class="red-button">VER MÁS</p>
                    </div>
                </div>
            </a>
            <!--Categoria Ensaladas-->
            <a href="#ensaladas" class="col-4 card category" style="width: 360px">
                <img src="assets/images/ENSALADA 2.jpg" class="card-img-top" alt="Ensalada">
                <div class="card-body">
                    <div class="card-body-top">
                        <h5 class="card-title">ENSALADAS</h5>
                        <p class="card-text">Descubre una amplia variedad de ensaladas</p>
                    </div>
                    <div class="card-body-bottom">
                        <p class="red-button">VER MÁS</p>
                    </div>
                </div>
            </a>
            <!--Categoria Bebidas-->
            <a href="#bebidas" class="col-4 card category" style="width: 360px">
                <img src="assets/images/bebida.jpg" class="card-img-top" alt="Bebida">
                <div class="card-body">
                    <div class="card-body-top">
                        <h5 class="card-title">BEBIDAS</h5>
                        <p class="card-text">Descubre nuestra amplia variedad de bebidas</p>
                    </div>
                    <div class="card-body-bottom">
                        <p class="red-button">VER MÁS</p>
                    </div>
                </div>
            </a>
            <!--Categoria Postres-->
            <a href="#postres" class="col-4 card category" style="width: 360px">
                <img src="assets/images/FLAN.jpg" class="card-img-top" alt="Postre">
                <div class="card-body">
                    <div class="card-body-top">
                        <h5 class="card-title">POSTRES</h5>
                        <p class="card-text">Descubre nuestra amplia variedad de postres dulces y salados</p>
                    </div>
                    <div class="card-body-bottom">
                        <p class="red-button">VER MÁS</p>
                    </div>
                </div>
            </a>
        </div>
        <!--CONTAINER PRODUCTOS-->
        <div class="row no-margin-row container-products d-flex justify-content-center">
            <!--Seccion Hamburguesas-->
            <div class="col-12 category-header">
                <h1 class="category-title">Hamburguesas</h1>
                <div class="category-line"></div>
            </div>
            <div id="hamburguesas" class="d-flex justify-content-center">
            <?php foreach ($productos as $producto) { 
                if($producto['categoria'] == "Hamburguesa") {?>
                    <div class="col-4 card category" style="width: 360px">
                            <img src="assets/images/<?= $producto['imagen'] ?>" class="card-img-top" alt="<?= $producto['imagen'] ?>">
                            <div class="card-body">
                                <div class="card-body-top">
                                    <h5 class="card-title"><?= $producto['nombre'] ?></h5>
                                    <p class="precio"><?= $producto['precio'] ?>€</p>
                                    <p class="card-text"><?= $producto['descripcion'] ?></p>
                                </div>
                                <div class="card-body-bottom align-items-bottom">
                                    <p class="red-button">AÑADIR AL CARRITO</p>
                                </div>
                            </div>
                        </div>
                <?php }
            } ?>
            </div>
            <!--Seccion Pizza-->
            <div class="col-12 category-header">
                <h1 class="category-title">Pizzas</h1>
                <div class="category-line"></div>
            </div>
            <div id="pizzas" class="d-flex justify-content-center">
                <?php foreach ($productos as $producto) { 
                    if($producto['categoria'] == "Pizza") {?>
                        <div class="col-4 card category" style="width: 360px">
                                <img src="assets/images/<?= $producto['imagen'] ?>" class="card-img-top" alt="<?= $producto['imagen'] ?>">
                                <div class="card-body">
                                    <div class="card-body-top">
                                        <h5 class="card-title"><?= $producto['nombre'] ?></h5>
                                        <p class="precio"><?= $producto['precio'] ?>€</p>
                                        <p class="card-text"><?= $producto['descripcion'] ?></p>
                                    </div>
                                    <div class="card-body-bottom">
                                        <p class="red-button">AÑADIR AL CARRITO</p>
                                    </div>
                                </div>
                            </div>
                    <?php }
                } ?>
            </div>
            <!--Seccion Pasta-->
            <div class="col-12 category-header">
                <h1 class="category-title">Pasta</h1>
                <div class="category-line"></div>
            </div>
            <div id="pasta" class="d-flex justify-content-center">
                <?php foreach ($productos as $producto) { 
                    if($producto['categoria'] == "Pasta") {?>
                        <div class="col-4 card category" style="width: 360px">
                                <img src="assets/images/<?= $producto['imagen'] ?>" class="card-img-top" alt="<?= $producto['imagen'] ?>">
                                <div class="card-body">
                                    <div class="card-body-top">
                                        <h5 class="card-title"><?= $producto['nombre'] ?></h5>
                                        <p class="precio"><?= $producto['precio'] ?>€</p>
                                        <p class="card-text"><?= $producto['descripcion'] ?></p>
                                    </div>
                                    <div class="card-body-bottom">
                                        <p class="red-button">AÑADIR AL CARRITO</p>
                                    </div>
                                </div>
                            </div>
                    <?php }
                } ?>
            </div>
            <!--Seccion Ensalada-->
            <div class="col-12 category-header">
                <h1 class="category-title">Ensaladas</h1>
                <div class="category-line"></div>
            </div>
            <div id="ensaladas" class="d-flex justify-content-center">
                <?php foreach ($productos as $producto) { 
                    if($producto['categoria'] == "Ensalada") {?>
                        <div class="col-4 card category" style="width: 360px">
                                <img src="assets/images/<?= $producto['imagen'] ?>" class="card-img-top" alt="<?= $producto['imagen'] ?>">
                                <div class="card-body">
                                    <div class="card-body-top">
                                        <h5 class="card-title"><?= $producto['nombre'] ?></h5>
                                        <p class="precio"><?= $producto['precio'] ?>€</p>
                                        <p class="card-text"><?= $producto['descripcion'] ?></p>
                                    </div>
                                    <div class="card-body-bottom">
                                        <p class="red-button">AÑADIR AL CARRITO</p>
                                    </div>
                                </div>
                            </div>
                    <?php }
                } ?>
            </div>
            <!--Seccion Bebida-->
            <div class="col-12 category-header">
                <h1 class="category-title">Bebidas</h1>
                <div class="category-line"></div>
            </div>
            <div id="bebidas" class="d-flex justify-content-center">
                <?php foreach ($productos as $producto) { 
                    if($producto['categoria'] == "Bebida") {?>
                        <div class="col-4 card category" style="width: 360px">
                                <img src="assets/images/<?= $producto['imagen'] ?>" class="card-img-top" alt="<?= $producto['imagen'] ?>">
                                <div class="card-body">
                                    <div class="card-body-top">
                                        <h5 class="card-title"><?= $producto['nombre'] ?></h5>
                                        <p class="precio"><?= $producto['precio'] ?>€</p>
                                        <p class="card-text"><?= $producto['descripcion'] ?></p>
                                    </div>
                                    <div class="card-body-bottom">
                                        <p class="red-button">AÑADIR AL CARRITO</p>
                                    </div>
                                </div>
                            </div>
                    <?php }
                } ?>
            </div>
            <!--Seccion Postre-->
            <div class="col-12 category-header">
                <h1 class="category-title">Postres</h1>
                <div class="category-line"></div>
            </div>
            <div id="postres" class="d-flex justify-content-center">
                <?php foreach ($productos as $producto) { 
                    if($producto['categoria'] == "Postre") {?>
                        <div class="col-4 card category" style="width: 360px">
                                <img src="assets/images/<?= $producto['imagen'] ?>" class="card-img-top" alt="<?= $producto['imagen'] ?>">
                                <div class="card-body">
                                    <div class="card-body-top">
                                        <h5 class="card-title"><?= $producto['nombre'] ?></h5>
                                        <p class="precio"><?= $producto['precio'] ?>€</p>
                                        <p class="card-text"><?= $producto['descripcion'] ?></p>
                                    </div>
                                    <div class="card-body-bottom">
                                        <p class="red-button">AÑADIR AL CARRITO</p>
                                    </div>
                                </div>
                            </div>
                    <?php }
                } ?>
            </div>
        </div>
    </main>
    <footer>
        <!--Footer-->
    </footer>
</body>