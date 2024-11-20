<?php
session_start();
include "conexion.php";
$conexion = new conexion();

// Check if the 'piso' parameter is passed in the URL
$nroPiso = isset($_GET['piso']) ? intval($_GET['piso']) : null;
$levelName = ""; // Initialize variable to hold the level name

// Prepare the SQL query based on the 'nroPiso' value
if ($nroPiso) {
    // Only select records for the chosen 'nroPiso'
    $sql = "SELECT locales.*, niveles.nivel 
            FROM locales 
            LEFT JOIN niveles ON locales.nroPiso = niveles.id 
            WHERE locales.nroPiso = " . $nroPiso;

    // Fetch the records using the 'consultar' method
    $result = $conexion->consultar($sql);

    // If records are found, set the level name
    if (count($result) > 0) {
        $levelName = $result[0]['nivel']; // Get the level name from the first record
    }

} else {
    // If no 'nroPiso' is selected, display all records
    $sql = "SELECT locales.*, niveles.nivel 
            FROM locales 
            LEFT JOIN niveles ON locales.nroPiso = niveles.id";
    $result = $conexion->consultar($sql);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pisos Galeria Feria del Sol</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<style>
    .card {
        margin: 0 auto; /* Center the card */
    }
    a {
        text-decoration: none;
    }
    .whatsapp {
          color: forestgreen;
    }
    .back-button {
            position: absolute;
            left: 10px; /* Position to the left side */
            top: 10px;
            color: black; /* Adjust the color if needed */
    }
    .tituloGaleria {
          font-family: "Libre Baskerville", serif;
          color: #5728b7;
          font-weight: 700;
          font-style: normal;
    }
</style>

<body>

    <a href="galeriaSol.php" class="back-button"><i class="fas fa-arrow-left"></i></a>

    <h4 class="text-center mt-4 mb-4 tituloGaleria">Locales en <?php echo htmlspecialchars($levelName); ?></h4>
    
    <div class="container">
        <div class="row justify-content-center">
            <?php
            if (count($result) > 0) {  // Check if there are any results
                foreach ($result as $row) {
                    ?>
                    <div class="col-6 mb-4"> <!-- 2 cards per row for mobile -->
                        <div class="card">
                            <img src="imagenes/<?php echo $row['imagen']; ?>" class="card-img-top" alt="<?php echo htmlspecialchars($row['razonSocial']); ?>">
                            <div class="card-body text-center">
                                <h5 class="card-title"><?php echo htmlspecialchars($row['razonSocial']); ?></h5>
                                <!--<p class="card-text">Propietario: <?php echo htmlspecialchars($row['propietario']); ?></p> -->
                                <p class="card-text"><?php echo htmlspecialchars($row['rubro']); ?></p>

                                <a class="facebook me-4" href="<?php echo htmlspecialchars($row['redSocial']); ?>" target="_blank">
                                    <i class="fab fa-facebook fa-2x"></i>
                                </a>
                                
                                <a class="whatsapp" href="https://wa.me/<?php echo htmlspecialchars($row['celular']); ?>" target="_blank">
                                    <i class="fab fa-whatsapp fa-2x"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<p>No records found</p>";
            }
            ?>
        </div>
    </div>
    
    <!--<div class="row justify-content-center">  Center the row content 
            Card for Local 1 
            <div class="col-6 mb-4"> 
                <div class="card"> 
                    <img src="imagenes/localEX24.png" class="card-img-top" alt="Gondola 1">
                    <div class="card-body mt-2 mb-3 text-center">
                        <h5 class="card-title">Gondola 1</h5>
                        <p class="card-text">Rubro: Lenceria</p>
                        <a class="facebook me-4" href="https://facebook.com/jane.fernandezdaga" target="_blank">
                            <i class="fab fa-facebook fa-2x"></i>
                        </a>
                        <a class="whatsapp" href="https://wa.me/5491150511072" target="_blank">
                            <i class="fab fa-whatsapp fa-2x"></i>
                        </a>
                    </div>
                </div>
            </div>
             Card for Local 2
            <div class="col-6 mb-4">
                <div class="card"> 
                    <img src="imagenes/local2.png" class="card-img-top" alt="Local 2">
                    <div class="card-body text-center">
                        <h5 class="card-title">Gondola 2</h5>
                        <p class="card-text">Rubro: Venta Ropa Mujer & Unisex</p>
                        <a class="facebook me-4" href="https://facebook.com/oaduviri" target="_blank">
                            <i class="fab fa-facebook fa-2x"></i>
                        </a>
                        <a class="whatsapp" href="https://wa.me/5491150511072" target="_blank">
                            <i class="fab fa-whatsapp fa-2x"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    -->

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