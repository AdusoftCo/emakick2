<?php session_start();
include "conexion.php";
include "calculos.php";

$conexion = new conexion();
$opcion = $_GET['option'];
$texto = strtoupper($opcion);

if(isset($_GET['registrar'])) {
    if ($_POST) {
    #levantamos los datos del formulario
    #$id = $_SESSION['id'];
    $cod_art = $_POST['cod_art'];
    $id_prov = $_POST['id_prov'];
    $descripcion = $_POST['descripcion'];
    $costo = $_POST['costo'];
    $fecha_alta = $_POST['fecha_alta'];

    #Nombre de la imagen
    $imagen = $_FILES['imagen']['name'];

    #tenemos que guardar la imagen en una carpeta 
    $imagen_temporal = $_FILES['imagen']['tmp_name'];

    #creamos una variable fecha para concatenar al nombre de la imagen, para que cada imagen sea distinta y no se pisen 
    #$fecha = new DateTime();

    #$imagen= $fecha->getTimestamp() . "_" . $imagen;

    move_uploaded_file($imagen_temporal, "imagenes/" . $imagen);

    /*$uploadDirectory = "emakickPhp/emakick2/imagenes/";
    $uploadedFile = $_FILES['imagen']['tmp_name'];
    $targetFile = $uploadDirectory . basename($_FILES['imagen']['name']);

    echo "Uploaded File: " . $uploadedFile . "<br>";
    echo "Target File: " . $targetFile . "<br>";
    echo "Imagen: " . $imagen . "<br>";

    if (move_uploaded_file($_FILES['imagen']['tmp_name'], $targetFile)) {
        $imagen = $targetFile;
    }else{
        echo "Error en Carga de Imagen";
    }*/

    # Calculo del COSTO Y OBTENCION DE NUEVOS PRECIOS
    $result = calculos($id_prov, $costo);
    $docena = $result[0];
    $oferta = $result[1];

    $sql = "INSERT INTO $opcion (`id`, `cod_art`, `id_prov`, `descripcion`, `costo`, `precio_doc`, `precio_oferta`, `fecha_alta`, `imagen`) 
                VALUES (NULL, '$cod_art', '$id_prov', '$descripcion', '$costo', '$docena', '$oferta', '$fecha_alta', '$imagen')";

    #creo una instancia(objeto) de la clase de conexion
    $id_proyecto = $conexion->ejecutar($sql);

    if ($id_proyecto === false) {
        // Display an error message or handle the error appropriately
        echo "Error executing SQL query: " . $e->getMessage();
        die();
    } else {
        // Redirect the user to galeria.php
        header("Location: galeria.php?option=" . $opcion );
        exit();
    }
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
</head>

<body>
    <div class="fixed-section">
        <div class="d-flex align-items-center justify-content-between">
            <a href="galeria.php?option=<?php echo $_GET['option']; ?>" class="back-link3"><i class="fas fa-arrow-left"></i></a>
        </div>
        
        <div class="row d-flex justify-content-center">
            <div class="col-md-8 col-sm-10">
                <h2><b><i>SECCION
                    <?php echo $texto; ?>
                </i></b></h2>
            </div>
        </div>
    </div>

<!-- FORMULARIO DE ALTA DE REGISTRO -->
<div class="container mt-2">
    <form method="post" enctype="multipart/form-data" action="registrar.php?option=<?php echo $_GET['option']; ?>&registrar=true">
        <div class="mb-3">
            <label for="cod_art" class="form-label">Codigo Artículo:</label>
            <input required class="form-control" type="text" name="cod_art" id="cod_art">
        </div>

        <div class="mb-3">
            <label for="id_prov" class="form-label">Fabricante:</label>
            <select required class="form-control" name="id_prov" id="id_prov">
                <option value="0">-Seleccione Proveedor-</option>
                <?php
                $conexion = new conexion();
                $sql2 = "SELECT * FROM fabricants";
                $fabrics = $conexion->consultar($sql2);
                    foreach ($fabrics as $f) { ?>
                        <option value="<?php echo $f['id'] ?>"><?php echo $f['nombre'] ?></option>
                    <?php } ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción:</label>
            <input required class="form-control" type="text" name="descripcion" id="descripcion">
        </div>

        <div class="mb-3">
            <label for="costo" class="form-label">Precio fabrica:</label>
            <input required class="form-control" type="number" name="costo" id="costo">
        </div>

        <div class="mb-3">
            <label for="fecha_alta" class="form-label">Fecha de Alta:</label>
            <input required class="form-control" type="date" name="fecha_alta" id="fecha_alta">
        </div>

        <div class="mb-5">
            <label for="imagen" class="form-label">Imagen:</label>
            <input class="form-control" type="file" name="imagen" id="imagen">
        </div>

        <div class="mb-3">
            <input class="btn btn-warning" type="submit" value="Grabar Artículo" onclick="processForm(event)">
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function processForm(e) {
            var respuest = confirm("Desea GRABAR el Registro ...?");
            if (respuest == false) {
                e.preventDefault();
            } else {
                console.log('ALTA Exitosa !!!');
            }
        }
</script>

</body>
</html>
