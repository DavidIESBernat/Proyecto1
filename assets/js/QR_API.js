// https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=http://pitstop.com/?controlador=pedido&accion=mostrarPedido&num=${numPedido}

 let idPedido = document.getElementById('idPedido').value;
 console.log(idPedido);
 
 let url = `https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=http://pitstop.com/?controlador=pedido&accion=mostrarPedido&num=${idPedido}`
 console.log(url);