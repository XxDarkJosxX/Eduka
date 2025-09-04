var tablero;
//Esto es un js
document.addEventListener("DOMContentLoaded", function () {

    //Insert
    var forminsert = document.querySelector("#formregistro");
    forminsert.onsubmit = function (e) {
        e.preventDefault();

        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = baseurl + '/Registros/setregistros';
        var formdata = new FormData(forminsert);
        request.open("POST", ajaxUrl, true);
        request.send(formdata);
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {

                var obdata = JSON.parse(request.responseText);

                if (obdata.status) {

                    swal("Usuario Creado", obdata.msg, "success");
                } else {
                    swal("Error", obdata.msg, "error");

                }
            }
        }   
    }

}, false);


window.handleCredentialResponse = function(response) {
    const datosUsuario = parseJwt(response.credential);

    // Mostrar datos en la página (opcional)
    document.getElementById('status').innerText =
      `Hola ${datosUsuario.given_name}, tu correo es ${datosUsuario.email}`;

    // Preparar datos para enviar
    const formData = new FormData();
    formData.append("txtcorreo", datosUsuario.email);
    formData.append("txtnombre", datosUsuario.given_name);
    formData.append("txtapellido", datosUsuario.family_name);

    // No necesitamos contraseña

    // Enviar POST al servidor
    alert(baseurl + "/Registros/setregistrosgoogle)");
    fetch(baseurl + "/Registros/setregistrosgoogle", {
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
