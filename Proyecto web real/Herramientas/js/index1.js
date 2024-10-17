
document.getElementById('gen').addEventListener("click",GenerarContraseñas)
// ----------------------------------------
// Generador de contraseñas seguras
// ----------------------------------------

function GenerarContraseñas() {
    const length = parseInt(document.getElementById('length').value);
    const charset = [
        document.getElementById('includeUppercase').checked ? 'ABCDEFGHIJKLMNOPQRSTUVWXYZ' : '',
        document.getElementById('includeLowercase').checked ? 'abcdefghijklmnopqrstuvwxyz' : '',
        document.getElementById('includeNumbers').checked ? '0123456789' : '',
        document.getElementById('includeSymbols').checked ? '!@#$%^&*()_+[]{}|;:,.<>?' : ''
    ].join('');

    if (charset.length === 0) {
        document.getElementById('result').innerText = '¡Debes seleccionar al menos un tipo de carácter!';
        return;
    }

    let password = '';
    for (let i = 0; i < length; i++) {
        password += charset.charAt(Math.floor(Math.random() * charset.length));
    }

    document.getElementById('result').innerText = password;
}
