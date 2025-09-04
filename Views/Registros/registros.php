<?php
headerprincipal($data);

?>
<!-- Page Content -->
<!-- // END Header -->

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
            <div class="text-center">
                <button class="btn btn-primary btncrear" type="submit">Crear Usuario</button>
                <div class="field">
                    <div id="g_id_onload"
                        data-client_id="196182658810-gri5vaek708sgnukf8rov1ke9i7iu62d.apps.googleusercontent.com"
                        data-context="signin"
                        data-ux_mode="popup"
                        data-callback="handleCredentialResponse"
                        data-auto_prompt="false">
                    </div>

                    <div class="g_id_signin"
                        data-type="standard"
                        data-shape="pill"
                        data-theme="outline"
                        data-text="signin_with"
                        data-size="large"
                        data-logo_alignment="left">
                    </div>

                    <div id="status"></div>
                </div>


            </div>
        </form>
    </div>
</div>
<!-- // END Page Content -->



<script>
    window.handleCredentialResponse = function(response) {
        console.log("Google credential:", response);
        const datosUsuario = parseJwt(response.credential);
        document.getElementById('status').innerText =
            `Hola ${datosUsuario.given_name}, tu correo es ${datosUsuario.email}`;
    };

    function parseJwt(token) {
        const base64Url = token.split('.')[1];
        const base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
        const jsonPayload = decodeURIComponent(atob(base64).split('').map(function(c) {
            return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
        }).join(''));
        return JSON.parse(jsonPayload);
    }
</script>

<script src="https://accounts.google.com/gsi/client" async defer></script>

<?php
footerprincipal($data);

?>