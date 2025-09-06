let catalogoData = []; // Copia de los datos originales
let filteredData = []; // Datos filtrados por búsqueda


// Número de tarjetas por página
let cardsPerPage = 10;

// Elementos del DOM
const listcatalogo = document.querySelector('#listcatalogo');
const paginationContainer = document.querySelector('#paginationContainer');
const searchInput = document.querySelector('.search-input');
const coursesPerPageSelect = document.querySelector('.form-control-sm');



// Función para generar las tarjetas HTML
function generateCardHTML(clase) {
    return `
    <div class="col-md-6 col-lg-4 col-xl-3 card-group-row__col">
    <div class="card card-sm card--elevated p-relative o-hidden overlay overlay--primary-dodger-blue js-overlay card-group-row__card" data-toggle="popover" data-trigger="click">
        <div class="card-img-top js-image cardcurso" data-position="center"  data-height="140">
            <img src="${baseurl + clase.portadaurl}" alt="course">
            
        </div>
        <div class="card-body flex">
            <div class="d-flex">
                <div class="flex">
                    <div class="card-title btncurso" onclick="fntcurso(${clase.idcurso})">${clase.titulo}</div>
                    <small class="text-50 font-weight-bold mb-4pt">${clase.nombre} ${clase.apellidos}</small>
                </div>
                <input type="checkbox" id="${clase.idcurso}" class="favorite-checkbox visually-hidden"/>
                <label for="${clase.idcurso}" class="ml-4pt material-icons text-20 card-course__icon-favorite">
                    favorite
                </label>
            </div>
        </div>
        <div class="card-footer">
            <div class="row justify-content-between">
                <div class="col-auto d-flex align-items-center">
                    <span class="material-icons icon-16pt text-50 mr-4pt">access_time</span>
                    <p class="flex text-50 lh-1 mb-0"><small>6 hours</small></p>
                </div>
                <div class="col-auto d-flex align-items-center">
                    <span class="material-icons icon-16pt text-50 mr-4pt">play_circle_outline</span>
                    <p class="flex text-50 lh-1 mb-0"><small>12 lessons</small></p>
                </div>
            </div>
        </div>
    </div>
</div>
    `;
}

// Función para cargar las tarjetas en la página actual
function loadCards(page) {
    const startIndex = (page - 1) * cardsPerPage;
    const endIndex = startIndex + cardsPerPage;

    const slicedData = filteredData.slice(startIndex, endIndex);
    const cardsHTML = slicedData.map(generateCardHTML).join('');

    listcatalogo.innerHTML = cardsHTML;
}

// Función para manejar el cambio de página
function handlePageChange(page) {
    loadCards(page);
    updatePageNumbers(page);
}

// Restablecer la lista de datos filtrados
function resetFilteredData() {
    filteredData = catalogoData.slice();
}

// Función para actualizar el número de página activo
function updatePaginationActive(page) {
    const activePageElement = document.querySelector('.pagination .page-item.active');
    if (activePageElement) {
        activePageElement.classList.remove('active');
    }

    const currentPageElement = document.querySelector(`#page${page}`);
    if (currentPageElement) {
        currentPageElement.classList.add('active');
    }
}

// Restablecer la búsqueda y recargar los datos originales
// function resetSearch() {
//     searchInput.value = '';
//     filteredData = catalogoData.slice();
//     handlePageChange(1);
// }

// Función para generar los elementos de página
function generatePageElements(startPage, endPage) {
    let pageElementsHTML = '';

    for (let i = startPage; i <= endPage; i++) {
        pageElementsHTML += `
            <li class="page-item" id="page${i}">
                <a class="page-link" href="#">${i}</a>
            </li>
        `;
    }

    paginationContainer.innerHTML = `
        <li class="page-item" id="previousPage">
            <a class="page-link" href="#" aria-label="Previous">
                <span aria-hidden="true" class="material-icons">chevron_left</span>
                <span>Prev</span>
            </a>
        </li>
        ${pageElementsHTML}
        <li class="page-item" id="nextPage">
            <a class="page-link" href="#" aria-label="Next">
                <span>Next</span>
                <span aria-hidden="true" class="material-icons">chevron_right</span>
            </a>
        </li>
    `;
}

// Función para actualizar los números de página
function updatePageNumbers(currentPage) {
    const totalPages = Math.ceil(catalogoData.length / cardsPerPage);
    let startPage, endPage;

    if (totalPages <= 5) {
        startPage = 1;
        endPage = totalPages;
    } else {
        if (currentPage <= 3) {
            startPage = 1;
            endPage = 5;
        } else if (currentPage >= totalPages - 2) {
            startPage = totalPages - 4;
            endPage = totalPages;
        } else {
            startPage = currentPage - 2;
            endPage = currentPage + 2;
        }
    }

    generatePageElements(startPage, endPage);
    updatePaginationActive(currentPage);
}

// Función para inicializar la paginación
function initializePagination() {
    const totalPages = Math.ceil(catalogoData.length / cardsPerPage);
    generatePageElements(1, Math.min(totalPages, 5));
    updatePaginationActive(1);

    paginationContainer.addEventListener('click', function (event) {
        event.preventDefault();
        const targetId = event.target.closest('.page-link').parentNode.id;

        if (targetId === 'previousPage') {
            const currentPage = getCurrentPage();
            if (currentPage > 1) {
                handlePageChange(currentPage - 1);
            }
        } else if (targetId === 'nextPage') {
            const currentPage = getCurrentPage();
            if (currentPage < totalPages) {
                handlePageChange(currentPage + 1);
            }
        } else {
            const page = parseInt(targetId.replace('page', ''));
            handlePageChange(page);
        }
    });
}

// Función para obtener la página actual
function getCurrentPage() {
    const activePageElement = document.querySelector('.pagination .page-item.active');
    return parseInt(activePageElement.id.replace('page', ''));
}

// Evento para realizar la búsqueda
searchInput.addEventListener('input', function (event) {
    const searchTerm = event.target.value.toLowerCase();
    filteredData = catalogoData.filter(function (clase) {
        return clase.titulo.toLowerCase().includes(searchTerm);
    });

    handlePageChange(1);
});

// Evento para cambiar la cantidad de cursos por página
coursesPerPageSelect.addEventListener('change', function (event) {
    cardsPerPage = parseInt(event.target.value);
    handlePageChange(1);
});

// Cargar datos de forma dinámica mediante Ajax
$.ajax({
    url: baseurl + "/Catalogo/getcursos",
    type: "GET",
    dataType: "json",
    success: function (data) {
        catalogoData = data;
        resetFilteredData(); // Crear una copia inicial de los datos originales
        handlePageChange(1);
        initializePagination();
    },
    error: function (xhr, status, error) {
        console.log("Error al cargar los datos:", error);
    }
});



//Filtros de las categorias


const listcategoria = document.querySelector('.listcategoria');

// Cargar categorías de forma dinámica mediante Ajax
$.ajax({
    url: baseurl + "/Catalogo/getcategorias",
    type: "GET",
    dataType: "json",
    success: function (data) {
        const categorias = data;

        // Generar HTML de las categorías
        const categoriasHTML = `
        ${categorias.map(function (categoria) {
            return `
                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" value="${categoria.idcategoria}" id="catFiltersCheck${categoria.idcategoria}">
                        <label class="custom-control-label" for="catFiltersCheck${categoria.idcategoria}">${categoria.nombre}</label>
                    </div>
                </div>
            `;
        }).join('')}`;

        // Agregar las categorías al elemento listcategoria
        listcategoria.innerHTML = categoriasHTML;
    },
    error: function (xhr, status, error) {
        console.log("Error al cargar las categorías:", error);
    }
});



// // Restablecer la búsqueda y los filtros de categorías
// function resetSearch() {
//     searchInput.value = '';
//     filteredData = catalogoData.slice();
//     resetCategoryFilters();
//     handlePageChange(1);
// }

// Restablecer los filtros de categorías
function resetCategoryFilters() {
    Array.from(listcategoria.querySelectorAll('input[type="checkbox"]:checked')).forEach(function (checkbox) {
        checkbox.checked = false;
    });
}


// Filtros plataformas


const listplataforma = document.querySelector('.listplataforma');

// Cargar plataformas de forma dinámica mediante Ajax
$.ajax({
    url: baseurl + "/Catalogo/getplataformas",
    type: "GET",
    dataType: "json",
    success: function (data) {
        const plataformas = data;

        // Generar HTML de las plataformas
        const plataformasHTML = `
${plataformas.map(function (plataforma) {
            return `
        <div class="form-group">
            <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="checkbox" value="${plataforma.idplataforma}" id="platFiltersCheck${plataforma.idplataforma}">
                <label class="custom-control-label" for="platFiltersCheck${plataforma.idplataforma}">${plataforma.nombre}</label>
            </div>
        </div>
    `;
        }).join('')}`;

        // Agregar las plataformas al elemento listplataforma
        listplataforma.innerHTML = plataformasHTML;
    },
    error: function (xhr, status, error) {
        console.log("Error al cargar las plataformas:", error);
    }
});

// Restablecer la búsqueda, los filtros de categorías y los filtros de plataformas
function resetSearch() {
    searchInput.value = '';
    filteredData = catalogoData.slice();
    resetCategoryFilters();
    resetPlatformFilters();
    handlePageChange(1);
}



// Restablecer los filtros de plataformas
function resetPlatformFilters() {
    Array.from(listplataforma.querySelectorAll('input[type="checkbox"]:checked')).forEach(function (checkbox) {
        checkbox.checked = false;
    });
}






//Subscripcion


const listsuscripcion = document.querySelector('.listsub');


const suscripcionHTML = `
<div class="form-group">
    <div class="custom-control custom-radio">
        <input class="custom-control-input" type="radio" name="filtersSuscripcion" value="all" id="filtersSuscripcionAll" checked>
        <label class="custom-control-label" for="filtersSuscripcionAll">Todas las suscripciones</label>
    </div>
</div>
<div class="form-group">
    <div class="custom-control custom-radio">
        <input class="custom-control-input" type="radio" name="filtersSuscripcion" value="1" id="filtersSuscripcionGratis">
        <label class="custom-control-label" for="filtersSuscripcionGratis">Gratis</label>
    </div>
</div>
<div class="form-group">
    <div class="custom-control custom-radio">
        <input class="custom-control-input" type="radio" name="filtersSuscripcion" value="0" id="filtersSuscripcionSuscripcion">
        <label class="custom-control-label" for="filtersSuscripcionSuscripcion">Suscripción</label>
    </div>
</div>`;

listsuscripcion.innerHTML = suscripcionHTML;

function applyFilters() {
    const selectedCategories = Array.from(listcategoria.querySelectorAll('input[type="checkbox"]:checked')).map(function (checkbox) {
        return checkbox.value;
    });

    const selectedPlatforms = Array.from(listplataforma.querySelectorAll('input[type="checkbox"]:checked')).map(function (checkbox) {
        return checkbox.value;
    });

    const selectedSuscripcion = listsuscripcion.querySelector('input[type="radio"]:checked').value;

    if ((selectedCategories.length === 0 || selectedCategories.includes('all')) && (selectedPlatforms.length === 0 || selectedPlatforms.includes('all')) && selectedSuscripcion === 'all') {
        // No se seleccionaron categorías, plataformas ni suscripción, se muestran todos los cursos
        filteredData = catalogoData.slice();
    } else {
        // Filtrar los datos por categorías, plataformas y suscripción seleccionadas

        filteredData = catalogoData.filter(function (clase) {
            const categoryMatch = selectedCategories.length === 0 || selectedCategories.includes(clase.idcategoria.toString());
            const platformMatch = selectedPlatforms.length === 0 || selectedPlatforms.includes(clase.idplataforma.toString());
            const suscripcionMatch = selectedSuscripcion === 'all' || selectedSuscripcion.includes(clase.privacidad.toString());
            return categoryMatch && platformMatch && suscripcionMatch;
        });
    }

    handlePageChange(1);
}


// Eventos para cambiar los filtros de categorías y plataformas
listcategoria.addEventListener('change', applyFilters);
listplataforma.addEventListener('change', applyFilters);
listsuscripcion.addEventListener('change', applyFilters);







//evento para redireccion al curso
function fntcurso(rl) {
    var idcurso = rl;

    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = baseurl + '/Catalogo/asingclases/' + idcurso;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            window.location = baseurl + "/Contenido";
        }
    };
}