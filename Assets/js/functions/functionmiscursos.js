var tablero;
//Esto es un js
//Prueba a com
document.addEventListener("DOMContentLoaded", function () {
    tablero = $('#tablecursos').DataTable({

        initComplete: function () {
            fnteditcurso();
            fntdelcurso();
            fntclasescurso();
        },

        "aProcessing": true,
        "aSeverSide": true,
        "language": {
            "url": "Assets/js/plugins/es-ES.json"
        },
        "ajax": {
            "url": " " + baseurl + "/MisCursos/getcursos",
            "dataSrc": ""
        },
        "columns": [
            { "data": 'idcurso' },
            { "data": 'nombre' },
            { "data": 'titulo' },
            { "data": 'nombrecat' },
            { "data": 'estado' },
            { "data": 'acciones' }
        ],
        "resonsieve": "true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[0, "desc"]]

    });
    //Insert
    var forminsert = document.querySelector("#formcurso");
    forminsert.onsubmit = function (e) {
        e.preventDefault();
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = baseurl + '/Cursos/setcurso';
        var formdata = new FormData(forminsert);
        request.open("POST", ajaxUrl, true);
        request.send(formdata);
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {

                //console.log(request.responseText);
                var obdata = JSON.parse(request.responseText);
                //console.log(obdata);
                if (obdata.status) {
                    $('#modalformcursos').modal("hide");
                    forminsert.reset();
                    //Validar datos repetodos
                    swal("Administración de Cursos", obdata.msg, "success");
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
    document.querySelector('#idcurso').value = "";
    document.querySelector('#titlemodal').innerHTML = "Nuevo Curso";
    document.querySelector('.modal-header').classList.replace("headerupdate", "headerregister");
    document.querySelector('#btnactionform').classList.replace("btn-info", "btn-primary");
    document.querySelector('#materialimg').value = "";listfile();
    document.querySelector('#btntext').innerHTML = "Guardar";
    document.querySelector('#formcurso').reset();
    $('#modalformcursos').modal("show");

}
//Funciones Usuarios
window.addEventListener('load', function () {
    fntcursoscategorias();
    fntcursosplataforma();
}, false)

//Especial
function fntcursoscategorias() {
    if (document.querySelector('#listcategorias')) {
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = baseurl + '/Cursos/getselecategorias';
        request.open("GET", ajaxUrl, true);
        request.send();

        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {

                document.querySelector('#listcategorias').innerHTML = request.responseText;

                $('#listcategorias').val(1).trigger('change');


            }
        }
    }
}
//Especial
function fntcursosplataforma() {
    if (document.querySelector('#listplataformas')) {
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = baseurl + '/Cursos/getselectplataformas';
        request.open("GET", ajaxUrl, true);
        request.send();

        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {

                document.querySelector('#listplataformas').innerHTML = request.responseText;

                $('#listplataformas ').val(1).trigger('change');


            }
        }
    }
}
//Updates
function fnteditcurso() {
     $('#tablecursos').on('click', '.btneditcurso', function () {
            //alert("Click to close...");s
            document.querySelector('#titlemodal').innerHTML = "Actualizar Usuario";
            document.querySelector('.modal-header').classList.replace("headerregister", "headerupdate");
            document.querySelector('#btnactionform').classList.replace("btn-primary", "btn-info");
            document.querySelector('#materialimg').value = "";listfile();
            document.querySelector('#btntext').innerHTML = "Actualizar";
            //Recupera
            var idkey = this.getAttribute("rl");
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            //El getusuario esta en Singular !Cuidado confunfir!
            var ajaxUrl = baseurl + '/Cursos/getcurso/' + idkey;
            request.open("GET", ajaxUrl, true);
            request.send();
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {

                    var objdata = JSON.parse(request.responseText);

                    if (objdata.status) {
                        document.querySelector("#idcurso").value = objdata.data.idcurso;
                        document.querySelector("#txttitulo").value = objdata.data.titulo;
                        document.querySelector("#txtdescripcion").value = objdata.data.descripcion;

                        $('#listcategorias').val(objdata.data.idcategoria).trigger('change');
                        
                        $('#liststatus').val(objdata.data.estado).trigger('change');

                        
                        if(objdata.data.portadaurl != null && objdata.data.portadaname != null){
                            fileupdateexist(objdata.data.portadaurl,objdata.data.portadaname);
                        }

                        $('#modalformcursos').modal("show");
                    } else {
                        swal("Error", objdata.msg, "error");
                    }
                }
            }

        });


}

//Especial

//Delete logic
function fntdelcurso() {

    $('#tablecursos').on('click', '.btndelcurso', function () {

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



function fntclasescurso() {

    $('#tablecursos').on('click', '.btnclases', function () {
            var idcurso = this.getAttribute("rl");
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = baseurl + '/Cursos/asingclases/' + idcurso;
            request.open("GET", ajaxUrl, true);
            request.send();
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    window.location = baseurl + "/Clases";
                }
            };
        });
   
}


//validaciones para subir una imagen 

var _validFileExtensions = [".jpg", ".jpeg", ".png", ".gif", ".svg"];
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
    var input = document.getElementById('materialimg')
    var output = document.getElementById('fileList');
    var children = "";
    for (var i = 0; i < input.files.length; ++i) {
        children +=  '<li>'+ input.files.item(i).name + ' <span class="remove-list" onclick="removefile(this)"></span>' + '</li>'
    }
    output.innerHTML = children;


}


function fileupdateexist(ruta, nombrefile){
    var inputArchivo = document.getElementById("materialimg");

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