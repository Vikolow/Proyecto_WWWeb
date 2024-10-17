document.querySelector(".convertir").addEventListener("click",convertirNumero)



// ----------------------------------------
// Conversor Decimal a Binario y Hexadecimal
// ----------------------------------------

function convertirNumero() {
    let decimal = document.getElementById('numero-decimal').value;
    
    if (isNaN(decimal) || decimal === "") {
        document.getElementById('resultado-conversion').innerText = "Por favor, introduce un número válido.";
        return;
    }

    let binario = parseInt(decimal).toString(2);  // Conversión a binario
    let hexadecimal = parseInt(decimal).toString(16).toUpperCase();  // Conversión a hexadecimal

    let resultado = `Binario: ${binario}\nHexadecimal: ${hexadecimal}`;
    document.getElementById('resultado-conversion').innerText = resultado;
}
