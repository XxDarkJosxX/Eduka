const listclases = document.querySelector('#course-toc-2');

document.addEventListener("DOMContentLoaded",function(){
    getcurso();
})

// Obtener información de suscripción del usuario mediante AJAX
$.ajax({
    url: baseurl + "/Contenido/getusuario",
    type: "GET",
    dataType: "json",
    success: function (data) {
        const suscripcion = data.suscripcion; // Obtener el valor de suscripción del usuario

        // Cargar las plataformas de forma dinámica mediante Ajax
        $.ajax({
            url: baseurl + "/Contenido/getclases",
            type: "GET",
            dataType: "json",
            success: function (data) {
                const clases = data;

                // Generar HTML de las plataformas
                const clasesHTML = `
                    ${clases.map(function (clase) {
                    return `
                            <div class="accordion__menu-link">
                                ${clase.iconp}
                                <a class="flex" onclick="checkPrivacy(${clase.privacidad}, ${clase.idclases}, ${suscripcion})">${clase.titclase}</a>
                                <span class="text-muted">8m 42s</span>
                            </div>
                        `;
                }).join('')}
                `;

                // Agregar las plataformas al elemento listclases
                listclases.innerHTML = clasesHTML;
            },
            error: function (xhr, status, error) {
                console.log("Error al cargar las plataformas:", error);
            }
        });
    },
    error: function (xhr, status, error) {
        console.log("Error al obtener información del usuario:", error);
    }
});


// Función para comprobar la privacidad y mostrar la alerta
function checkPrivacy(privacidad, idclase, suscripcion) {
    if (suscripcion === 0) {
        if (privacidad === 0) {
            swal("Alerta", "La clase es privada", "error");
        } else if (privacidad === 1) {
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = baseurl + '/Contenido/asingclases/' + idclase;
            request.open("GET", ajaxUrl, true);
            request.send();
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    window.location = baseurl + "/Video";
                }
            };
        }
    } else if (suscripcion === 1) {
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = baseurl + '/Contenido/asingclases/' + idclase;
        request.open("GET", ajaxUrl, true);
        request.send();
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                window.location = baseurl + "/Video";
            }
        };
    }
}





const titulo = document.querySelector('.tituloclase');
const descripcion = document.querySelector('#descripclase');
const autor = document.querySelector('#idautor');

function getcurso(){
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    //El getusuario esta en Singular !Cuidado confunfir!
    var ajaxUrl = baseurl + '/Contenido/getcurso';
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
    
            var objdata = JSON.parse(request.responseText);
    
            if (objdata.estado) {

                titulo.innerHTML= objdata.titulo;
                descripcion.innerHTML=objdata.descripcion;
                autor.innerHTML= objdata.nombre + " " + objdata.apellidos;

            } else {
                swal("Error", objdata.msg, "error");
            }
        }
    }
}