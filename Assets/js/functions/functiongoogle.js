window.handleCredentialResponse = function(response) {
    const token = response.credential;
    const datosUsuario = parseJwt(token);

    console.log("Datos del usuario:", datosUsuario);

    document.getElementById('status').innerHTML = `
      ¡Hola, ${datosUsuario.given_name}! <br>
      Tu correo es: ${datosUsuario.email}
    `;
}

function parseJwt (token) {
    const base64Url = token.split('.')[1];
    const base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
    const jsonPayload = decodeURIComponent(atob(base64).split('').map(function(c) {
        return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
    }).join(''));
    return JSON.parse(jsonPayload);
}
