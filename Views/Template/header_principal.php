<!DOCTYPE html>
<html lang="es" dir="ltr">

<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title>Educka</title>

   <!-- Prevent the demo from appearing in search engines -->
   <meta name="robots" content="noindex">

   <link href="https://fonts.googleapis.com/css?family=Lato:400,700%7CRoboto:400,500%7CExo+2:600&display=swap" rel="stylesheet">

   <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

   <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/main.css">
   <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/sweetalert.css">
   <!-- la libreria es parte de selectpicker-->
   <link type="text/css" href="<?= media() ?>/vendor/select2/select2.min.css" rel="stylesheet">
   <link type="text/css" href="<?= media() ?>/css/select2.css" rel="stylesheet">

   <!-- Preloader -->
   <link type="text/css" href="<?= media() ?>/vendor/spinkit.css" rel="stylesheet">

   <!-- Perfect Scrollbar -->
   <link type="text/css" href="<?= media() ?>/vendor/perfect-scrollbar.css" rel="stylesheet">

   <!-- Material Design Icons -->
   <link type="text/css" href="<?= media() ?>/css/material-icons.css" rel="stylesheet">

   <!-- Font Awesome Icons -->
   <link type="text/css" href="<?= media() ?>/css/fontawesome.css" rel="stylesheet">

   <!-- Preloader -->
   <link type="text/css" href="<?= media() ?>/css/preloader.css" rel="stylesheet">

   <!-- App CSS -->
   <link type="text/css" href="<?= media() ?>/css/app.css" rel="stylesheet">
   <link type="text/css" href="<?= media() ?>/css/educka.css" rel="stylesheet">

   <link type="text/css" href="<?= media() ?>/css/quill.css" rel="stylesheet">
   <link type="text/css" href="<?= media() ?>/css/style.css" rel="stylesheet">
   <link rel="stylesheet" href="<?= media() ?>/js/dist/plyr.css" />

   <link type="text/css" href="<?= media() ?>/css/video.css" rel="stylesheet">

</head>

<body class="layout-mini layout-mini">

   
<div class="preloader">
        <div class="sk-chase">
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
        </div>

        
    </div>

   <div class="mdk-drawer-layout js-mdk-drawer-layout" data-push data-responsive-width="992px">
      <div class="mdk-drawer-layout__content page-content">
         <!-- Header -->

         <div class="navbar navbar-expand navbar-light border-bottom-2" id="default-navbar" data-primary>

            <!-- Navbar toggler -->
            <button class="navbar-toggler w-auto mr-16pt d-block d-lg-none rounded-0" type="button" data-toggle="sidebar">
               <span class="material-icons">short_text</span>
            </button>

            <!-- Navbar Brand -->
            <a class="navbar-brand mr-16pt d-lg-none" href="<?= base_url() ?>/">
               <!-- <img class="navbar-brand-icon" src="<?= media() ?>/images/logo/white-100@2x.png" width="30" alt="Luma"> -->
               <span class="avatar avatar-sm navbar-brand-icon mr-0 mr-lg-8pt">
                  <span class="avatar-title rounded bg-primary"><img src="<?= media() ?>/images/illustration/student/128/white.svg" alt="logo" class="img-fluid" /></span>
               </span>

               <span class="d-none d-lg-block">Educka</span>
            </a>

            <ul class="nav navbar-nav d-none d-sm-flex flex justify-content-start ml-8pt">
               <li class="nav-item active">
                  <a class="nav-link" href="<?= base_url() ?>/">Home </a>
               </li>
               <li class="nav-item active">
                  <a class="nav-link" href="<?= base_url() ?>/Catalogo">Catalogo </a>
               </li>
               <li class="nav-item active">
                  <a class="nav-link" href="<?= base_url() ?>/">Comentarios </a>
               </li>

            </ul>
            <ul class="nav navbar-nav ml-auto mr-0">

               <li class="nav-item">
                  <a class="btn btn-outline-dark" href="<?= base_url() ?>/Login">Inicio de Sesion</a>
               </li>
            </ul>
            <div class="mdk-drawer js-mdk-drawer layout-mini__drawer" id="default-drawer">
               <div class="mdk-drawer__content js-sidebar-mini">
                  <div class="sidebar sidebar-light sidebar-left flex sidebar-secondary pt-16pt" data-perfect-scrollbar>

                     <div class="tab-content">

                        <div class="tab-pane" id="sm_account_1">
                           <div class="sidebar-heading">Account</div>
                           <ul class="sidebar-menu">
                              <li class="sidebar-menu-item">
                                 <a class="sidebar-menu-button" href="edit-account.html">
                                    <span class="sidebar-menu-text">Edit Account</span>
                                 </a>
                              </li>
                              <li class="sidebar-menu-item">
                                 <a class="sidebar-menu-button" href="billing.html">Billing</a>
                              </li>
                              <li class="sidebar-menu-item">
                                 <a class="sidebar-menu-button" href="billing-history.html">Payments</a>
                              </li>
                              <li class="sidebar-menu-item">
                                 <a class="sidebar-menu-button" href="login.html">Logout</a>
                              </li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
            </div>








         </div>
         <!-- // END Header -->