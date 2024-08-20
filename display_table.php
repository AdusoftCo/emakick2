<?php
session_start();

// Obtener la tabla HTML de la variable de sesión
$tablaHTML = $_SESSION['tablaHTML'];

// Mostrar la tabla en la nueva pantalla
echo $tablaHTML;
?>
<!--
    
<div class="container mt-4">
    <div class="row">
    <?php foreach ($offers as $offer) : ?>
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="imagenes/<?php echo $offer['imagen']; ?>" class="card-img-top" alt="<?php echo $offer['descripcion']; ?>">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $offer['descripcion']; ?></h5>
                    <p class="card-text">Price: <?php echo $offer['precio_oferta']; ?></p>
                    <a href="details.php?id=<?php echo $offer['id']; ?>" class="btn btn-primary">Ver Detalles</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

// Check if record exists in 'stocking' table
    //$sqlCheckStocking = "SELECT * FROM stocking WHERE `product_id` = '$id'";
    //$existStockingRec = $conexion->consultar($sqlCheckStocking);

    /*if (empty($existStockingRec)) {
        // Debugging: Output SQL statement for inspection
        echo "Inserting new record into stocking table   .<br>";
        // Insert new record into 'stocking' table
        $sqlInsertStocking = "INSERT INTO stocking (`id`, `categoria`, `product_id`, `cant_doce`)
                             VALUES (NULL, '$opcion', '$id', '$cantidad_docenas')";
        $conexion->ejecutar($sqlInsertStocking);
    } else {
        // Update 'stocking' table
        $sqlStocking = "UPDATE stocking SET `cant_doce` = '$cantidad_docenas' WHERE `product_id` = '$id'";
        $conexion->ejecutar($sqlStocking);
    }*/

-->