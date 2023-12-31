<?php
session_start();
?>
<?php error_reporting(E_ALL ^ E_NOTICE); ?>
<?php include 'conexion.php'; ?>
<?php include 'navbar.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
  <title>Emakick's</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
</head>

<body>
  
  <div class="container-fluid p-0">
    <div class="row justify-content-center">
      <div class="col-12 mt-0">
        <form method="GET" action="search.php">
          <div class="input-group mb-2">
            <input type="text" class="form-control ms-3" name="query" placeholder="Buscar..."
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

    
      <div class="col-12 mt-5 mb-4 text-center">
        <h2>TEMPORADA PRIMAVERA-VERANO 2024</h2>
      </div>
      <div class="col-12 text-center">
        <img src="imagenes/dama1_ps.png" alt="Mujer Image" class="image-size">
      </div>
    

    
      <div class="col-12 mt-4 mb-4 text-center">
        <h2>HOMBRES</h2>
      </div>
      <div class="col-12 text-center">
        <img src="imagenes/hombre_ps.png" alt="Hombre Image" class="image-size"> 
      </div>
    
    
   
      <div class="col-12 mt-4 mb-4 text-center">
        <h2>CHICOS</h2>
      </div>
      <div class="col-12 text-center">
        <img src="imagenes/chica_ps.png" alt="Niños Image" class="image-size">
      </div>
   
    
  </div>
  
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

<!-- JavaScript Bundle with Popper -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
          integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
          crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
  integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  
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
