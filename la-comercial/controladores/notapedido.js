const codigos = document.getElementsByName('spancodigo');
const nombres = document.getElementsByName('spannombre');
const precios = document.getElementsByName('spanprecio');
const cantidades = document.getElementsByName('inputcantidad');

const detalle = document.getElementById("detalle");

let cantidad;
let precio;
let totales = [];
let totalPedido = 0;



function calcularPedido() {

    detalle.innerHTML = '';

    for (let i = 0; i < codigos.length; i++) {
        cantidad = cantidades[i].value;
        if (cantidad > 0) {
            precio = parseFloat(precios[i].innerHTML);
            totales[i] = cantidad * precio;
            totalPedido += totales[i];

            detalle.innerHTML += `
            <tr>
                        <td> ${codigos[i].innerHTML} </td>
                        <td> ${nombres[i].innerHTML} </td>
                        <td> ${cantidades[i].value} </td>
                        <td>$ ${precios[i].innerHTML} .-</td>
                        <td>$ ${totales[i]} .-</td>
                    </tr>
            `
        }
    }

    // Mostrar Resultados

    document.getElementById("totalpedido").innerHTML = "$ " + totalPedido + ".-";
}