<!-- ofertas.php -->
<?php
include 'conexion.php';

$conexion = new conexion();

$offers = [];

// Example of fetching records from four different tables
$table1_offers = $conexion->consultar("SELECT id, descripcion, precio_oferta, imagen FROM femeninterior WHERE descripcion LIKE '%Culote Dama Vedetina Alg.L Cint.Puntilla%'");
$table2_offers = $conexion->consultar("SELECT id, descripcion, precio_oferta, imagen FROM femeninterior WHERE descripcion LIKE '%Bombacha Universal Dama Alg.Lycra Lisa%'");
$table3_offers = $conexion->consultar("SELECT id, descripcion, precio_oferta, imagen FROM masculinos WHERE descripcion LIKE '%BOXER HOMBRE SIN COSTURA LISO-S al XL%'");
$table4_offers = $conexion->consultar("SELECT id, descripcion, precio_oferta, imagen FROM medias WHERE descripcion LIKE '%Soquete Dama Soft c.Lengueta Toalla planta%'");

// Combine all the results into a single array
$offers = array_merge($table1_offers, $table2_offers, $table3_offers, $table4_offers);

?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeria</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
</head>
<body>
    
<div class="fixed-section">
        <div class="d-flex align-items-center justify-content-between">
            <a href="index3.php" class="back-link"><i class="fas fa-arrow-left"></i></a>
            <!--Formulario Searching -->
            <div id="search-box" class="mt-3">
                <form id="search-form" method="get" action="galeria.php" class="d-flex">
                    <input type="text" id="searchQuery2" name="searchQuery2" placeholder="Buscar registros ..."
                        class="form-control p-1">
                    <button type="submit" class="search-icon"><i class="fas fa-search"></i></button>
                </form>
            </div>
        </div>
        
        <div class="row d-flex justify-content-center mb-0">
            <div class="col-md-8 col-sm-10 mt-5">
                <h2><b><i>OFERTAS DEL MES </i></b></h2>
            </div>
        </div>
</div>

<!-- Aki las Cards -->
<div class="container">
    <div class="row">
        <?php foreach ($offers as $fila) { ?>
            <div class="col-6 mb-4"> <!-- Use col-6 for two cards per row on mobile -->
                <div class="card">
                    <img src="imagenes/<?php echo $fila['imagen']; ?>" class="card-img-top" alt="<?php echo $fila['descripcion']; ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $fila['descripcion']; ?></h5>
                             <p class="card-text">Precio: <?php echo $fila['precio_oferta']; ?> $</p>
                        <a href="detalle.php?id=<?php echo $fila['id']; ?>" class="btn btn-primary">Ver detalles</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

</body>