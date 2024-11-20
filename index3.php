<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE);

include 'conexion.php';
include 'calculos.php';

$conexion = new conexion();
$results = [];

// Check if a search query is submitted
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['searchQuery'])) {
    $numTables = 4;
    $searchQuery = $_GET['searchQuery'];
    
    // Specify the tables you want to search
    $tables = ["camisonetas", "femeninterior", "masculinos", "medias"];

    $searchResult = $conexion->search("%$searchQuery%", $tables, $numTables);
    
    if ($searchResult && !empty($searchResult['data'])) {
      // If results are found, display them
      $results = $searchResult['data'];
      $table = $searchResult['table'];
      displaySearchResults($results, $table, $numTables);
    } else {
      // If no results are found, display a message
      echo "No hay registros con esa Palabra!.";
    }
    exit(); // Exit to prevent the rest of the page from being rendered
}
?>
     
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
  <title>Emakick's Lingerie</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="icon" type="image/x-icon" href="imagenes/favicon-32x32.png">
  <link rel="stylesheet" type="text/css" href="css/estilos.css">
</head>

<body>

  <div class="container-fluid p-0">
    <nav class="navbar navbar-dropdown navbar-expand-lg navbar-light">
      <!--Button Hamburger-->
      <button class="navbar-toggler pt-4 pe-1" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
        aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!--Logo Imagen-->
      <div class="text-center mt-3 mb-3">
        <a href="javascript:void(0);" onclick="window.location.reload();">
          <img src="imagenes/emakick's.png" alt="Logo" width="90" height="90" class="img-fluid d-block mx-auto ronded">
        </a>  
      </div>  

      <div class="ml-auto d-flex align-items-center order-lg-2">
        <!--Formulario Searching -->
        <form class="d-flex align-items-center" id="search-form" method="get">
          <div class="input-group">
              <a class="nav-link pt-5 pe-2" href="#" role="submit" data-bs-toggle="dropdown" data-bs-target="#userDropdown">
                  <i class="fas fa-search"></i>
              </a>
              <ul class="dropdown-menu dropdown-menu-end cust" aria-labelledby="userDropdown">
                  <li>
                      <div class="input-group ingrp">
                          <input class="form-control mb-0 custom-search-input" type="text" id="searchQuery" name="searchQuery" placeholder="Buscar ...">
                          <button type="submit" class="search-icon">
                              <i class="fas fa-search"></i>
                          </button>
                      </div>
                  </li>
              </ul>
          </div>
        </form>
        
        <!--Dropdown Users-->
        <a class="nav-link pt-5 pe-3" href="#" role="button" data-bs-toggle="dropdown" data-bs-target="#userDropdownMenu">
            <i class="fas fa-user mobile-icon"></i>
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdownMenu">
            <li><a class="dropdown-item" href="registro.php">Registro</a></li>
            <li><a class="dropdown-item" href="login.php">Iniciar Sesión</a></li>
        </ul>
      </div>

      <!--Dropdown Categories -->
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav mt-1 ps-3">
          <li class="nav-item">
            <a class="nav-link" href="ofertas.php">Ofertas</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
              data-bs-target="#listadosDropdownMenu">Listados</a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown" id="listadosDropdownMenu">
              <li><a class="dropdown-item nav-link" href="#" data-bs-option="femeninterior">Damas</a></li>
              <li><a class="dropdown-item nav-link" href="#" data-bs-option="masculinos">Hombres</a></li>
              <li><a class="dropdown-item nav-link" href="#" data-bs-option="medias">Medias</a></li>
              <li><a class="dropdown-item nav-link" href="#" data-bs-option="camisonetas">Camisones-Pijamas-Camisetas</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle ml-0" href="#" role="button" data-bs-toggle="dropdown"
              data-bs-target="#lenceriaDropdownMenu">Lenceria</a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown" id="lenceriaDropdownMenu">
              <li><a class="dropdown-item" href="#" data-bs-option="damas">Damas</a></li>
              <li><a class="dropdown-item" href="#" data-bs-option="hombres">Hombres</a></li>
              <li><a class="dropdown-item" href="#" data-bs-option="ninos">Niños</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle ps-0" href="#" role="button" data-bs-toggle="dropdown" 
              data-bs-target="dropdownText">Contacto</a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown" id="dropdownText">
                <li><p class="ms-3">
                      <i class="fas fa-map-marker-alt"></i>
                        Castelli 234 Local 1, Once C.A.B.A.
                    </p>
                </li>
                <li><p class="ms-3">
                      <i class="fas fa-phone"></i>
                      11 5653 2820
                    </p>
                </li>
                <li><p class="ms-3">
                      <i class="fas fa-envelope"></i>
                      janere_645@hotmail.com
                    </p>
                </li>
              </ul>
          </li>
        </ul>
      </div>
    </nav>
  </div>
  
  <div class="row d-flex justify-content-center">
    <div class="col-md-10 col-sm-6 mt-3 text-center">
      <div id="search-results-container">
        <!-- Insertion will begin here dynamically -->
        
      </div>
    </div>
  </div>

  <!--Rest of the Body (Carrousel!) -->
  <div class="row justify-content-center carousel-row mt-4">
    <div class="col-12 p-0">
      <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <ol class="carousel-indicators">
          <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
          <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>
          <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></li>
          <!--<li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3"></li>-->
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <a href="ofertas.php">
              <img src="imagenes/oferta4.png" class="d-block w-100 carousel-image img-fluid mx-auto" style="max-width: 80%;" alt="Image 1">
            </a>
          </div>
          <div class="carousel-item">
            <img src="imagenes/localEmaK09.png" class="d-block w-100 carousel-image img-fluid mx-auto" style="max-width: 80%;" alt="Image 2">
          </div>
          <div class="carousel-item">
            <a href="galeriaSol.php">
              <img src="imagenes/galeriaSol09.png" class="d-block w-100 carousel-image img-fluid mx-auto" style="max-width: 80%;" alt="Image 3">
            </a>
          </div>
          <!--<div class="carousel-item">
            <img src="imagenes/bikiniCeky1.png" class="d-block w-100 carousel-image img-fluid mx-auto" style="max-width: 85%;" alt="Image 4">
          </div>-->
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </a>
      </div>
    </div>
  </div>

  <div class="text-pink">
    <div class="col-12 mt-5 mb-4 text-center">
      <h2>TEMPORADA VERANO 2024</h2>
    </div>

    <?php
    // Example usage of the generateSection function
    //generateSection("TEMPORADA VERANO 2024", "imagenes/verano.png", "Verano Image");
    generateSection("DAMAS", "imagenes/mujerMxM.png", "damas.php", "Mujer Image");

    generateSection("HOMBRES", "imagenes/g3man.jpg", "", "Hombre Image");

    generateSection("CHICOS", "imagenes/mediasChicos24.png", "", "Niños Image");
    ?>
  
    <!-- Modal to display the table content -->
    <div class="modal fade" id="tableModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Lista de Precios</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div id="tableWrapper"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
  </div>

<?php include 'footer.php'; ?>

  <!-- JavaScript Bundle -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script>
    // Use jQuery in noConflict mode
    var $ = jQuery.noConflict();
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="js/scripts.js"></script>
  
  <script>
    document.getElementById('search-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent normal form submission

    let searchQuery = document.getElementById('searchQuery').value;

    // Perform the AJAX request
    fetch('index3.php?searchQuery=' + encodeURIComponent(searchQuery))
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.text();
        })
        .then(html => {
            // Insert the response HTML into the results container, replacing all content
            document.getElementById('search-results-container').innerHTML = html;
            
            // Optionally scroll to the top of the page to focus on the search results
            window.scrollTo(0, 0);
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('search-results-container').innerHTML = '<p>Error loading results. Please try again.</p>';
        });
    });
  </script>
  
  <script>
    //Modal Table
    $(document).ready(function() {
      var modal = $('#tableModal');
      var tableWrapper = $('#tableWrapper');

      function openTableModal(table) {
        $.ajax({
            url: 'table.php?opcion=' + table,
            method: 'GET',
            success: function (response) {
              // Display the table content in the modal
              $('#tableWrapper').html(response);
              // Show the modal
              $('#tableModal').modal('show');
            },
            error: function () {
                console.log('Error al obtener la tabla');
            }
        });
      }
    
      $(".dropdown").on("click", function() {
        $(this).toggleClass("open");
      });

      // Handle the click event for the links inside the navbar and dropdown menu
      $('.navbar-nav .dropdown-menu .dropdown-item').on('click', function(e) {
        e.preventDefault();
        var opcion = $(this).attr('data-bs-option');
      
        // Check if the target is the modal
        if ($(this).closest('.dropdown').find('.nav-link').attr('data-bs-target') === '#listadosDropdownMenu') {
          openTableModal(opcion);
        } else {
        // Redirect to the target page
          window.location.href = opcion + '.php';
        }
      });
    });  
  </script>

</body>
</html>
