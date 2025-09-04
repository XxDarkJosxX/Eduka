<?php
headerprincipal($data);

?>

<!-- Page Content -->

<div class="navbar navbar-light border-0 navbar-expand-sm" style="white-space: nowrap;">
    <div class="container page__container flex-column flex-sm-row">
        <nav class="nav navbar-nav">
            <div id="cardcurso" class="nav-item py-16pt py-sm-0">
                <!-- <div  class="media flex-nowrap">
                                    <div class="media-left mr-16pt">
                                        <a href="student-take-course.html"><img src="images/paths/angular_64x64.png"
                                                 width="40"
                                                 alt="Angular"
                                                 class="rounded"></a>
                                    </div>
                                    <div class="media-body d-flex flex-column">
                                        <a href="student-take-course.html"
                                           class="card-title">Angular Fundamentals</a>
                                        <div class="d-flex">
                                            <span class="text-50 small font-weight-bold mr-8pt">Elijah Murray</span>
                                            <span class="text-50 small">Software Engineer and Developer</span>
                                        </div>
                                    </div>
                                </div> -->
            </div>
        </nav>
        <ul class="nav navbar-nav ml-sm-auto align-items-center align-items-sm-end d-none d-lg-flex">
            <li class="nav-item">
                <a href="" class="nav-link">Comentarios</a>
            </li>
        </ul>
    </div>
</div>

<div class="bg-primary pb-lg-64pt py-32pt">
    <div class="container page__container">

        <div class="js-player bg-primary embed-responsive embed-responsive-16by9 mb-32pt">
            <div class="player embed-responsive-item">
                <div id="videoContainer">
                    <button id="loadVideoBtn">Reproducir video</button>
                    <div id="player"></div>
                    <div id="overlayEnd"></div>
                    <div id="overlayTop"></div>
                    <div id="overlayStart"></div>
                    <button id="btnFullscreen">Fullscreen</button>
                </div>
            </div>
        </div>

        <br><br>
        <div class="d-flex flex-wrap align-items-end mb-16pt">
            <h1 class="text-white flex m-0 tituloclase"></h1>

        </div>

        <p style="color:black !important; font-size: 15px;" id="descripclase" class="hero__lead measure-hero-lead text-white-50 mb-24pt"></p>


    </div>
</div>

<div class="page-section border-bottom-2">
    <div class="container page__container">

        <div class="page-separator">
            <div class="page-separator__text">Tabla de Contenido</div>
        </div>
        <div class="row mb-0">
            <div class="col-lg-7">

                <div class="accordion js-accordion accordion--boxed list-group-flush" id="parent">


                    <div class="accordion__item open">
                        <a href="#" class="accordion__toggle" data-toggle="collapse" data-parent="#parent">
                            <span class="flex">Comienza las Clases</span>
                            <!-- <span class="accordion__toggle-icon material-icons">keyboard_arrow_down</span> -->
                        </a>
                        <div class="accordion__menu collapse show" id="course-toc-2">


                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-5 justify-content-center">

                <div class="card">
                    <div class="card-body py-16pt text-center">
                        <span class="icon-holder icon-holder--outline-secondary rounded-circle d-inline-flex mb-8pt">
                            <i class="material-icons">timer</i>
                        </span>
                        <h4 class="card-title"><strong>Acceso Limitado</strong></h4>
                        <p class="card-subtitle text-70 mb-24pt">Para acceder a todo el contenido suscribete</p>

                        <div class="posts-cards" id="fileSection">
                            <!-- Aquí se cargará el archivo con JS -->
                        </div>


                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<div class="page-section">
    <div class="container page__container">
        <div class="pt-3">
            <!-- Formulario de comentario (más adelante servirá para enviar) -->
            <div class="d-flex mb-4">
                <a href="" class="avatar avatar-sm mr-12pt">
                    <span class="avatar-title rounded-circle">LB</span>
                </a>
                <div class="flex">
                    <div class="form-group">
                        <label for="comment" class="form-label">Your reply</label>
                        <textarea class="form-control" name="comment" id="comment" rows="3"
                            placeholder="Type here..."></textarea>
                    </div>
                    <button id="btnPostComment" class="btn btn-outline-secondary">Post comment</button>
                </div>
            </div>

            <!-- Contador de comentarios -->
            <h4 id="commentCount">0 Comments</h4>

            <!-- Aquí se listarán los comentarios -->
            <div id="commentList"></div>
        </div>
    </div>
</div>

<!-- // END Page Content -->

<?php
footerprincipal($data);

?>