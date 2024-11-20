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
    <title>Seleccion Pisos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
    <style>
        .back-button {
            position: absolute;
            left: 10px; /* Position to the left side */
            top: 10px;
            color: black; /* Adjust the color if needed */
            
        }
        .container {
            min-height: 25vh; !important
        }
        .option {
            display: block;
            background-color: #5728b7;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            text-align: center;
            cursor: pointer;
            width: 250px;
            border-radius: 25px;
            transition: background-color 0.3s;
        }

    </style>
</head>

<body>
    <div class="container">

        <a href="galeriaSol.php" class="back-button"><i class="fas fa-arrow-left"></i></a>

        <div>
            <div class="container text-center">
                <h1 class="display-5">Administrador</h1>
                <p class="lead">Niveles Disponibles</p>
                <hr class="my-0">
            </div>
            <div>
                <!-- List of options -->
                <ul class="options-list ps-0">
                    <li><a class="nav-link option" href="abmFeriaSol.php?piso=1">PLANTA BAJA</a></li>
                    <li><a class="nav-link option" href="abmFeriaSol.php?piso=2">PRIMER PISO</a></li>
                    <li><a class="nav-link option" href="abmFeriaSol.php?piso=3">SEGUNDO PISO</a></li>
                    <li><a class="nav-link option" href="abmFeriaSol.php?piso=4">PRIMER RAMPA</a></li>
                    <li><a class="nav-link option" href="abmFeriaSol.php?piso=5">SEGUNDA RAMPA</a></li>
                </ul>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  
</body>
</html>
