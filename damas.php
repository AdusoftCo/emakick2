<?php
session_start();
include 'conexion.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Damas</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
</head>
<body>
    <div class="col-12 mobile-mt text-pink">
        <a href="index3.php" class="back-link"><i class="fas fa-arrow-left"></i></a>
        <div class="text-center">
            <h2>SECCION MUJER</h2>
        </div>
    </div>

    <?php
    $conexion = new conexion();

    $sql = "SELECT id, descripcion, precio_oferta, imagen FROM camisonetas WHERE descripcion LIKE '%Camison%'";

    $imagesWithDescriptions = $conexion->consultar($sql);

    if ($imagesWithDescriptions === false) {
        die("Error executing SQL query: " . $conexion->getMessage());
    };


    foreach ($imagesWithDescriptions as $image) {
        ?>
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="imagenes/<?php echo $image['imagen']; ?>" class="card-img-top" alt="Imagen camison">
                <div class="card-body">
                    <h5 class="font-weight-bolder">
                        <?php echo $image['descripcion']; ?>
                    </h5>
                    <p class="card-text fs-5">
                        Precio Oferta: $ <?php echo $image['precio_oferta']; ?>
                    </p>
                </div>
            </div>
        </div>
        <?php
    }
    ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>