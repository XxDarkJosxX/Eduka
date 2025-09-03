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
                <label class="form-label">Cedula de Identidad</label>
                <input id="txtci" name="txtci" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label class="form-label">Correo</label>
                <input id="txtcorreo" name="txtcorreo" type="email" class="form-control" placeholder="usuario@gmail.com">
            </div>
            <div class="text-center">
                <button class="btn btn-primary btncrear" type="submit" >Crear Usuario</button>
                
    <button class="btn btn-primary btncrear" type="submit" >Registro Gmail</button>
            </div>
        </form>
    </div>
</div>
<!-- // END Page Content -->

<?php
footerprincipal($data);

?>