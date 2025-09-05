<!-- drawer -->
<div class="mdk-drawer js-mdk-drawer layout-mini__drawer" id="default-drawer">
    <div class="mdk-drawer__content js-sidebar-mini" data-responsive-width="992px" data-layout="mini">

        <div class="sidebar sidebar-mini sidebar-dark-pickled-bluewood sidebar-left d-flex flex-column">

            <!-- Brand -->
            <a class="sidebar-brand p-0 navbar-height d-flex justify-content-center">
                <span class="avatar avatar-sm ">
                    <span class="avatar-title rounded bg-primary">
                        <img src="<?= media() ?>/images/illustration/student/128/white.svg" class="img-fluid" alt="logo" />
                    </span>
                </span>
            </a>

            <div class="flex d-flex flex-column justify-content-start" data-perfect-scrollbar>
                <ul style="margin: auto !important;" class="nav flex-shrink-0 flex-nowrap flex-column sidebar-menu mb-0 js-sidebar-mini-tabs" role="tablist">

                    <!-- Usuarios -->
                    <?php if (!empty($_SESSION['permisos'][2]['r']) || !empty($_SESSION['permisos'][3]['r']) || !empty($_SESSION['permisos'][4]['r'])) { ?>
                        <li class="sidebar-menu-item active" data-title="Usuarios">
                            <a class="sidebar-menu-button" href="#sm_usuarios" data-toggle="tab" role="tab" aria-controls="sm_usuarios">
                                <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">group</i>
                                <span class="sidebar-menu-text">Usuarios</span>
                            </a>
                        </li>
                    <?php } ?>

                    <!-- Cursos -->
                    <?php if (!empty($_SESSION['permisos'][6]['r']) || !empty($_SESSION['permisos'][7]['r'])) { ?>
                        <li class="sidebar-menu-item" data-title="Cursos">
                            <a class="sidebar-menu-button" href="#sm_cursos" data-toggle="tab" role="tab" aria-controls="sm_cursos">
                                <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">school</i>
                                <span class="sidebar-menu-text">Cursos</span>
                            </a>
                        </li>
                    <?php } ?>

                    <!-- Filtros -->
                    <?php if (!empty($_SESSION['permisos'][8]['r']) || !empty($_SESSION['permisos'][9]['r'])) { ?>
                        <li class="sidebar-menu-item" data-title="Filtros">
                            <a class="sidebar-menu-button" href="#sm_filtros" data-toggle="tab" role="tab" aria-controls="sm_filtros">
                                <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">ballot</i>
                                <span class="sidebar-menu-text">Filtros</span>
                            </a>
                        </li>
                    <?php } ?>

                    <!-- Cuenta -->
                    <li class="sidebar-menu-item" data-title="Cuenta">
                        <a class="sidebar-menu-button" href="#sm_cuenta" data-toggle="tab" role="tab" aria-controls="sm_cuenta">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">build</i>
                            <span class="sidebar-menu-text">Cuenta</span>
                        </a>
                    </li>

                </ul>
            </div>

            <ul class="nav flex-column sidebar-menu align-items-center mb-12pt js-sidebar-mini-tabs" role="tablist">
                <li class="sidebar-account">
                    <a href="#sm_cuenta" class="p-4pt d-flex align-items-center justify-content-center" data-toggle="tab" role="tab" aria-controls="sm_cuenta">
                        <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">account_circle</i>
                        <span class="sidebar-menu-text">Cuenta</span>
                    </a>
                </li>
            </ul>

        </div>

        <!-- Contenido de las pestañas -->
        <div class="sidebar sidebar-light sidebar-left flex sidebar-secondary pt-16pt" data-perfect-scrollbar>
            <div class="tab-content">

                <!-- Tab Usuarios -->
                <?php if (!empty($_SESSION['permisos'][2]['r']) || !empty($_SESSION['permisos'][3]['r']) || !empty($_SESSION['permisos'][4]['r'])) { ?>
                    <div class="tab-pane fade active show" id="sm_usuarios">
                        <div class="sidebar-heading">Administración</div>
                        <ul class="sidebar-menu">
                            <?php if (!empty($_SESSION['permisos'][2]['r'])) { ?>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button" href="<?= base_url() ?>/Usuarios">
                                        <span class="sidebar-menu-text">Administradores</span>
                                    </a>
                                </li>
                            <?php } ?>
                            <?php if (!empty($_SESSION['permisos'][3]['r'])) { ?>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button" href="<?= base_url() ?>/Docentes">
                                        <span class="sidebar-menu-text">Docentes</span>
                                    </a>
                                </li>
                            <?php } ?>
                            <?php if (!empty($_SESSION['permisos'][4]['r'])) { ?>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button" href="<?= base_url() ?>/Estudiantes">
                                        <span class="sidebar-menu-text">Estudiantes</span>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>

                <!-- Tab Cursos -->
                <?php if (!empty($_SESSION['permisos'][6]['r']) || !empty($_SESSION['permisos'][7]['r'])) { ?>
                    <div class="tab-pane" id="sm_cursos">
                        <div class="sidebar-heading">Cursos</div>
                        <ul class="sidebar-menu">
                            <?php if (!empty($_SESSION['permisos'][6]['r'])) { ?>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button" href="<?= base_url() ?>/Cursos">
                                        <span class="sidebar-menu-text">Cursos</span>
                                    </a>
                                </li>
                            <?php } ?>
                            <?php if (!empty($_SESSION['permisos'][7]['r'])) { ?>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button" href="<?= base_url() ?>/Clases">
                                        <span class="sidebar-menu-text">Clases</span>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>

                <!-- Tab Filtros -->
                <?php if (!empty($_SESSION['permisos'][8]['r']) || !empty($_SESSION['permisos'][9]['r'])) { ?>
                    <div class="tab-pane" id="sm_filtros">
                        <div class="sidebar-heading">Filtros</div>
                        <ul class="sidebar-menu">
                            <?php if (!empty($_SESSION['permisos'][8]['r'])) { ?>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button" href="<?= base_url() ?>/Categorias">
                                        <span class="sidebar-menu-text">Categorías</span>
                                    </a>
                                </li>
                            <?php } ?>
                            <?php if (!empty($_SESSION['permisos'][9]['r'])) { ?>
                                <li class="sidebar-menu-item">
                                    <a class="sidebar-menu-button" href="<?= base_url() ?>/Plataformas">
                                        <span class="sidebar-menu-text">Plataformas</span>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>

                <!-- Tab Cuenta (siempre visible) -->
                <div class="tab-pane" id="sm_cuenta">
                    <div class="sidebar-heading">Cuenta</div>
                    <ul class="sidebar-menu">
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="<?= base_url() ?>/Cuenta">
                                <span class="sidebar-menu-text">Editar Datos</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="<?= base_url() ?>/Plataformas">
                                <span class="sidebar-menu-text">Recuperar Contraseña</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="<?= base_url() ?>/logout">
                                <span class="sidebar-menu-text">Cerrar Sesión</span>
                            </a>
                        </li>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="<?= base_url() ?>">
                                <span class="sidebar-menu-text">Volver</span>
                            </a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>

    </div>
</div>
<!-- // END drawer -->
