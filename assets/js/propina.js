
function omitirPropina() {
    document.getElementById("propina").value = 0;
}

function actualizarPropina(precioTotal) {
    let porcentajePropina = document.getElementById('propina').value;
    let propinaCalculada = (precioTotal * porcentajePropina) / 100;

    const htmlPropina = document.getElementById('propinaTotal');
    htmlPropina.innerHTML = `${propinaCalculada.toFixed(2)} €`;
    return propinaCalculada;
}
