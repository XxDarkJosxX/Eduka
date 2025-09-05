 <!-- drawer -->
 <div class="mdk-drawer js-mdk-drawer layout-mini__drawer" id="default-drawer">
     <div class="mdk-drawer__content js-sidebar-mini" data-responsive-width="992px" data-layout="mini">

         <div class="sidebar sidebar-mini sidebar-dark-pickled-bluewood sidebar-left d-flex flex-column">

             <!-- Brand -->
             <a class="sidebar-brand p-0 navbar-height d-flex justify-content-center">

                 <span class="avatar avatar-sm ">

                     <span class="avatar-title rounded bg-primary"><img src="<?= media() ?>/images/illustration/student/128/white.svg" class="img-fluid" alt="logo" /></span>

                 </span>

             </a>

             <div class="flex d-flex flex-column justify-content-start" data-perfect-scrollbar>
                 <ul style="margin: auto !important;" class="nav flex-shrink-0 flex-nowrap flex-column sidebar-menu mb-0 js-sidebar-mini-tabs" role="tablist">

                     <?php if (!empty($_SESSION['permisos'][2]['r'])) { ?>
                         <li class="sidebar-menu-item active" data-title="Usuarios" data-placement="right" data-container="body" data-boundary="window">

                             <a class="sidebar-menu-button" href="#sm_usuarios" data-toggle="tab" role="tab" aria-controls="sm_usuarios">
                                 <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">group</i>
                                 <span class="sidebar-menu-text">Usuarios</span>
                             </a>
                         </li>
                     <?php } ?>


                     <li class="sidebar-menu-item" data-title="Cursos" data-placement="right" data-boundary="window">
                         <a class="sidebar-menu-button" href="#sm_cursos" data-toggle="tab" role="tab" aria-controls="sm_cursos" aria-selected="false">
                             <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">school</i>
                             <span class="sidebar-menu-text">Cursos</span>
                         </a>
                     </li>


                     <li class="sidebar-menu-item" data-title="Filtros" data-placement="right" data-boundary="window">
                         <a class="sidebar-menu-button" href="#sm_filtros" data-toggle="tab" role="tab" aria-controls="sm_filtros" aria-selected="false">
                             <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">ballot</i>
                             <span class="sidebar-menu-text">Filtros</span>
                         </a>
                     </li>

                     <li class="sidebar-menu-item" data-title="Cuenta" data-placement="right" data-boundary="window">
                         <a class="sidebar-menu-button" href="#sm_cuenta" data-toggle="tab" role="tab" aria-controls="sm_cuenta" aria-selected="false">
                             <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">build</i>
                             <span class="sidebar-menu-text">Cuenta</span>
                         </a>
                     </li>

                 </ul>
             </div>

             <ul class="nav flex-column sidebar-menu align-items-center mb-12pt js-sidebar-mini-tabs" role="tablist">
                 <li class="sidebar-account">
                     <a href="#sm_cuenta" class="p-4pt d-flex align-items-center justify-content-center" data-toggle="tab" role="tab" aria-controls="sm_cuenta" aria-selected="true">
                         <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">account_circle</i>
                         <span class="sidebar-menu-text">Cuenta</span>
                     </a>
                 </li>
             </ul>

         </div>




         <div class="sidebar sidebar-light sidebar-left flex sidebar-secondary pt-16pt" data-perfect-scrollbar>

             <div class="tab-content">

              <?php if (!empty($_SESSION['permisos'][2]['r'])) { ?>
                 <div class="tab-pane fade active show" id="sm_usuarios">
                     <a class="sidebar-brand navadmin">
                         <!-- <img class="sidebar-brand-icon" src="../../public/images/illustration/student/128/white.svg" alt="Luma"> -->

                         <span class="avatar avatar-xl sidebar-brand-icon h-auto">

                             <span class="avatar-title rounded bg-primary"><img src="<?= media() ?>/images/illustration/student/128/white.svg" class="img-fluid" alt="logo"></span>

                         </span>

                         <span>Eduka</span>
                     </a>

                     <div class="sidebar-heading">Administracion</div>
                     <ul class="sidebar-menu">
                         <li class="sidebar-menu-item active">
                             <a class="sidebar-menu-button" data-toggle="collapse" href="#components_menu">
                                 <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">group</span>
                                 Usuarios
                                 <span class="ml-auto sidebar-menu-toggle-icon"></span>
                             </a>
                             <ul class="sidebar-submenu collapse sm-indent" id="components_menu">

                                 <li class="sidebar-menu-item">
                                     <a class="sidebar-menu-button" href="<?= base_url() ?>/Usuarios">
                                         <span class="sidebar-menu-text">Administradores</span>
                                     </a>
                                 </li>
                                 <li class="sidebar-menu-item">
                                     <a class="sidebar-menu-button" href="<?= base_url() ?>/Docentes">
                                         <span class="sidebar-menu-text">Docentes</span>
                                     </a>
                                 </li>
                                 <li class="sidebar-menu-item">
                                     <a class="sidebar-menu-button" href="<?= base_url() ?>/Estudiantes">
                                         <span class="sidebar-menu-text">Estudiantes</span>
                                     </a>
                                 </li>
                             </ul>
                         </li>

                         <li class="sidebar-menu-item">
                             <a class="sidebar-menu-button" data-toggle="collapse" href="#plugins_menu">
                                 <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">account_box</span>
                                 Roles de Usuarios
                                 <span class="ml-auto sidebar-menu-toggle-icon"></span>
                             </a>

                             <ul class="sidebar-submenu collapse sm-indent" id="plugins_menu">
                                 <li class="sidebar-menu-item">
                                     <a class="sidebar-menu-button" href="<?= base_url() ?>/Roles">
                                         <span class="sidebar-menu-text">Roles</span>
                                     </a>

                                 </li>

                             </ul>
                         </li>
                     </ul>
                 </div>

             <?php } ?>

                 <div class="tab-pane" id="sm_cursos">
                     <a class="sidebar-brand navadmin">
                         <!-- <img class="sidebar-brand-icon" src="../../public/images/illustration/student/128/white.svg" alt="Luma"> -->

                         <span class="avatar avatar-xl sidebar-brand-icon h-auto">

                             <span class="avatar-title rounded bg-primary"><img src="<?= media() ?>/images/illustration/student/128/white.svg" class="img-fluid" alt="logo"></span>

                         </span>

                         <span>Eduka</span>
                     </a>
                     <div class="sidebar-heading">Cursos</div>
                     <ul class="sidebar-menu">
                         <li class="sidebar-menu-item">
                             <a class="sidebar-menu-button" href="<?= base_url() ?>/Cursos">
                                 <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">school</span>
                                 <span class="sidebar-menu-text">Cursos</span>
                             </a>
                         </li>
                         <li class="sidebar-menu-item">
                             <a class="sidebar-menu-button" href="<?= base_url() ?>/Dcursos">
                                 <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">school</span>
                                 <span class="sidebar-menu-text">Mis Cursos</span>
                             </a>
                         </li>

                     </ul>
                 </div>


                 <div class="tab-pane" id="sm_filtros">
                     <a class="sidebar-brand navadmin">
                         <!-- <img class="sidebar-brand-icon" src="../../public/images/illustration/student/128/white.svg" alt="Luma"> -->

                         <span class="avatar avatar-xl sidebar-brand-icon h-auto">

                             <span class="avatar-title rounded bg-primary"><img src="<?= media() ?>/images/illustration/student/128/white.svg" class="img-fluid" alt="logo"></span>

                         </span>

                         <span>Eduka</span>
                     </a>
                     <div class="sidebar-heading">Filtros</div>
                     <ul class="sidebar-menu">
                         <li class="sidebar-menu-item">
                             <a class="sidebar-menu-button" href="<?= base_url() ?>/Categorias">
                                 <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">filter_1</span>
                                 <span class="sidebar-menu-text">Categorias</span>
                             </a>
                         </li>
                         <li class="sidebar-menu-item">
                             <a class="sidebar-menu-button" href="<?= base_url() ?>/Plataformas">
                                 <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">filter_2</span>
                                 <span class="sidebar-menu-text">Plataformas</span>
                             </a>
                         </li>
                     </ul>
                 </div>

                 <div class="tab-pane" id="sm_cuenta">
                     <a class="sidebar-brand navadmin">
                         <!-- <img class="sidebar-brand-icon" src="../../public/images/illustration/student/128/white.svg" alt="Luma"> -->

                         <span class="avatar avatar-xl sidebar-brand-icon h-auto">

                             <span class="avatar-title rounded bg-primary"><img src="<?= media() ?>/images/illustration/student/128/white.svg" class="img-fluid" alt="logo"></span>

                         </span>

                         <span>Eduka</span>
                     </a>
                     <div class="sidebar-heading">Cuenta</div>
                     <ul class="sidebar-menu">
                         <li class="sidebar-menu-item">
                             <a class="sidebar-menu-button" href="<?= base_url() ?>/Cuenta">
                                 <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">mode_edit</span>
                                 <span class="sidebar-menu-text">Editar Datos</span>
                             </a>
                         </li>
                         <li class="sidebar-menu-item">
                             <a class="sidebar-menu-button" href="<?= base_url() ?>/Plataformas">
                                 <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">email</span>
                                 <span class="sidebar-menu-text">Recuperar Contraseña</span>
                             </a>
                         </li>

                         <li class="sidebar-menu-item">
                             <a class="sidebar-menu-button" href="<?= base_url() ?>/logout">
                                 <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">first_page</span>
                                 <span class="sidebar-menu-text">Cerrar Sesión</span>
                             </a>
                         </li>

                         <li class="sidebar-menu-item">
                             <a class="sidebar-menu-button" href="<?= base_url() ?>">
                                 <span class="material-icons sidebar-menu-icon sidebar-menu-icon--left">subdirectory_arrow_left</span>
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