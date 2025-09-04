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
                <label class="form-label">Correo</label>
                <input id="txtcorreo" name="txtcorreo" type="email" class="form-control" placeholder="usuario@gmail.com">
            </div>
            <div class="text-center">
                <button class="btn btn-primary btncrear" type="submit">Crear Usuario</button>
                <div id="g_id_onload"
                    data-client_id="196182658810-gri5vaek708sgnukf8rov1ke9i7iu62d.apps.googleusercontent.com"
                    data-callback="handleCredentialResponse">
                </div>

                <div class="g_id_signin" data-type="standard"></div>


            </div>
        </form>
    </div>
</div>
<!-- // END Page Content -->
<script src="https://accounts.google.com/gsi/client" async defer></script>

<?php
footerprincipal($data);

?>