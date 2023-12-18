<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- ... Your meta tags and links ... -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio C.R.U.D.</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
    crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
</head>

<body>
    <div class="container">

        <a href="index3.php" class="back-link"><i class="fas fa-arrow-left"></i></a>

        <div>
            <div class="container text-center">
                <h1 class="display-5">Administrador</h1>
                <p class="lead">Secciones Disponibles</p>
                <hr class="my-0">
            </div>
            <div>
                <!-- List of options -->
                <ul class="options-list ps-0">
                    <li><a class="nav-link option" href="galeria.php?option=damas">DAMAS</a></li>
                    <li><a class="nav-link option" href="galeria.php?option=masculinos">HOMBRES & CHICOS</a></li>
                    <li><a class="nav-link option" href="galeria.php?option=medias">MEDIAS</a></li>
                    <li><a class="nav-link option" href="galeria.php?option=cami_son_setas">CAMISON & CAMISETAS</a></li>
                </ul>
            </div>
        </div>
    </div>

    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
          integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
          crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
          integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
          crossorigin="anonymous"></script>
  
</body>
</html>
