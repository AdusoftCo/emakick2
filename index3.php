<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE);

include 'conexion.php';
include 'calculos.php';   
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
  <title>Emakick's</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
</head>

<body>
  <div class="container-fluid p-0">
    <!-- Navbar with Bootstrap -->
    <nav class="navbar navbar-dropdown navbar-expand-lg navbar-light">
    <button class="navbar-toggler pt-4 pe-1" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
      aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="text-center mt-3 mb-3">
      <img src="imagenes/1.png" alt="Logo" width="90" height="90" class="img-fluid d-block mx-auto ronded">
    </div>  

    <!-- User Icon (Move this to the right corner) -->
    <div class="ml-auto d-flex align-items-center order-lg-2">
      <a class="nav-link pt-5 pe-3" href="#" role="button" data-bs-toggle="dropdown"
        data-bs-target="#userDropdownMenu">
        <i class="fas fa-user mobile-icon"></i>
      </a>
      <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdownMenu">
        <li><a class="dropdown-item" href="registro.php">Registro</a></li>
        <li><a class="dropdown-item" href="login.php">Iniciar Sesión</a></li>
      </ul>
    </div>

    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav mt-1 ps-3">
        <li class="nav-item">
          <a class="nav-link" href="#">Ofertas</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
            data-bs-target="#listadosDropdownMenu">Listados</a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown" id="listadosDropdownMenu">
            <li><a class="dropdown-item nav-link" href="#" data-bs-option="damas">Damas</a></li>
            <li><a class="dropdown-item nav-link" href="#" data-bs-option="masculinos">Hombres</a></li>
            <li><a class="dropdown-item nav-link" href="#" data-bs-option="medias">Medias</a></li>
            <li><a class="dropdown-item nav-link" href="#" data-bs-option="cami_son_setas">Camisones-Pijamas-Camisetas</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <button class="btn dropdown-toggle ps-0" type="button" id="dropdownText" data-bs-toggle="dropdown" aria-expanded="false">
              Contacto
          </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownText">
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
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle ml-0" href="#" role="button" data-bs-toggle="dropdown"
            data-bs-target="#lenceriaDropdownMenu">Lenceria</a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown" id="lenceriaDropdownMenu">
            <li><a class="dropdown-item" href="#" data-bs-option="damas">Damas</a></li>
            <li><a class="dropdown-item" href="#">Hombres</a></li>
            <li><a class="dropdown-item" href="#">Niños</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
  <!--Rest of the Body (Carrousel!)-->
  <div class="row justify-content-center">
    <div class="col-12 mt-0">
      <form id="searchForm" method="get" action="index3.php">
        <div class="input-group mb-2">
          <input type="text" class="form-control ms-3" id="searchQuery" name="searchQuery" placeholder="Buscar..."
                style="width: calc(90% - 50px);">
          <button class="btn" type="submit" style="color: #5728b7;"><i class="bi bi-search"></i></button>
        </div>
      </form>
    </div>
  </div>
  <div class="row justify-content-center carousel-row mt-4">
    <div class="col-12 p-0">
      <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <ol class="carousel-indicators">
          <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
          <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>
          <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="imagenes/Bikini0923-2.png" class="d-block w-100 carousel-image" alt="Image 1">
          </div>
          <div class="carousel-item">
            <img src="imagenes/Bikini0923B.png" class="d-block w-100 carousel-image" alt="Image 2">
          </div>
          <div class="carousel-item">
            <img src="imagenes/Bikini0923-4.png" class="d-block w-100 carousel-image" alt="Image 3">
          </div>
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
    generateSection("DAMAS", "imagenes/dama1_ps.png", "damas.php", "Mujer Image");

    generateSection("HOMBRES", "imagenes/hombre-playa.webp", "", "Hombre Image");

    generateSection("CHICOS", "imagenes/nina-playa.webp", "", "Niños Image");
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
<!-----Footer From Here !!!----->
<footer class="footer-dropdown mt-5">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <!-- First dropdown with text -->
        <div class="dropdown">
          <button class="btn boton dropdown-toggle w-100 text-start mb-2" type="button" 
          id="dropdownText" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="false">
            Información Del Local
          </button>
          <ul class="dropdown-menu" aria-labelledby="dropdownText">
            <li><p class="ms-3">
                  <i class="fas fa-map-marker-alt"></i>
                    Castelli 234 Local 1, Once C.A.B.A.
                </p></li>
            <li><p class="ms-3">
                  <i class="fas fa-phone"></i>
                  11 5653 2820
                </p></li>
            <li><p class="ms-3">
                  <i class="fas fa-envelope"></i>
                  janere_645@hotmail.com
                </p></li>
            <!-- Add more options as needed -->
          </ul>
        </div>
      </div>
      
      <div class="col-12">
          <!-- Second dropdown with links -->
          <div class="dropdown">
            <button class="btn boton dropdown-toggle w-100 text-start mb-3" type="button" 
            id="dropdownLinks" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="false">
              Información
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownLinks">
              <li><a class="dropdown-item" href="#">Nosotros</a></li>
              <li><a class="dropdown-item" href="#">Listas y Catalogos</a></li>
              <!-- Add more links as needed -->
            </ul>
          </div>
      </div>

      <div class="col-12 mt-2 mb-3 text-center">
        <a class="faceook me-4" href="https://facebook.com" target="_blank"><i class="fab fa-facebook fa-2x"></i></a>
        <a class="whatsapp" href="https://wa.me/5491150511072" target="_blank"><i class="fab fa-whatsapp fa-2x"></i></a>
      </div>

      <div class="footer-text">
        <p>Tienda Emakick's Lingerie 2023 @ Todos los derechos reservados</p>
        <p>Diseñado por Adusoft
        <span style="color:#FFD200; font-weight: strong;">❤</span>
        </p>
      </div>
    </div>
    
  </div>
</footer>

<!-- JavaScript Bundle -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <script>
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
    $('.navbar-nav .nav-link').on('click', function(e) {
      e.preventDefault();
      var opcion = $(this).attr('data-bs-option');
      if (opcion) {
        openTableModal(opcion);
      }
    });
    
    $('.navbar-nav .dropdown-menu .dropdown-item').on('click', function(e) {
      e.preventDefault();
      var opcion = $(this).text().trim().toLowerCase();
      if (opcion) {
        openTableModal(opcion);
      }
    });
  });  
  </script>
</body>
</html>
