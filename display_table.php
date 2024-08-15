<?php
session_start();

// Obtener la tabla HTML de la variable de sesión
$tablaHTML = $_SESSION['tablaHTML'];

// Mostrar la tabla en la nueva pantalla
echo $tablaHTML;
?>

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