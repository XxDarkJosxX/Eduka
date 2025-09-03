var tablero;
//Esto es un js
//Prueba a com
document.addEventListener("DOMContentLoaded",function(){
    tablero=$('#tableroles').DataTable({

        initComplete: function () {
            fnteditrol();
            fntdelrol();
            fntpermisosrol();
        },

        "aProcessing":true,
        "aSeverSide":true,
        "language" :{
            "url":baseurl+"/Assets/js/plugins/es-ES.json"
        },
        "ajax":{
            "url":" "+baseurl+"/Roles/getroles",
            "dataSrc":""
        },
        "columns": [
            { "data": 'idroles' },
            { "data": 'tipo' },
            { "data": 'descripcion' },
            { "data": 'estado' },
            { "data": 'acciones' }
        ],
        "resonsieve":"true",
        "bDestroy":true,
        "iDisplayLength":10,
        "order":[[0,"desc"]]

    });
    //Insert
    var forminsert= document.querySelector("#formroles");
    forminsert.onsubmit=function(e){
        e.preventDefault();
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = baseurl+'/Roles/setroles';
        var formdata=new FormData(forminsert);
        request.open("POST",ajaxUrl,true);
        request.send(formdata);
        request.onreadystatechange =function(){
            if(request.readyState == 4 && request.status==200){
               
                //console.log(request.responseText);
                var obdata=JSON.parse(request.responseText);
                //console.log(obdata);
                if(obdata.status){
                    $('#modalformroles').modal("hide");
                    forminsert.reset();
                    //Validar datos todos
                    swal("Administración de Roles", obdata.msg ,"success");
                    //Ojo el tablero tiene que ser generico
                    tablero.ajax.reload(function(){
                        //fnteditrol();
                        //fntdelrol();
                        //fntpermisosrol();
                    });
                   
                } else{
                    swal("Error",obdata.msg,"error");
                    //forminsert.reset();
                }
            }
        }
    }

},false);
//Activacion del Modal


function openmodal(){
    document.querySelector('#idrol').value="";
    document.querySelector('#titlemodal').innerHTML = "Nuevo Rol";
    document.querySelector('.modal-header').classList.replace("headerupdate","headerregister");
    document.querySelector('#btnactionform').classList.replace("btn-info","btn-primary");
    document.querySelector('#btntext').innerHTML="Guardar";
    document.querySelector('#formroles').reset();
    $('#modalformroles').modal("show");
    
}
//Funciones Usuarios
window.addEventListener('load',function(){
    fnteditrol();
    fntdelrol();
},false)


//Update

function fnteditrol(){
    $('#tableroles').on('click', '.btneditroles', function () {
            //alert("Click to close...");
            document.querySelector('#titlemodal').innerHTML = "Actualizar Rol";
            document.querySelector('.modal-header').classList.replace("headerregister","headerupdate");
            document.querySelector('#btnactionform').classList.replace("btn-primary","btn-info");
            document.querySelector('#btntext').innerHTML="Actualizar";

            var idrol = this.getAttribute("rl");
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = baseurl+'/Roles/getrol/'+idrol;
            request.open("GET",ajaxUrl,true);
            request.send();
            request.onreadystatechange =function(){
                if(request.readyState == 4 && request.status==200){
                    //console.log(request.responseText);
                    var objdata=JSON.parse(request.responseText);
                    if(objdata.status){
                        document.querySelector("#idrol").value=objdata.data.idroles;
                        document.querySelector("#txttipo").value=objdata.data.tipo;
                        document.querySelector("#txtdescripcion").value=objdata.data.descripcion;
                        if(objdata.data.Estado == 1){
                            var optionselect = '<option value="1" selected class="notblock">Activo</option>';
                        }else{
                            var optionselect = '<option value="2" selected class="notblock">Inactivo</option>';
                        }
                        var htmlselect=`${optionselect} 
                                        <option value="1">Activo</option> 
                                        <option value="2">Inactivo</option>
                                        `;
                        
                        $('#liststatus').val(objdata.data.estado).trigger('change');  

                        
                        $('#modalformroles').modal("show");
                    }else{
                        swal("Error",objdata.msg,"error");
                    }
                }
            }
           
        });


}

//Delete logic

function fntdelrol(){
     $('#tableroles').on('click', '.btndelroles', function () {
            var idrol = this.getAttribute("rl");
            swal({
                title:"Eliminar Rol",
                text: "¿Realmente Quiere eliminar el Rol?",
                type:"warning",
                showCancelButton:true,
                confirmButtonText: "Si, Eliminar",
                cancelButtonText: "No, Cancelar",
                closeOnConfirm:false,
                closeOnCancel:true
            },function(isConfirm){
                if(isConfirm){
                var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                var ajaxUrl = baseurl+'/Roles/delrol/';
                var strdata = "idrol="+idrol;
                request.open("POST",ajaxUrl,true);
                request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                request.send(strdata);
                request.onreadystatechange = function(){
                        if(request.readyState == 4 && request.status==200){
                            //console.log(request.responseText);
                            var objdata=JSON.parse(request.responseText);
                            if(objdata.status){
                                swal("Eliminar!",objdata.msg,"success");
                                tablero.ajax.reload(function(){
                                    fnteditrol();
                                    fntdelrol();
                                });

                            }else{
                                swal("Error",objdata.msg,"error");
                            }
                        }
                    }
                }

            });
        });
   
}


function fntpermisosrol(){
    $('#tableroles').on('click', '.btnpermisorol', function () {
            var idrol = this.getAttribute("rl");
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = baseurl+'/Permisos/getpermisos/'+idrol;
            request.open("GET",ajaxUrl,true);
            request.send();
            request.onreadystatechange =function(){
                if(request.readyState ==4 && request.status==200){
                    //console.log(request.responseText);
                    document.querySelector('#contentajax').innerHTML= request.responseText;
                    $('#modalpermisos').modal("show");
                    document.querySelector('#formpermisos').addEventListener('submit',fntsavepermisos,false);
                }
            }
            
        });
   
}

function fntsavepermisos(event){
    event.preventDefault();
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = baseurl+'/Permisos/setpermisos';
    var formpermisos= document.querySelector("#formpermisos");
    var formdata=new FormData(formpermisos);

    request.open("POST",ajaxUrl,true);
    request.send(formdata);
    request.onreadystatechange = function(){
        if(request.readyState==4 && request.status ==200){
            var obdata = JSON.parse(request.responseText);
            if(obdata.status){
                swal("Permisos de Usuario",obdata.msg,"success");
                $('#modalpermisos').modal("hide");
            }else{
                swal("Error",obdata.msg,"error");
            }
        }
    }
}
