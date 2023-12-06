<?php
include "conexion.php";
include "calculos.php";

if(isset($_GET['registrar'])) {
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

    move_uploaded_file($imagen_temporal, "emakickPhp/emakick2/imagenes/".$imagen);

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

    header("location:galeria.php?option=".$option);
    die();
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
</head>
<body>
<!-- FORMULARIO DE ALTA DE REGISTRO -->
<!-- FORMULARIO DE ALTA DE REGISTRO -->
<div style="background-color: #f2f0f7; padding: 20px;">
    <form action="registrar.php?option=<?php echo $_GET['option']; ?>" method="post" enctype="multipart/form-data">
        <label for="cod_art">Codigo del Articulo:</label>
        <input required type="text" name="cod_art" id="cod_art">

        <label for="id_prov">Fabricante:</label>
        <select required name="id_prov" id="id_prov">
            <option value="0">-Seleccione Proveedor-</option>
            <?php
            $sql2 = "SELECT * FROM fabricants";
            $fabrics = $conexion->consultar($sql2);
            foreach($fabrics as $f) { ?>
                <option value="<?php echo $f['id'] ?>">
                    <?php echo $f['nombre'] ?>
                </option>
            <?php } ?>
        </select>

        <label for="descripcion">Descripción:</label>
        <input required name="descripcion" id="descripcion">

        <label for="costo">Precio fabrica:</label>
        <input required type="number" name="costo" id="costo">

        <label for="fecha_alta">Fecha de Alta:</label>
        <input required type="date" name="fecha_alta" id="fecha_alta">

        <label for="imagen">Imagen:</label>
        <input required type="file" name="imagen" id="imagen">

        <input class="btn btn-warning" type="submit" value="Grabar Registro" onclick="processForm(event)">
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>

<script>
    function processForm(e) {
            var respuest = confirm("Desea GRABAR el Registro ...?");
            if (respuest == false) {
                e.preventDefault();
            } else {
                alert('ALTA Exitosa !!!');
            }
        }
</script>

</body>
</html>
