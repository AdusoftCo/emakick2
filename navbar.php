<!DOCTYPE html>
<html lang="en">
<head>
  <!-- ... Your meta tags and links ... -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulario Inicio</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  
  <style>
    .ronded {
      border-radius: 10%;
      overflow: hidden;
    }
    /* Add this to your existing CSS styles */
    .navbar-light .navbar-toggler-icon {
        background-color: #fff; /* Change to your desired dark color */
    }

    .navbar-light .navbar-nav .nav-link {
        color: #000; /* Change to your desired dark color */
    }

    /* Adjust the top margin and padding for alignment */
    .navbar-toggler {
      z-index: 1001;
      margin-top: 1.5rem; /* Adjust as needed */
      padding-top: 0.25rem; /* Adjust as needed */
    }
    
    /* Adjust the top margin for dropdowns */
    .dropdown-menu[data-bs-popper] {
      background-color: #f8f8fe;
      top: 80%; /* Adjust as needed */
    }
    .navbar-collapse {
      /* Customize the background color */
      margin-top: 20px;
      z-index: 1000;
      background-color: #f8f8fe; /* Set your desired background color */
      position: absolute;
      width: 100%;
      max-height: calc(100vh - 96px);
      overflow-y: auto;
      top: 96px;
      left: 0;
    }
  </style>
<body>

<div class="container-fluid p-0">

  <nav class="navbar navbar-expand-lg navbar-light">
    <button class="navbar-toggler pt-4 pe-1" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
      aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="text-center mt-3 mb-3">
      <img src="imagenes/1.png" alt="Logo" width="90" height="90" class="img-fluid d-block mx-auto ronded">
    </div>  
    <!--<a class="navbar-brand mx-auto" href="#">Your Website</a>

     User Icon (Move this to the right corner) -->
    <div class="ml-auto d-flex align-items-center order-lg-2">
      <a class="nav-link pt-5 pe-3" href="#" role="button" data-bs-toggle="dropdown"
        data-bs-target="#userDropdownMenu">
        <i class="fas fa-user mobile-icon"></i>
      </a>
      <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdownMenu">
        <li><a class="dropdown-item" href="#">Registro</a></li>
        <li><a class="dropdown-item" href="login.php">Iniciar Sesión</a></li>
      </ul>
    </div>

    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav mt-1 ps-3">
        <li class="nav-item">
          <a class="nav-link" href="about.php">Ofertas</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
            data-bs-target="#listadosDropdownMenu">Listados</a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown" id="listadosDropdownMenu">
            <li><a class="dropdown-item nav-link" href="#" data-bs-option="femeninterior">Damas</a></li>
            <li><a class="dropdown-item nav-link" href="#" data-bs-option="masculinos">Hombres</a></li>
            <li><a class="dropdown-item nav-link" href="#" data-bs-option="medias">Medias</a></li>
            <li><a class="dropdown-item nav-link" href="#" data-bs-option="cami_son_setas">Camisones-Pijamas-Camisetas</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link ml-1" href="contact.php">Contacto</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle ml-0" href="#" role="button" data-bs-toggle="dropdown"
            data-bs-target="#lenceriaDropdownMenu">Lenceria</a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown" id="lenceriaDropdownMenu">
            <li><a class="dropdown-item" href="#">Damas</a></li>
            <li><a class="dropdown-item" href="#">Hombres</a></li>
            <li><a class="dropdown-item" href="#">Niños</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</script>

</body>
