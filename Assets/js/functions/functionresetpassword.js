document.addEventListener("DOMContentLoaded", function () {


    if (document.querySelector('#formresetpassword')) {
        let formreset = document.querySelector('#formresetpassword');
        formreset.onsubmit = function (e) {
            e.preventDefault();
            let stremail = document.querySelector('#txtemailreset').value;
            if (stremail == '') {
                swal("Por favor", "Escribe tu correo electrónico", "error");
                return false;
            } else {
                var request = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
                var ajaxUrl = baseurl + "/Resetpassword/reset";
                var formdata = new FormData(formreset);

                request.open("POST", ajaxUrl, true);

                request.send(formdata);
                request.onreadystatechange = function () {
                    console.log(request);
                    
                    if (request.readyState != 4) return;
                    if (request.status == 200){
                        var obdata = JSON.parse(request.responseText);
                        if (obdata.status) {
                            swal({
                                title: "Atencion",
                                text: obdata.msg,
                                type: "success",
                                showCancelButton: true,
                                confirmButtonText: "Aceptar",
                                cancelButtonText: false,
                                closeOnConfirm: false,
                                closeOnCancel: true
                            }, function (isConfirm) {
                                if (isConfirm) {
                                    window.location = baseurl;
                                }
                            });
                        } else {
                            swal("Atencion", obdata.msg, "error");
                        }

                    } else {
                        swal("Atencion", "error en el proceso", "error");
                    }
                    return false;

                }

            }
        }
    }


}, false);
