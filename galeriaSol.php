<?php
session_start();  // Start the session to store the message
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';

// PHP Script to Handle the Form Submission and File Upload
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
    $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
    $message = isset($_POST['message']) ? htmlspecialchars($_POST['message']) : '';

    // Check if all fields are filled in
    if (!empty($name) && !empty($email) && !empty($message)) {
      // PHPMailer settings
      $mail = new PHPMailer(true);

      try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth   = true;
        $mail->Username   = '6f5ede4cfdcc27';
        $mail->Password   = '13a8977d80f675';
        $mail->Port       = 2525;

        // Recipients
        $mail->setFrom('janere_645@hotmail.com', 'Your Website Name');
        $mail->addAddress('janere_645@hotmail.com', 'Contact Receiver');

        // Email content
        $mail->isHTML(true);
        $mail->Subject = 'Nuevo mensaje de contacto';
        $mail->Body    = "<strong>Nombre:</strong> $name<br><strong>Email:</strong> $email<br><strong>Mensaje:</strong><br>$message";

        $mail->send();
        $_SESSION['message'] = 'Mensaje enviado exitosamente. ¡Gracias, ' . $name . ' !';

    } catch (Exception $e) {
      $_SESSION['message'] = "Error: {$mail->ErrorInfo}";  
    }
    // Redirect to avoid resubmission on refresh
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;

    }else {
      $_SESSION['message'] = "Error: Todos los campos son obligatorios.";
      header("Location: " . $_SERVER['PHP_SELF']);
      exit;
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeria Feria del Sol</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&display=swap');

        /* Custom styles */
        :root {
            --bs-navbar-toggler-icon-bg: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%280, 0, 0, 0.5%29' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }
        body {
            
            margin: 20px;
            padding: 0;
        }
        .line-below {
            width: 100%; 
            height: 2px; 
            background: linear-gradient(to right, #3b3a52, #757bb8); 
            margin: 15px auto; 
            border-radius: 1px;
        }

        /* Custom styles for the header section */
        .header-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 10px;
            position: relative; /* For the button positioning */
        }
        
        .back-button {
            position: absolute;
            left: 10px; /* Position to the left side */
            top: 10px;
            color: black; /* Adjust the color if needed */
        }

        .navbar-toggler-icon {
            width: 1.5em;
            height: 1.5em;
            background-image: none; /* Remove Bootstrap's default icon */
            position: relative;
        }

        .navbar-toggler-icon::before,
        .navbar-toggler-icon::after,
        .navbar-toggler-icon div {
            content: '';
            display: block;
            width: 100%;
            height: 0.2em; /* Adjust thickness */
            background-color: #000; /* Adjust color */
            position: absolute;
            left: 0;
        }

        .navbar-toggler-icon::before {
            top: 0.3em; /* Position of the top bar */
        }

        .navbar-toggler-icon div {
            top: 0.7em; /* Position of the middle bar */
        }

        .navbar-toggler-icon::after {
            bottom: 0.2em; /* Position of the bottom bar */
        }

        .menu-button {
            position: absolute;
            right: 10px; /* Position to the right side */
            top: 10px;
        }
        /* Apply the imported fonts */
        .tituloGaleria {
          font-family: "Libre Baskerville", serif;
          color: #5728b7;
          font-weight: 700;
          font-style: normal;
        }
        .tituloGal {
          font-family: "Libre Baskerville", serif;
          font-weight: 400;
          font-style: italic;
        }
        .carousel-item {
            max-height: 400px; /* Set the same maximum height for all carousel items */
            overflow: hidden;  /*Hide any overflowing content */
        }
        .carousel-image {
            object-fit: cover; /* Makes sure the image fits the div without stretching */
            max-width: 100%;
            max-height: 400px;
        }
        .fcc-btn {
          display: block; /* Make each button take the full width of the container */
          width: 100%; /* Full width on mobile */
          padding: 10px 15px; /* Adjust padding for a better button look */
          text-align: center; /* Center the button text */
          color: #ffffff; /* Button text color */
          border: none; /* Remove default button border */
          border-radius: 25px; /* Rounded corners */
          margin-top: 10px; /* Adds space between buttons */
          text-decoration: none; /* Remove underline */
          font-weight: bold; /* Optional: Bold text */
        }
        /* Add some hover effect for better UX */
        .fcc-btn:hover {
            background-color: #3b3a52; /* Darker background on hover */
            color: #ffffff; /* Text color on hover */
        }
        .removeLine {
          text-decoration: none;
          color: #000;
        }
        .titulo_historia{
          background-color: black;
          color: white;
          display: flex;
          flex-direction: column;
          justify-content: center;
          align-items: center;
          font-family: "Libre Baskerville", serif;
          font-weight: 700;
          font-style: normal;
          height: 80px;
          margin-bottom: 15px;
        }
        .module {
            background-color: #f6f6f6;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 40px;
            margin-bottom: 20px;
        }
        p {
            font-size: 18px;
            color: #818181;
            line-height: 1.6;
            text-align: justify;
        }
        .option {
            display: block; /* Centers the button */
            background-color: #5728b7;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            text-align: center;
            cursor: pointer;
            width: 130px;
            border-radius: 25px;
            transition: background-color 0.3s;
        }
        .button-container {
            display: flex;
            justify-content: center;
            margin-top: 10px;
        }
        /* Dropdown styles to prevent pushing */
        .navbar-collapse {
            position: absolute;
            top: 50px; /* Adjust to be below the header */
            right: 0; /* Align to the right */
            width: 150px; /* Adjust width as needed */
            background-color: white; /* Background color of the dropdown */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Optional: add shadow for dropdown */
            z-index: 1000; /* Ensure dropdown is on top */
        }
        .whatsapp {
          color: forestgreen;
        }
    </style>
</head>

<body>
  <!--Head-->
  <div class="container-fluid p-0 header-container">
    <!-- Back button -->
    <a href="index3.php" class="back-button"><i class="fas fa-arrow-left"></i></a>
    
    <!-- Title and Subtitle -->
    <h4 class="text-center tituloGaleria mt-5 mb-0">GALERIA FERIA DEL SOL</h4>
    <h6 class="text-center tituloGal">Shopping Place</h6>
    <!-- Menu Button -->
    <button class="navbar-toggler menu-button" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
        aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon">
        <div></div> <!-- This div is for the middle bar -->
    </span>
</button>

    <div class="line-below"></div>
  </div>

  <!-- Navbar to be toggled <a class="nav-link" href="#">Locales</a>-->
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav ms-auto text-center">
          <li class="nav-item">
              <a class="nav-link" href="#">Promociones</a>
          </li>
          <li class="nav-item">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
              data-bs-target="#listadosDropdownMenu">Locales</a>
            <ul class="dropdown-menu text-center" aria-labelledby="navbarDropdown" id="listadosDropdownMenu">
              <li><a class="dropdown-item nav-link" href="pisos.php" data-bs-option="1">Planta Baja</a></li>
              <li><a class="dropdown-item nav-link" href="#" data-bs-option="2">Primer Piso</a></li>
              <li><a class="dropdown-item nav-link" href="#" data-bs-option="3">Segundo Piso</a></li>
              <li><a class="dropdown-item nav-link" href="#" data-bs-option="4">Primer Rampa</a></li>
              <li><a class="dropdown-item nav-link" href="#" data-bs-option="5">Segunda Rampa</a></li>
            </ul>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="loginGaleria.php">Iniciar Sessión</a>
          </li>
      </ul>
  </div>

  <!--Rest of the Body (Carrousel!) -->
  <div class="row justify-content-center carousel-row mt-4">
    <div class="col-12 p-0">
      <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <ol class="carousel-indicators">
          <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
          <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>
          <!--<li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></li>
          <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3"></li>-->
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="imagenes/horarioGaleria.png" class="d-block w-100 carousel-image img-fluid mx-auto" alt="Image 1">
          </div>
          <div class="carousel-item">
            <img src="imagenes/fotoGale2024.png" class="d-block w-100 carousel-image img-fluid mx-auto" alt="Image 2">
          </div>
          <!--<div class="carousel-item">
            <a href="galeriaSol.php">
              <img src="imagenes/GalSol24.png" class="d-block w-100 carousel-image img-fluid mx-auto" style="max-width: 80%;" alt="Image 3">
            </a>
          </div>
          <div class="carousel-item">
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
    <!-- Line below the titles -->
    <div class="line-below mt-4"></div>
  </div>
  <!-- Pisos Galeria -->
  <div class="container-fluid header-container">
    <h4 class="text-center tituloGaleria mt-2">LOCALES EN :</h4>
    <div class="mt-2">
      <div><a href="pisos.php?piso=1" class= "fcc-btn mt-2" style="background-color: #990e0e">PLANTA BAJA</a></div>
      <div><a href="pisos.php?piso=2" class= "fcc-btn mt-2" style="background-color: #1087b3">PRIMER PISO</a></div>
      <div><a href="pisos.php?piso=3" class= "fcc-btn mt-2" style="background-color: #104eb3;">SEGUNDO PISO</a></div>
    </div>
  </div>
  
   <!-- Historia Galeria -->
  <div id="algohistoria" class="module">
    <div class="titulo_historia">
      <h2>Algo de Historia</h2>
    </div>
    <p>Comenzamos en Diciembre de 2005, en uno de los barrios más tradicionales de la Ciudad de Buenos Aires, 
      y en poco tiempo nos convertimos en un centro comercial referente para todo el país.</p>
  
    <p>Somos un lugar de tendencia, inspiración y movimiento; nos reinventamos todo el tiempo para 
        compartir nuevas experiencias con nuestros clientes.</p>
  </div>

  <!-- Contact Section Email at the Bottom 

  <div class="mb-3">
                <label for="file" class="form-label">Upload a File (optional)</label>
                <input type="file" class="form-control" id="file" name="file">
  </div> -->
  <div id="escribenos" class="container mt-5 mb-5">
    <h2 class="text-center">Escribenos</h2>
    
    <form action="#" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="message" class="form-label">Mensaje</label>
            <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
        </div>
        <!-- Centered Button Container -->
        <div class="button-container">
            <button type="submit" class="option">Enviar</button>
        </div>
    </form>
    <br>
    <?php
        if (isset($_SESSION['message'])) {
            echo "<p>" . $_SESSION['message'] . "</p>";
            unset($_SESSION['message']);  // Clear the message after displaying it
        }
    ?>
  </div>

  <?php include 'footerGaleria.php'; ?>

  <script src="https://kit.fontawesome.com/2dc0c09347.js" crossorigin="anonymous"></script>
  <!-- JavaScript Bundle -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script>
    // Use jQuery in noConflict mode
    var $ = jQuery.noConflict();
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  
</body>
</html>