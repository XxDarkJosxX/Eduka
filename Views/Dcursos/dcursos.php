<?php
headeradmin($data);

?>
<!-- Page Content -->

<div class="container page__container page-section pb-0">
    <h1 class="h2 mb-0">Administracion de Cursos</h1>
    <ol class="breadcrumb m-0 p-0">
        <li class="breadcrumb-item">Home</a></li>
        <li class="breadcrumb-item">Administracion</li>
        <li class="breadcrumb-item active">Cursos</li>
    </ol>
    <br>
    <button class="btn btn-primary btn-sm" type="button" onclick="openmodal()">Nuevo</button>
</div>



<div class="container page__container page-section">

    <div class="page-separator">
        <div class="page-separator__text">Cursos</div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="">
                        <table class="table table-striped table-bordered dt-responsive nowrap" id="tablecursos" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Autor</th>
                                    <th>Titulo</th>
                                    <th>Categoria</th>
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
getmodal('modaldcursos', $data);
footerscript($data);
?>