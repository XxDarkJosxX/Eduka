<?php
headerprincipal($data);
?>
<!-- Page Content -->
<div class="pt-32pt pt-sm-64pt pb-32pt">
    <div class="container page__container">
        <form id="formregistro" name="formregistro" enctype="multipart/form-data" class="col-md-5 p-0 mx-auto">

            <input id="idusuario" name="idusuario" type="hidden" value="">

            <div class="form-group">
                <label class="form-label">Nombre</label>
                <input id="txtnombre" name="txtnombre" type="text" class="form-control" placeholder="Nombre">
            </div>
            <div class="form-group">
                <label class="form-label">Apellido</label>
                <input id="txtapellido" name="txtapellido" type="text" class="form-control" placeholder="Apellido">
            </div>
            <div class="form-group">
                <label class="form-label">Telefono</label>
                <input id="txttelefono" name="txttelefono" type="text" class="form-control" placeholder="Telefono">
            </div>
            <div class="form-group">
                <label class="form-label">Correo</label>
                <input id="txtcorreo" name="txtcorreo" type="email" class="form-control" placeholder="usuario@gmail.com">
            </div>
            <div class="form-group">
                <label class="form-label">Contraseña</label>
                <input id="txtcontrasenia" name="txtcontrasenia" type="password" class="form-control" placeholder="******">
            </div>

            <div class="text-center">
                <button class="btn btn-primary" type="submit">Crear Usuario</button>
            </div>
        </form>

        <hr class="my-4">

        <!-- Botón de Google -->
        <div id="g_id_onload"
             data-client_id="196182658810-gri5vaek708sgnukf8rov1ke9i7iu62d.apps.googleusercontent.com"
             data-callback="handleCredentialResponse">
        </div>

        <div class="g_id_signin" data-type="standard"></div>
    </div>
</div>

<script src="https://accounts.google.com/gsi/client" async defer></script>

<script>
    // Captura de respuesta de Google
    function handleCredentialResponse(response) {
        const data = parseJwt(response.credential);

        // Mandar datos a tu backend
        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = baseurl + '/Registros/setregistros';
        var formData = new FormData();

        formData.append("txtnombre", data.given_name || "");
        formData.append("txtapellido", data.family_name || "");
        formData.append("txtcorreo", data.email || "");
      
        formData.append("txtcontrasenia", ""); // vacío → Controller genera dummy

        request.open("POST", ajaxUrl, true);
        request.send(formData);
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                var obdata = JSON.parse(request.responseText);
                if (obdata.status) {
                    swal("Usuario Gmail Registrado", obdata.msg, "success");
                } else {
                    swal("Error", obdata.msg, "error");
                }
            }
        }
    }

    // Función para decodificar el JWT de Google
    function parseJwt(token) {
        var base64Url = token.split('.')[1];
        var base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
        var jsonPayload = decodeURIComponent(atob(base64).split('').map(function(c) {
            return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
        }).join(''));
        return JSON.parse(jsonPayload);
    }
</script>

<?php
footerprincipal($data);
?>
