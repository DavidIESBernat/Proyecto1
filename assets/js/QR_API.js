// https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=http://pitstop.com/?controlador=pedido&accion=mostrarPedido&num=${numPedido}

 let idPedido = document.getElementById('idPedido').value;
 console.log(idPedido);
 var url= `http://pitstop.com/?controlador=pedido&accion=mostrarPedido&num=${idPedido}`;

        // Crear un objeto QRCode con la URL como contenido
        var qr = new QRCode(document.getElementById("codigoQR"), {
            text: url,
            width: 200,
            height: 200
        });