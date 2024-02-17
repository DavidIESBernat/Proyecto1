# Proyecto Restaurante Pit-Stop

## Descripción
Este proyecto consiste en la creación de una pagina web para un restaurante en el "Circuit de Barcelona Catalunya", en el podrás registrarte, ver la carta y realizar pedidos de lo que quieras consumir en el mismo. 

## Implementación
 Se ha utilizado un sistema Modelo-Vista-Controlador (MVC) y varios lenguajes de programación para desarrollar la pagina web y todas sus funcionalidades.
### MVC
- **Modelo:** Gestiona los datos que se utilizaran posteriormente y la lógica de los mismos.
- **Vista:** Contiene toda la parte HTML a mostrar por pantalla (Interfaz de usuario).
- **Controlador:** Es el encargado de manejar las interacciones entre el modelo y la vista.

### Tecnologias Utilizadas
- **Frontend:** HTML, CSS, Bootstrap, JavaScript.
- **Backend:** PHP.

## Funcionalidades
 > Listado de todas las funcionalidades implementadas.

### Carta
- Mostrar todos los productos
- Filtrar por Categoría
- Mostrar un producto
- Seleccionar cantidad
- Añadir producto al carrito

### Carrito
- Lista de productos seleccionados
- Cantidades seleccionadas
- Obtener y gastar puntos a cambio de descuentos
- Aplicar propina a una comanda
- Precio final

### Usuario
- Inicio de sesión 
- Registrarse
- Modificar perfil
- Cerrar sesión
- Consultar pedidos
- Opciones exclusivas del administrador
	- CRUD de productos
	- CRUD de categorías

### Reseñas
- Ver reseñas
- Publicar reseña
- Filtrar reseñas por puntuación
- Mostrar reseñas por puntuación

## Funciones implementadas con JS (JavaScript)

 > Explicación breve de las funciones con uso de JavaScript.
 
### Mostrar reseñas
Para mostrar las reseñas se realiza un **fetch** que llama a la api y obtiene las mismas de la base de datos, luego se llama a la función mostrarReseñas que recibe las opiniones y las incluye en la vista mediante **innerHTML**.

### Publicar reseña
Para publicar la reseña primero se debe seleccionar el botón para añadir una reseña, este cambia el contenido de el contenedor donde se encuentran las reseñas por el formulario. Una vez rellenemos el formulario, los valores se obtendrán mediante getElementById y se enviara haciendo uso de **fetch** de tipo POST a la api, esta llamara al modelo correspondiente para guardarlo en la base de datos.

### Filtrar reseñas por puntuación
Para filtrar las reseñas por puntuación se comprueba el valor del select que esta seleccionado mediante **getElement**. Para obtener las reseñas en orden ascendente o descendente se hace uso de el atributo **sort** que las devuelve ordenadas en un array.

### Mostrar reseñas por puntuación
Para mostrar unicamente las reseñas de una determinada puntuación se utiliza un select en el que se selecciona la nota de las reseñas que deseamos ver, esta se obtiene mediante un **getElement** y se hace uso de el atributo **filter** junto a una operación de tipo flecha que nos devuelve las reseñas de esa determinada nota, luego esta llama a la función para mostrarlas.

### Filtrar productos de la carta por categoría
Para filtrar los productos de la carta se esta haciendo uso de checkbox, según las checkbox seleccionadas que obtenemos cuando se pulsa el botón filtrar este mostrara los productos de las categorías seleccionadas y ocultara el resto mediante una clase CSS.  

Las checkbox seleccionadas se obtienen cuando el usuario selecciona el botón filtrar, este ejecuta un evento que mediante un atributo de JS llamado **querySelectorAll** en el que se hace una comprobación para detectar si el input a sido seleccionado o no se guardan en un array, con este array se modifica su contenedor en el código HTML haciendo uso de **classList.remove** o **classList.add** que añade o elimina la clase que oculta los contenedores HTML.

### Generar código QR
> Se muestra en la vista de un pedido, al escanearlo te llevara a esa misma pagina.

El sistema QR esta implementado haciendo uso de una libreria, esta incluye poder crear un objeto de tipo QR a la que le proporcionamos la ruta donde queremos que vaya, unicamente con esto y definiendo el tamaño que queremos ya se creara dicho QR en el documento que hayamos seleccionado mediante **getElementByID**.

### Sistema de puntos
El sistema de puntos es un sistema que te proporciona unos puntos según lo que has gastado, por cada 1€ gastado obtendrás 10puntos y por cada 100 puntos gastados obtendrás 1€ de descuento en tu compra. El script JS obtiene el valor de puntos del input mediante **getElementByID**, comprueba que es un valor mayor o igual que 0 y no superior al numero total de puntos disponibles de este usuario. *Es necesario iniciar sesion*.

### Aplicar propina en una comanda
Para aplicar propina a una comanda se hace uso de un input que por defecto tiene un valor de 3, este input a su vez guarda dicho valor en un **localStorage** para guardar el valor de la propina que hemos seleccionado anteriormente. La propina se aplica al precio total de los productos sin aplicar los descuentos por puntos. También se mostrara junto a la propina el porcentaje seleccionado en euros. *Es necesario iniciar sesion*.

### Mostrar precio Final
El precio final se genera tomando el precio de los productos seleccionados mas el descuento por puntos y la propina aplicada. Este se modifica automáticamente cuando se modifica algún campo relacionado ya que lo calcula en tiempo real y lo muestra haciendo uso de **innerHTML** para modificar el valor donde se muestra. También se hace uso de atributos especiales para que los decimales se muestren con una coma y no un punto y unicamente con un máximo de 2 decimales, para ello se hace uso de **toFixed** y **replace**.

### NotieJS
En la sección de reseñas esta implementado NotieJS, una librería que muestra notificaciones personalizadas, en este caso se usa cuando filtramos las reseñas o añadimos una nueva, es tan sencillo como añadir un **notie.alert()** para mostrarlas.

## Problemas y Soluciones

### Sistema de puntos
- **Problema:** El input donde se seleccionan los puntos a gastar en un pedido podía ser mayor al numero máximo de puntos disponibles
- **Solución:** Crear un condicional que evite que el valor del input sea mayor al de los puntos disponibles, los puntos gastados serán igual al numero  máximo de puntos disponibles y no a los del valor del input.

### Actualizar el carrito al realizar un pedido
- **Problema:** Al readaptar el sistema con el que se envía la información del pedido a javascript no se muestra el carrito vació aunque si el pedido se ha realizado correctamente y recargamos con F5 este estará vació. 
- **Solución:** Modificar el contenido de secciones-carrito haciendo uso de innerHTML para modificar el contenido al del carrito vacio.

### Mostrar una nueva reseña al ser añadida
- **Problema:** Cuando se publicaba una nueva reseña esta no se mostraba en la lista de reseñas a no ser que se recargase la pagina. 
- **Solución:** Añadir la reseña al array de opiniones mediante un push, de esta forma ya se puede mostrar sin necesidad de recargar la pagina.

### Obtener la fecha actual para guardarla a la hora de publicar una reseña
- **Problema:** Al necesitar obtener la fecha actual en el momento que se publica una reseña y estar utilizando javascript no servían los métodos de php.
- **Solución:** Utilizar atributos propios de javascript como .getFullYear() para obtener el año o .getMonth() para el mes, estos se guardan en una variable y luego son unidos en una única variable que sera la que se envié por fetch para ser guardada junto al resto de información.

### Filtrar por categoría en la carta
- **Problema:**  Mantener el sistema actual de PHP de como se obtienen los valores de esta ventana, ya sean categorías o productos pero poder hacer uso de filtros de tipo checkbox con JS.
- **Solución:** Hacer uso del atributo display_none de CSS para ocultar la informacion que no se desea mostrar, solo se debe actualizar el contenedor que no se quiere mostrar añadiendole dicha clase mediante classList.add() o classList.remove() segun lo deseado.
