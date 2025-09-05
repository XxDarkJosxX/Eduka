var tablero;
//Esto es un js
//Prueba a com
document.addEventListener("DOMContentLoaded",function(){
    tablero=$('#tableplataforma').DataTable({

        initComplete: function () {
            fnteditplataforma();
            fntdelplataforma();
        },

        "aProcessing":true,
        "aSeverSide":true,
        "language" :{
            "url":baseurl+"/Assets/js/plugins/es-ES.json"
        },
        "ajax":{
            "url":" "+baseurl+"/Plataformas/getplataformas",
            "dataSrc":""
        },
        "columns": [
            { "data": 'idplataforma' },
            { "data": 'nombre' },
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
    var forminsert= document.querySelector("#formplataformas");
    forminsert.onsubmit=function(e){
        e.preventDefault();
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = baseurl+'/Plataformas/setplataformas';
        var formdata=new FormData(forminsert);
        request.open("POST",ajaxUrl,true);
        request.send(formdata);
        request.onreadystatechange =function(){
            if(request.readyState == 4 && request.status==200){
               
                //console.log(request.responseText);
                var obdata=JSON.parse(request.responseText);
                //console.log(obdata);
                if(obdata.status){
                    $('#modalformplataformas').modal("hide");
                    forminsert.reset();
                    //Validar datos todos
                    swal("Administración de Plataforma", obdata.msg ,"success");
                    //Ojo el tablero tiene que ser generico
                    tablero.ajax.reload(function(){
                    });
                   
                } else{
                    swal("Error",obdata.msg,"error");
                   
                }
            }
        }
    }

},false);




function openmodal(){
    document.querySelector('#idplataforma').value="";
    document.querySelector('#titlemodal').innerHTML = "Nueva Plataforma";
    document.querySelector('.modal-header').classList.replace("headerupdate","headerregister");
    document.querySelector('#btnactionform').classList.replace("btn-info","btn-primary");
    document.querySelector('#btntext').innerHTML="Guardar";
    document.querySelector('#formplataformas').reset();
    $('#modalformplataformas').modal("show");
    
}
//Funciones Usuarios
window.addEventListener('load',function(){
    fnteditrol();
    fntdelrol();
},false)


//Update

function fnteditplataforma(){
    $('#tableplataforma').on('click', '.btneditplataforma', function () {
        
        btneditplataforma.addEventListener("click",function(){
            //alert("Click to close...");
            document.querySelector('#titlemodal').innerHTML = "Actualizar Plataforma";
            document.querySelector('.modal-header').classList.replace("headerregister","headerupdate");
            document.querySelector('#btnactionform').classList.replace("btn-primary","btn-info");
            document.querySelector('#btntext').innerHTML="Actualizar";

            var idplataforma = this.getAttribute("rl");
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = baseurl+'/Plataformas/getplataforma/'+idplataforma;
            request.open("GET",ajaxUrl,true);
            request.send();
            request.onreadystatechange =function(){
                if(request.readyState == 4 && request.status==200){
                    //console.log(request.responseText);
                    var objdata=JSON.parse(request.responseText);
                    if(objdata.status){
                        document.querySelector("#idplataforma").value=objdata.data.idplataforma;
                        document.querySelector("#txtnombre").value=objdata.data.nombre;
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

                        
                        $('#modalformplataformas').modal("show");
                    }else{
                        swal("Error",objdata.msg,"error");
                    }
                }
            }
           
        });
    });
    //alert(btneditrol);
}

//Delete logic

function fntdelplataforma(){
    var btndelplataforma = document.querySelectorAll(".btndelplataforma");
    btndelplataforma.forEach(function(btndelplataforma){
        btndelplataforma.addEventListener("click",function(){
            var idplataforma = this.getAttribute("rl");
            swal({
                title:"Eliminar Rol",
                text: "¿Realmente Quiere eliminar la Plataforma?",
                type:"warning",
                showCancelButton:true,
                confirmButtonText: "Si, Eliminar",
                cancelButtonText: "No, Cancelar",
                closeOnConfirm:false,
                closeOnCancel:true
            },function(isConfirm){
                if(isConfirm){
                var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                var ajaxUrl = baseurl+'/Plataformas/delplataforma/';
                var strdata = "idplataforma="+idplataforma;
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
    });
}


