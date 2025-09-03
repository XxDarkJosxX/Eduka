<?php
headeradmin($data);
?>
<!-- Page Content -->

<div class="container page__container page-section pb-0">
    <h1 class="h2 mb-0">Administracion de Docentes</h1>
    <ol class="breadcrumb m-0 p-0">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Administracion</li>
        <li class="breadcrumb-item active">Docentes</li>
    </ol>
    <br>
    <button class="btn btn-primary btn-sm" type="button" onclick="openmodal()">Nuevo</button>
</div>



<div class="container page__container page-section">

    <div class="page-separator">
        <div class="page-separator__text">Docentes</div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="tabledocentes">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Apellidos</th>
                                    <th>Correo</th>
                                    <th>Suscripcion</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- // END Page Content -->

<?php

footeradmin($data);
getmodal('modaldocentes', $data);
footerscript($data);


?>

<!-- En el getModal se pone el nombre del archivo-->
</body>

</html>