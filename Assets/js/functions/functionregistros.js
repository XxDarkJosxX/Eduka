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
function handleCredentialResponse(response) {
    // Decodificar JWT
    const data = parseJwt(response.credential);

    console.log(data); // Aquí viene el perfil de Google

    // Mandar al backend (tu controlador)
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = baseurl + '/Registros/setregistrosgmail';
    var formData = new FormData();
    formData.append("txtnombre", data.given_name);
    formData.append("txtapellido", data.family_name);
    formData.append("txtcorreo", data.email);


    request.open("POST", ajaxUrl, true);
    request.send(formData);
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var obdata = JSON.parse(request.responseText);
            if (obdata.status) {
                swal("Usuario Creado con Gmail", obdata.msg, "success");
            } else {
                swal("Error", obdata.msg, "error");
            }
        }
    }
}

// Función para decodificar el JWT
function parseJwt(token) {
    var base64Url = token.split('.')[1];
    var base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
    var jsonPayload = decodeURIComponent(atob(base64).split('').map(function(c) {
        return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
    }).join(''));

    return JSON.parse(jsonPayload);
}


