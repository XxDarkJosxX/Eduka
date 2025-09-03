// Esta función se llama automáticamente después de que el usuario inicia sesión
// Google le pasa un objeto "response" que contiene el ID token
function handleCredentialResponse(response) {
    console.log("196182658810-m7hquanr8amisbr3rrpi91hs5jeag9hs.apps.googleusercontent.com" + response.credential);

    // Decodificar el token para obtener los datos del usuario
    const token = response.credential;
    const datosUsuario = parseJwt(token);

    console.log("Datos del usuario:", datosUsuario);

    // Muestra los datos en la página
    document.getElementById('status').innerHTML =
        `¡Hola, ${datosUsuario.given_name}! <br> Tu correo es: ${datosUsuario.email}.`,
        `¡Hola, ${datosUsuario.family_name}! <br> Tu nombre es: ${datosUsuario.family_name}.`,
        `¡Hola, ${datosUsuario.sub}! <br> Tu correo es: ${datosUsuario.sub}.`;


    // Aquí es donde enviarías los datos a tu servidor
    // Por ejemplo:
    // const usuario = {
    //    nombre: datosUsuario.given_name,
    //    apellido: datosUsuario.family_name,
    //    email: datosUsuario.email,
    //    googleId: datosUsuario.sub
    // };
    // enviarDatosAlServidor(usuario);
}

// Función para decodificar el ID Token (el JWT)
function parseJwt (token) {
    const base64Url = token.split('.')[1];
    const base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
    const jsonPayload = decodeURIComponent(atob(base64).split('').map(function(c) {
        return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
    }).join(''));

    return JSON.parse(jsonPayload);
}