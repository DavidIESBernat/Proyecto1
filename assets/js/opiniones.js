let resultado = fetch("http://pitstop.com/?controlador=api&accion=mostrar_opiniones")
.then( data => data.json())
.then( resultado => {
    console.log(resultado)
});
