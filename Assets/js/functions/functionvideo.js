
const cardcurso = document.querySelector('#cardcurso');
const titulo = document.querySelector('.tituloclase');
const descripcion = document.querySelector('#descripclase');

document.addEventListener("DOMContentLoaded",function(){
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = baseurl+'/Video/getcurso';
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange =function(){
        if(request.readyState == 4 && request.status==200){
            //console.log(request.responseText);
            var objdata=JSON.parse(request.responseText);

            cardcurso.innerHTML = `<div  class="media flex-nowrap">
            <div class="media-left mr-16pt">
                <a href="${baseurl}/Contenido"><img src="${baseurl + objdata.portadaurl}"
                         width="40"
                         alt="Angular"
                         class="rounded"></a>
            </div>
            <div class="media-body d-flex flex-column">
                <a href="${baseurl}/Contenido"
                   class="card-title">${objdata.titulo}</a>
                <div class="d-flex">
                    <span class="text-50 small font-weight-bold mr-8pt">${objdata.nombre} ${objdata.apellidos}</span>
                    <!--<span class="text-50 small">Software Engineer and Developer</span>-->
                </div>
            </div>
        </div>`;

     
              
        }
    }

    getclase();
    getComentarios();
},false);



function getclase(){
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = baseurl + '/Video/getclase';
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var objdata = JSON.parse(request.responseText);

            if (objdata.estado) {
                titulo.innerHTML = objdata.titclase;
                descripcion.innerHTML = objdata.descripcion;
                getvideo(objdata.enlace);

                // 🔹 Renderizar archivo adicional si existe
                if (objdata.archivos && objdata.archivourl) {
                    const fileSection = document.querySelector('#fileSection');
                    fileSection.innerHTML = `
                        <div class="card posts-card mb-0">
                            <div class="posts-card__content d-flex align-items-center flex-wrap">
                                <div class="avatar avatar-lg mr-3">
                                    <img src="${baseurl}/Assets/images/file-icon.png" alt="file" class="avatar-img rounded">
                                </div>
                                <div class="posts-card__title flex d-flex flex-column">
                                    <a href="${baseurl + objdata.archivourl}" 
                                       class="card-title mr-3" 
                                       download="${objdata.archivos}">
                                        ${objdata.archivos}
                                    </a>
                                </div>
                                <div class="d-flex align-items-center flex-column flex-sm-row posts-card__meta">
                                    <div class="media ml-sm-auto align-items-center">
                                        <div class="mr-3 text-50 text-uppercase posts-card__tag d-flex align-items-center">
                                            <i class="material-icons text-muted-light mr-1">folder_open</i> Archivo
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>`;
                }

            } else {
                swal("Error", objdata.msg, "error");
            }
        }
    }
}



function getvideo(url) {
  
    
const VIDEO_ID = url;
        const container = document.getElementById('videoContainer');
        const playerDiv = document.getElementById('player');
        const btn = document.getElementById('btnFullscreen');
        const overlayTop = document.getElementById('overlayTop');
        const overlayEnd = document.getElementById('overlayEnd');
        const overlayStart = document.getElementById('overlayStart');
        const loadBtn = document.getElementById('loadVideoBtn');

        function isMobileDevice() {
            return /Mobi|Android|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
        }

        // Crear iframe solo al hacer clic en "Reproducir"
        loadBtn.addEventListener('click', () => {
            playerDiv.innerHTML = `
        <iframe id="dmframe"
            width="100%"
            height="100%"
            frameborder="0"
            allowfullscreen
            allow="autoplay"
            src="https://www.dailymotion.com/embed/video/${VIDEO_ID}?autoplay=0&controls=1&mute=0&queue-enable=false">
        </iframe>
    `;
            loadBtn.style.display = "none"; // ocultamos el botón
        });

        // Función para simular fullscreen
        btn.addEventListener('click', () => {
            const iframe = document.getElementById('dmframe');

            if (container.dataset.fullscreen === "true") {
                if (document.exitFullscreen) document.exitFullscreen();
                container.dataset.fullscreen = "false";
                container.style.position = 'relative';
                container.style.width = '100%';
                container.style.height = '100%';
                container.style.top = '';
                container.style.left = '';
                container.style.zIndex = '';
                container.style.backgroundColor = 'black';
                if (iframe) {
                    iframe.style.width = '100%';
                    iframe.style.height = '100%';
                }
                overlayTop.style.height = "20%";
                if (isMobileDevice()) {
                    btn.style.padding = "28px 5px";
                    btn.style.fontSize = "10px";
                }
            } else {
                if (container.requestFullscreen) container.requestFullscreen();
                container.dataset.fullscreen = "true";
                container.style.position = 'fixed';
                container.style.top = '0';
                container.style.left = '0';
                container.style.width = window.innerWidth + "px";
                container.style.height = window.innerHeight + "px";
                container.style.zIndex = '1000';
                container.style.backgroundColor = 'black';
                if (iframe) {
                    iframe.style.width = window.innerWidth + "px";
                    iframe.style.height = window.innerHeight + "px";
                }
                overlayTop.style.height = "20%";
                if (isMobileDevice()) {
                    btn.style.padding = "28px 10px";
                    btn.style.fontSize = "10px";
                }
            }
        });

        // Captura de tecla Escape
        document.addEventListener('keydown', (e) => {
            if (e.key === "Escape" && container.dataset.fullscreen === "true") {
                btn.click();
            }
        });

        // 🔧 Fix: salida correcta al presionar ESC
        document.addEventListener("fullscreenchange", () => {
            const iframe = document.getElementById('dmframe');
            if (!document.fullscreenElement && container.dataset.fullscreen === "true") {
                // Restaurar estilos
                container.dataset.fullscreen = "false";
                container.style.position = 'relative';
                container.style.width = '100%';
                container.style.height = '100%';
                container.style.top = '';
                container.style.left = '';
                container.style.zIndex = '';
                container.style.backgroundColor = 'black';
                if (iframe) {
                    iframe.style.width = '100%';
                    iframe.style.height = '100%';
                }
                overlayTop.style.height = "20%";
                if (isMobileDevice()) {
                    btn.style.padding = "28px 5px";
                    btn.style.fontSize = "10px";
                }
            }
        });

        // Ajustar tamaños en fullscreen
        window.addEventListener('resize', () => {
            const iframe = document.getElementById('dmframe');
            if (container.dataset.fullscreen === "true" && iframe) {
                container.style.width = window.innerWidth + "px";
                container.style.height = window.innerHeight + "px";
                iframe.style.width = window.innerWidth + "px";
                iframe.style.height = window.innerHeight + "px";
                overlayTop.style.height = "20%";
            }
        });

        // Toggle play/pause simulando clic en overlayTop
        overlayTop.addEventListener('click', () => {
            const iframe = document.getElementById('dmframe');
            if (!iframe) return;
        });
}


//funciones de listado de video

const listclases = document.querySelector('#course-toc-2');

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





function getComentarios() {
    $.ajax({
        url: baseurl + "/Video/getcomentarios", // tu endpoint PHP
        type: "GET",
        dataType: "json",
        success: function (data) {
            // limpiar lista
            $("#commentList").html("");

            // actualizar contador
            $("#commentCount").text(data.length + " Comments");

            // recorrer y renderizar
            data.forEach(function (c) {
                let iniciales = (c.nombre.charAt(0) + c.apellidos.charAt(0)).toUpperCase();

                let commentHTML = `
                    <div class="d-flex mb-3">
                        <a href="#" class="avatar avatar-sm mr-12pt">
                            <span class="avatar-title rounded-circle">${iniciales}</span>
                        </a>
                        <div class="flex">
                            <a href="#" class="text-body"><strong>${c.nombre} ${c.apellidos}</strong></a><br>
                            <p class="mt-1 text-70">${c.comentario}</p>
                            <div class="d-flex align-items-center">
                                <small class="text-50 mr-2">${c.fecha}</small>
                                <a href="#" class="text-50"><small>Liked</small></a>
                            </div>
                        </div>
                    </div>
                `;

                $("#commentList").append(commentHTML);
            });
        },
        error: function (xhr, status, error) {
            console.error("Error al cargar comentarios:", error);
        }
    });
}


document.getElementById("btnPostComment").addEventListener("click", function () {
    const comment = document.getElementById("comment").value.trim();

    if(comment === "") {
        swal("Error", "Debe escribir un comentario.", "error");
        return;
    }

    const formData = new FormData();
    formData.append("comentario", comment);


    $.ajax({
        url: baseurl + "/Video/setcomentario",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        dataType: "json",
        success: function (res) {
            if (res.status) {
                swal("Éxito", res.msg, "success");
                document.getElementById("comment").value = ""; // limpiar textarea
                getComentarios(); // refrescar lista de comentarios
            } else {
                swal("Error", res.msg, "error");
            }
        },
        error: function (xhr, status, error) {
            console.error("Error al insertar comentario:", error);
        }
    });
});
