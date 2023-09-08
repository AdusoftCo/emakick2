<?php include 'conexion.php'; ?>
<?php
if (isset($_GET['opcion'])) {
    $opcion = $_GET['opcion'];
    
    $conexion = new conexion();

    $sql = "SELECT $opcion.`cod_art`, $opcion.`id_prov`, $opcion.`descripcion`, $opcion.`precio_doc`, 
         `fabricants`.`nombre` FROM $opcion INNER JOIN `fabricants` ON $opcion.`id_prov`=`fabricants`.`id`";

    // Ejecuta la consulta
    $resultado = $conexion->consultar($sql);

    // Verifica si hay resultados
    if (!empty($resultado)) {
        echo '<div class="row row-cols-1 row-cols-md-2 g-4">';
        foreach ($resultado as $fila) {
            echo '<div class="col">';
            echo    '<div class="card border border-3 shadow">';
            echo        '<div class="card-body">';
                        echo '<p class="card-text" style="color: var(--bs-primary);">' . 'Articulo :  ' . $fila['cod_art'] . '</p>';
                        echo '<p class="card-text" style="color: var(--bs-primary);">' . 'Fabricante : ' . $fila['nombre'] . '</p>'; // Adjust based on your database columns
                        echo '<p class="card-text" style="color: var(--bs-primary);">' . $fila['descripcion'] . '</p>';
                        echo '<p class="card-text" style="color: var(--bs-primary);">' . 'Precio Docena :  $ '. $fila['precio_doc'] . '</p>';
            // Add more card content as needed
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        }
        echo '</div>';

    } else {
        echo 'No se proporcionó ninguna opción.';
    }
}
?>

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
        :root {
            --bs-primary: #5728b7;
            }
    </style>