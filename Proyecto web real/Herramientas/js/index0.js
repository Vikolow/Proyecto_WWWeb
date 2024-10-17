
document.querySelector(".calcular").addEventListener("click",calcularIP)

// Función que convierte una IP decimal a binario (Reutilizable)
function ipADecimalABinario(ip) {
    return ip.split('.').map(octeto => {
        return ('00000000' + parseInt(octeto).toString(2)).slice(-8);
    }).join('.');
}

// Función que convierte binario a decimal (Reutilizable)
function binarioADecimal(bin) {
    return bin.split('.').map(octeto => {
        return parseInt(octeto, 2);
    }).join('.');
}

// Función AND bit a bit entre IP y máscara
function operacionAND(ipBinaria, mascaraBinaria) {
    const ipArr = ipBinaria.split('.');
    const mascaraArr = mascaraBinaria.split('.');
    return ipArr.map((octeto, i) => {
        return (parseInt(octeto, 2) & parseInt(mascaraArr[i], 2)).toString(2).padStart(8, '0');
    }).join('.');
}

// Función que obtiene la dirección de broadcast
function obtenerBroadcast(redBinaria, mascaraBinaria) {
    const bitsHosts = mascaraBinaria.split('.').map(octeto => {
        return octeto.replace(/1/g, '0').replace(/0/g, '1');  // Invertir los bits de la máscara
    });
    const redArr = redBinaria.split('.');
    return redArr.map((octeto, i) => {
        return (parseInt(octeto, 2) | parseInt(bitsHosts[i], 2)).toString(2).padStart(8, '0');
    }).join('.');
}

// Función auxiliar para dividir una cadena binaria de 32 bits en octetos (Reutilizable)
function dividirEnOctetos(binario32) {
    return binario32.match(/.{1,8}/g).join('.');
}

// Función para sumar uno a una dirección IP binaria (Reutilizable)
function sumarUnoBinario(ipBinaria) {
    let ipDecimal = parseInt(ipBinaria.replace(/\./g, ''), 2); // Convertir a decimal
    ipDecimal += 1;  // Sumar uno
    let nuevaIPBinaria = ipDecimal.toString(2).padStart(32, '0'); // Convertir de nuevo a binario
    return dividirEnOctetos(nuevaIPBinaria);
}

// Función para restar uno a una dirección IP binaria (Reutilizable)
function restarUnoBinario(ipBinaria) {
    let ipDecimal = parseInt(ipBinaria.replace(/\./g, ''), 2); // Convertir a decimal
    ipDecimal -= 1;  // Restar uno
    let nuevaIPBinaria = ipDecimal.toString(2).padStart(32, '0'); // Convertir de nuevo a binario
    return dividirEnOctetos(nuevaIPBinaria);
}


// Calculadora IP
function calcularIP() {
    const ip = document.getElementById('ip-address').value;
    const subnetMask = document.getElementById('subnet-mask').value;
    
    // Convertir IP y máscara a su versión binaria
    const ipBinaria = ipADecimalABinario(ip);
    const mascaraBinaria = ipADecimalABinario(subnetMask);
    
    // Dirección de red: operación AND bit a bit
    const direccionRedBinaria = operacionAND(ipBinaria, mascaraBinaria);
    const direccionRed = binarioADecimal(direccionRedBinaria);
    
    // Dirección de broadcast
    const direccionBroadcastBinaria = obtenerBroadcast(direccionRedBinaria, mascaraBinaria);
    const direccionBroadcast = binarioADecimal(direccionBroadcastBinaria);
    
    // Rango de Hosts
    const primerHostBinario = sumarUnoBinario(direccionRedBinaria);
    const ultimoHostBinario = restarUnoBinario(direccionBroadcastBinaria);
    const primerHost = binarioADecimal(primerHostBinario);
    const ultimoHost = binarioADecimal(ultimoHostBinario);
    
    // Mostrar resultados
    let resultado = `Dirección de Red: ${direccionRed}\n`;
    resultado += `Dirección de Broadcast: ${direccionBroadcast}\n`;
    resultado += `Primer Host Válido: ${primerHost}\n`;
    resultado += `Último Host Válido: ${ultimoHost}\n`;
    
    document.getElementById('resultado-ip').innerText = resultado;
}
