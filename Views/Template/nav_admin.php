<!-- Sidebar -->
<div class="mdk-drawer js-mdk-drawer" id="default-drawer">
    <div class="mdk-drawer__content">
        <div class="sidebar sidebar-light sidebar-left" data-perfect-scrollbar>

            <!-- Inicio -->
            <div class="sidebar-heading">Inicio</div>
            <ul class="sidebar-menu">
                <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button" href="<?= base_url() ?>/dashboard">
                        <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">dashboard</span>
                        <span class="sidebar-menu-text">Dashboard</span>
                    </a>
                </li>
            </ul>

            <!-- Usuarios -->
            <?php if (!empty($_SESSION['permisos'][2]['r']) || !empty($_SESSION['permisos'][3]['r']) || !empty($_SESSION['permisos'][4]['r'])) { ?>
                <div class="sidebar-heading">Usuarios</div>
                <ul class="sidebar-menu">
                    <?php if (!empty($_SESSION['permisos'][2]['r'])) { ?>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="<?= base_url() ?>/Usuarios">
                                <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">admin_panel_settings</span>
                                <span class="sidebar-menu-text">Administradores</span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($_SESSION['permisos'][3]['r'])) { ?>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="<?= base_url() ?>/Docentes">
                                <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">school</span>
                                <span class="sidebar-menu-text">Docentes</span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($_SESSION['permisos'][4]['r'])) { ?>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="<?= base_url() ?>/Estudiantes">
                                <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">groups</span>
                                <span class="sidebar-menu-text">Estudiantes</span>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            <?php } ?>

            <!-- Roles -->
            <?php if (!empty($_SESSION['permisos'][5]['r'])) { ?>
                <div class="sidebar-heading">Seguridad</div>
                <ul class="sidebar-menu">
                    <li class="sidebar-menu-item">
                        <a class="sidebar-menu-button" href="<?= base_url() ?>/Roles">
                            <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">security</span>
                            <span class="sidebar-menu-text">Roles</span>
                        </a>
                    </li>
                </ul>
            <?php } ?>

            <!-- Cursos -->
            <?php if (!empty($_SESSION['permisos'][6]['r']) || !empty($_SESSION['permisos'][7]['r'])) { ?>
                <div class="sidebar-heading">Cursos</div>
                <ul class="sidebar-menu">
                    <?php if (!empty($_SESSION['permisos'][6]['r'])) { ?>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="<?= base_url() ?>/Cursos">
                                <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">menu_book</span>
                                <span class="sidebar-menu-text">Cursos</span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($_SESSION['permisos'][7]['r'])) { ?>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="<?= base_url() ?>/Clases">
                                <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">class</span>
                                <span class="sidebar-menu-text">Clases</span>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            <?php } ?>

            <!-- Filtros -->
            <?php if (!empty($_SESSION['permisos'][8]['r']) || !empty($_SESSION['permisos'][9]['r'])) { ?>
                <div class="sidebar-heading">Filtros</div>
                <ul class="sidebar-menu">
                    <?php if (!empty($_SESSION['permisos'][8]['r'])) { ?>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="<?= base_url() ?>/Categorias">
                                <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">category</span>
                                <span class="sidebar-menu-text">Categorías</span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($_SESSION['permisos'][9]['r'])) { ?>
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="<?= base_url() ?>/Plataformas">
                                <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">apps</span>
                                <span class="sidebar-menu-text">Plataformas</span>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            <?php } ?>

        </div>
    </div>
</div>
<!-- // END Sidebar -->
