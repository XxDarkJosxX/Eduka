var tablero;


document.addEventListener("DOMContentLoaded", function () {
    tablero = $('#tableclases').DataTable({
        
        initComplete: function () {
            fnteditclase();
            fntdelcurso();
        },

        "aProcessing": true,
        "aSeverSide": true,
        "language": {
            "url":"Assets/js/plugins/es-ES.json"
        },
        "ajax": {
            "url": baseurl + "/Clases/getclases",
            "dataSrc": ""
        },
        "columns": [
            { "data": 'idclases' },
            { "data": 'titcurso' },
            { "data": 'titclase' },
            { "data": 'privacidad' },
            { "data": 'estado' },
            { "data": 'acciones' }
        ],
        "resonsieve": "true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[0, "desc"]]

    });
    //Insert
    var forminsert = document.querySelector("#formclase");
    forminsert.onsubmit = function (e) {
        e.preventDefault();
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');

        var ajaxUrl = baseurl + '/Clases/setclase';
        var formdata = new FormData(forminsert);



        var xhr = new XMLHttpRequest();
xhr.open("POST", ajaxUrl, true);

// Mostrar swal con barra de progreso
swal({
    title: "Subiendo archivo...",
    text: `
        <div id="progressContainer" style="width:100%;background:#eee;border-radius:5px;">
            <div id="progressBar" style="width:0%;background:#4caf50;height:20px;border-radius:5px;text-align:center;color:white;font-size:12px;">0%</div>
        </div>
    `,
    html: true, // 👈 muy importante
    showConfirmButton: false,
    allowOutsideClick: false,
    allowEscapeKey: false,
    showCancelButton: true,
    cancelButtonText: "Cancelar subida",
    closeOnCancel: false
}, function(isConfirm){
    if(!isConfirm){
        xhr.abort();
        swal("Cancelado", "La subida fue cancelada", "error");
    }
});


// Actualizar barra de progreso
xhr.upload.onprogress = function(e){
    if(e.lengthComputable){
        var percent = Math.round((e.loaded / e.total) * 100);
        var progressBar = document.getElementById("progressBar");
        if(progressBar){
            progressBar.style.width = percent + "%";
            progressBar.textContent = percent + "%";
        }
    }
};

xhr.onload = function(){
    if(xhr.status == 200){
        var obdata = JSON.parse(xhr.responseText);
        if(obdata.status){
            swal("Éxito", obdata.msg, "success");
            $('#modalformclases').modal("hide");
            forminsert.reset();
            tablero.ajax.reload();
        } else {
            swal("Error", obdata.msg, "error");
        }
    } else {
        swal("Error", "Error en el servidor", "error");
    }
};

xhr.send(formdata);




        request.onreadystatechange = function () {

            if (request.readyState == 4 && request.status == 200) {

                //console.log(request.responseText);
                var obdata = JSON.parse(request.responseText);
                //console.log(obdata);
                if (obdata.status) {
                    $('#modalformclases').modal("hide");
                    forminsert.reset();
                    //Validar datos repetodos
                    swal("Administración de Usuarios", obdata.msg, "success");
                    //Ojo 
                    tablero.ajax.reload(function () {
                        //fnteditrol();
                        //fntdelrol();
                        //fntpermisosrol();
                    });

                } else {
                    swal("Error", obdata.msg, "error");
                    //forminsert.reset();
                }
            }
        }
    }

}, false);


function openmodal() {
    document.querySelector('#idclase').value = "";
    document.querySelector('#titlemodal').innerHTML = "Nuevo Usuario";
    document.querySelector('.modal-header').classList.replace("headerupdate", "headerregister");
    document.querySelector('#btnactionform').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btntext').innerHTML = "Guardar";
    document.querySelector('#materialfile').value = "";listfile();
    document.querySelector('#validatearchivo').innerHTML ="";
    document.querySelector('#formclase').reset();
    $('#modalformclases').modal("show");
}
//Funciones Usuarios
window.addEventListener('load', function () {

}, false)


//Updates
function fnteditclase() {
    $('#tableclases').on('click', '.btneditclase', function () {
            //alert("Click to close...");s

            document.querySelector('#titlemodal').innerHTML = "Actualizar Usuario";
            document.querySelector('.modal-header').classList.replace("headerregister", "headerupdate");
            document.querySelector('#btnactionform').classList.replace("btn-primary", "btn-info");
            document.querySelector('#btntext').innerHTML = "Actualizar";
            document.querySelector('#materialfile').value = "";listfile();
            document.querySelector('#validatearchivo').innerHTML ="";
            //Recupera
            var idkey = this.getAttribute("rl");
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            //El getusuario esta en Singular !Cuidado confunfir!
            var ajaxUrl = baseurl + '/Clases/getclase/' + idkey;
            request.open("GET", ajaxUrl, true);
            request.send();
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {

                    var objdata = JSON.parse(request.responseText);

                    if (objdata.status) {
                        document.querySelector("#idclase").value = objdata.data.idclases;
                        document.querySelector("#txttitulo").value = objdata.data.titclase;
                        document.querySelector("#txtdescripcion").value = objdata.data.descripcion;
                        document.querySelector("#txtenlace").value = objdata.data.enlace;

                        if(objdata.data.archivourl != null && objdata.data.archivos != null){
                            fileupdateexist(objdata.data.archivourl,objdata.data.archivos);
                        }

                        $('#listprivacidad').val(objdata.data.privacidad).trigger('change');
                        $('#liststatus').val(objdata.data.estado).trigger('change');


                        $('#modalformclases').modal("show");
                    } else {
                        swal("Error", objdata.msg, "error");
                    }
                }
            }

        });


}



function fntdelcurso() {

    $('#tableclases').on('click', '.btndelcurso', function () {
        
            var idusuarios = this.getAttribute("rl");
            swal({
                title: "Eliminar Curso",
                text: "¿Realmente Quiere eliminar el Usuario?",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Si, Eliminar",
                cancelButtonText: "No, Cancelar",
                closeOnConfirm: false,
                closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {
                    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                    var ajaxUrl = baseurl + '/Cursos/delcurso/';
                    var strdata = "idusuario=" + idusuarios;
                    request.open("POST", ajaxUrl, true);
                    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    request.send(strdata);
                    request.onreadystatechange = function () {
                        if (request.readyState == 4 && request.status == 200) {
                            console.log(request.responseText);
                            var objdata = JSON.parse(request.responseText);
                            if (objdata.status) {
                                swal("Eliminar!", objdata.msg, "success");
                                //Libreria de reload solucionar
                                //tablero generico
                                tablero.ajax.reload(function () {
                                    //funeditsuario();
                                    //fundelusuario();
                                    //fntpermisosrol();
                                });

                            } else {
                                swal("Error", objdata.msg, "error");
                            }
                        }
                    }
                }

            });
        });
  
}






//////////////////////////////////////////////////////////////////////////////////////////////////

var _validFileExtensions = [".zip", ".rar", ".7z", ".tar", ".gz", ".bz2"];
function ValidateSingleInput(oInput) {
    if (oInput.type == "file") {
        var sFileName = oInput.value;
        if (sFileName.length > 0) {
            var blnValid = false;
            for (var j = 0; j < _validFileExtensions.length; j++) {

                var sCurExtension = _validFileExtensions[j];
                
                if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                    document.querySelector('#validatearchivo').classList.add('d-none');
                    document.querySelector('#validatearchivo').innerHTML = '';
                    blnValid = true;
                    break;
                }
            }

            if (!blnValid) {
                document.querySelector('#validatearchivo').classList.remove('d-none');
                document.querySelector('#validatearchivo').innerHTML = `Formato invalido, solo se aceptan archivos ${_validFileExtensions.join(", ")}`;
                oInput.value = "";
                return false;
            }else{
                listfile();
            }


        }
    }
    return true;
}

function listfile(){
    var input = document.getElementById('materialfile')
    var output = document.getElementById('fileList');
    var children = "";
    for (var i = 0; i < input.files.length; ++i) {
        //<i class="fa fa-fw fa-lg fa-times-circle"></i>
        children +=  '<li>'+ input.files.item(i).name + ' <span class="remove-list" onclick="removefile(this)"></span>' + '</li>'
    }
    output.innerHTML = children;


}

function removefile(elemento){
    var parentElement = elemento.parentNode;
  var inputArchivo = parentElement.querySelector('input[type="file"]');
  
  parentElement.remove();
  
  if (inputArchivo) {
    inputArchivo.value = '';
  }
}


function fileupdateexist(ruta,nombrefile){
    var inputArchivo = document.getElementById("materialfile");

// URL del archivo existente
var urlArchivoExistente = ruta; // Reemplaza con la URL de tu archivo existente

// Obtener el archivo existente mediante fetch
fetch(urlArchivoExistente)
  .then(response => response.blob())
  .then(blob => {
    // Crear un objeto File a partir del Blob
    var archivoExistente = new File([blob], nombrefile);

    // Crear un objeto DataTransfer y agregar el archivo existente a él
    var dataTransfer = new DataTransfer();
    dataTransfer.items.add(archivoExistente);

    // Establecer el valor del input de archivo utilizando el objeto DataTransfer
    inputArchivo.files = dataTransfer.files;
    if (inputArchivo.files.length > 0) {
    
        }
    listfile();
  })
  .catch(error => {
    console.log("Error al obtener el archivo existente:", error);
  });
  
}




const btnPrevisualizar = document.getElementById('btnprevisualizar');

btnPrevisualizar.addEventListener('click', function (event) {
    let enlace = document.querySelector("#txtenlace").value;
    htmiframe = `
        <iframe id="youtubeframeid"
        class="embed-responsive-item" 
        src="https://www.youtube.com/embed/${enlace}?modestbranding=1&disablekb=1&rel=0&loop=1&mute=1&showinfo=0&controls=0&iv_load_policy=3" 
        frameborder="0" 
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
        allowfullscreen
        ></iframe>
    `;
    document.querySelector('#player').innerHTML = htmiframe;



    const iframes = document.querySelectorAll("#player");


    iframes.forEach(function (iframe) {
        var player = new Plyr(iframe, {

            controls: ['play', 'progress', 'current-time', 'mute', 'volume', 'fullscreen'],
            clickToPlay: true,
            hideControls: false,
            showPosterOnEnd: true,
            disableYouTube: true,
            youtube: {
                             noCookie: true,
                             enablejsapi:1,
                             rel: 0,
                             modestbranding: 1,
                             showinfo: 0,
                             iv_load_policy: 3,
                             controls:0,
                             disableClickHandling: true,
                             disablekb:1
                          },

        });

        player.toggleControls(false);
        player.on('play', function () {
            player.toggleControls(true);
        });

    }
    );
});