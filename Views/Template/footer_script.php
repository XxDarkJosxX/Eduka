
        <script>
            const baseurl="<?= base_url(); ?>";
        </script>
        <!-- jQuery -->
        <script src="<?= media() ?>/vendor/jquery.min.js"></script>
        <!-- jQuery personalisado-->
        <!--  Descargar las librerias-->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="<?= media() ?>/js/jquery-3.3.1.min.js"></script>
        <script src="<?= media() ?>/js/popper.min.js"></script>
        <script src="<?= media() ?>/js/bootstrap.min.js"></script>
        <script src="<?= media() ?>/vendor/bootstrap.min.js"></script>
        <script src="<?= media() ?>/js/main.js"></script>
        <!-- <script src="<?= media() ?>/js/plugins/pace.min.js"></script> -->
        <script src="<?= media() ?>/js/plugins/bootstrap-notify.min.js"></script>
        <script type="text/javascript" src="<?= media() ?>/js/plugins/sweetalert.min.js"></script>
        <!-- Data table plugin-->
        <script type="text/javascript" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script src="Assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="Assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

        <!-- Data table plugin-->
        <!-- Permite crear tablas de datos atractivas y altamente funcionales-->
        <script type="text/javascript" src="<?= media() ?>/js/plugins/dataTables.bootstrap.min.js"></script>
  
       
        <script type="text/javascript" src="<?= media() ?>/js/plugins/moment.min.js"></script>
        <!-- Bootstrap -->
        <!-- El popper libreria qua muestra mensajes emmergentes -->
        <!-- Esta Vendor-->
        <script src="<?= media() ?>/vendor/popper.min.js"></script>

     
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
      
        <!-- Perfect Scrollbar -->
        <script src="<?= media() ?>/vendor/perfect-scrollbar.min.js"></script>

        <!-- DOM Factory -->
        <script src="<?= media() ?>/vendor/dom-factory.js"></script>

        <!-- MDK -->
        <script src="<?= media() ?>/vendor/material-design-kit.js"></script>
   
        <!-- App JS -->
        <script src="<?= media() ?>/js/template/app.js"></script>

        <!-- Preloader -->
        <script src="<?= media() ?>/js/template/preloader.js"></script>


        <script src="<?= media() ?>/vendor/select2/select2.min.js"></script>
        <script src="<?= media() ?>/js/template/select2.js"></script>

        <script src="<?= media() ?>/vendor/quill.min.js"></script>
        <script src="<?= media() ?>/js/template/quill.js"></script>

        <!-- Sidebar Mini JS -->
        <script src="<?= media() ?>/js/template/sidebar-mini.js"></script>

 

        <script src="https://cdn.plyr.io/3.6.3/plyr.js"></script>
        <!--  
        <script>
            (function() {
                'use strict';
                // ENABLE sidebar menu tabs
                $('.js-sidebar-mini-tabs [data-toggle="tab"]').on('click', function(e) {
                    e.preventDefault()
                    $(this).tab('show')
                })
                $('.js-sidebar-mini-tabs').on('show.bs.tab', function(e) {
                    $('.js-sidebar-mini-tabs > .active').removeClass('active')
                    $(e.target).parent().addClass('active')
                })
            })()
        </script> -->
        <script src="<?= media() ?>/js/navscript.js"></script>

        <script src="<?= media() ?>/js/functions/<?= $data['page_js'] ?>?v3"></script>

        </body>
</html>
