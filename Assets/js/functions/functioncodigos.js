var tablero;
//Esto es un js
document.addEventListener("DOMContentLoaded",function(){
    tablero=$('#tablecodigos').DataTable({
        "aProcessing":true,
        "aSeverSide":true,
        "language" :{
            "url":"Assets/js/plugins/es-ES.json"
        },
        "ajax":{
            "url":" "+baseurl+"/Codigos/getcodigos",
            "dataSrc":""
        }, 
        "columns": [
            { "data": 'idcodigo' },
            { "data": 'codigo' },
            { "data": 'acciones' }
        ],
        "resonsieve":"true",
        "bDestroy":true,
        "iDisplayLength":10,
        "order":[[0,"desc"]]

    });
 

});



function InsertToken(){
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = baseurl + '/Codigos/setinsert';
    request.open("GET", ajaxUrl, true);
    request.send();

    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            //Si es caso especial entonces es diferente 
            
            var obdata = JSON.parse(request.responseText);
            if(objdata.status){
                swal("Generado",objdata.msg,"success");
            
            
            }else{
                swal("Error",objdata.msg,"error");
            }
        }
    }
}


function GenerarToken(){
    InsertToken();

}
window.addEventListener('load',function(){
    fntdeltoken();
  
},false)




//Delete logic

function fntdeltoken(){
   
    $('#tablecodigos').on('click', '.btndeltoken', function () {

            var idtoken = this.getAttribute("rl");
            swal({
                title:"Eliminar Token",
                text: "¿Realmente Quiere eliminar el Token?",
                type:"warning",
                showCancelButton:true,
                confirmButtonText: "Si, Eliminar",
                cancelButtonText: "No, Cancelar",
                closeOnConfirm:false,
                closeOnCancel:true
            },function(isConfirm){
                if(isConfirm){
                var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                var ajaxUrl = baseurl+'/Codigos/deltoken/';
                var strdata = "idcodigo="+idtoken;
                request.open("POST",ajaxUrl,true);
                request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                request.send(strdata);
                request.onreadystatechange =function(){
                        if(request.readyState == 4 && request.status==200){
                            console.log(request.responseText);
                            var objdata=JSON.parse(request.responseText);
                            if(objdata.status){
                                swal("Eliminar!",objdata.msg,"success");
                            
                                tablero.ajax.reload();

                            }else{
                                swal("Error",objdata.msg,"error");
                            }
                        }
                    }
                }

            });
        });

}



