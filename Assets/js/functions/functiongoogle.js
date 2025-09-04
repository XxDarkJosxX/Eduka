window.handleCredentialResponse = function(response) {
    const datosUsuario = parseJwt(response.credential);

    // Mostrar datos en la página (opcional)
    document.getElementById('status').innerText =
      `Hola ${datosUsuario.given_name}, tu correo es ${datosUsuario.email}`;

    // Preparar datos para enviar
    const formData = new FormData();
    formData.append("txtemail", datosUsuario.email);
    formData.append("txtnombre", datosUsuario.given_name);
     // o family_name si quieres apellido
    // No necesitamos contraseña

    // Enviar POST al servidor
    fetch(baseurl + "/Login/loginusergoogle", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if(data.status) {
            // Redirigir a la cuenta
            window.location = baseurl + "/Cuenta";
        } else {
            swal("Error", data.msg, "error");
        }
    })
    .catch(err => {
        console.error(err);
        swal("Error", "Error en el proceso", "error");
    });
};
