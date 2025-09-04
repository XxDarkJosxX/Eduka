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


