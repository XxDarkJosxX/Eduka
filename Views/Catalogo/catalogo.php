<?php
headerprincipal($data);

?>


        <div class="page-section">
            <div class="container page__container">

                <div class="d-flex flex-column flex-sm-row align-items-sm-center mb-24pt" style="white-space: nowrap;">

                    <div class="w-auto">
                        <div class="input-group input-group-merge">
                            <input type="text" class="form-control form-control-prepended search-input" placeholder="Search courses">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="material-icons">search</i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-auto ml-sm-auto table d-flex align-items-center mb-2 mb-sm-0">
                        <small class="text-muted text-headings text-uppercase mr-3">Display</small>
                        <select class="form-control form-control-sm">
                            <option>10</option>
                            <option>20</option>
                            <option>30</option>
                            <option>40</option>
                            <option>50</option>
                            <option>100</option>
                        </select>
                    </div>
                    &nbsp;&nbsp;&nbsp;
                    <a href="#" data-target="#library-drawer" data-toggle="sidebar">
                        <i class="material-icons icon--left">tune</i> Filtros
                    </a>
                </div>


                <div class="page-separator">
                    <div class="page-separator__text">Development Courses</div>
                </div>

                <div class="row card-group-row" id="listcatalogo"></div>


                <div class="mb-32pt">
                    <ul class="pagination justify-content-start pagination-xsm m-0" id="paginationContainer">
                        <li class="page-item" id="previousPage">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true" class="material-icons">chevron_left</span>
                                <span>Prev</span>
                            </a>
                        </li>
                        <li class="page-item" id="nextPage">
                            <a class="page-link" href="#" aria-label="Next">
                                <span>Next</span>
                                <span aria-hidden="true" class="material-icons">chevron_right</span>
                            </a>
                        </li>
                    </ul>
                </div>



            </div>
        </div>

    </div>

    <div class="mdk-drawer js-mdk-drawer sub-layout-drawer" id="library-drawer" data-align="end">
        <div class="mdk-drawer__content ">
            <div class="sidebar sidebar-light sidebar-right py-16pt" data-perfect-scrollbar data-perfect-scrollbar-wheel-propagation="true">



                <div class="sidebar-heading">Categoria</div>
                <div class="sidebar-block listcategoria">
                </div>
                <div class="sidebar-heading">Platform</div>
                <div class="sidebar-block listplataforma">
                </div>

                <div class="sidebar-heading">Subscription</div>
                <div class="sidebar-block listsub"> </div>


            </div>
        </div>
    </div>

</div>


<?php
footerprincipal($data);

?>