<?php
session_start();
include "conexion.php";
$conexion = new conexion();

if ($_POST) {
    #levantamos los datos del formulario
    #$id = $_SESSION['id'];
    $nroPiso = $_POST['nroPiso'];
    $tipoLocal = $_POST['tipoLocal'];
    $numLocal = $_POST['numLocal'];
    $razonSocial = $_POST['razonSocial'];
    $propietario = $_POST['propietario'];
    $celular = $_POST['celular'];
    $redSocial = $_POST['redSocial'];

    #Nombre de la imagen
    $imagen = $_FILES['imagen']['name'];

    #tenemos que guardar la imagen en una carpeta 
    $imagen_temporal = $_FILES['imagen']['tmp_name'];

    move_uploaded_file($imagen_temporal, "imagenes/" . $imagen);

    $fechaAlta = $_POST['fechaAlta'];

    $sql = "INSERT INTO locales (`id`, `nroPiso`, `tipoLocal`, `numLocal`, `razonSocial`, `propietario`, `celular`, `redSocial`, `imagen`, `fechaAlta`) 
                VALUES (NULL, '$nroPiso', '$tipoLocal', '$numLocal', '$razonSocial', '$propietario', '$celular', '$redSocial', '$imagen', '$fechaAlta')";

    #creo una instancia(objeto) de la clase de conexion
    $id_proyecto = $conexion->ejecutar($sql);

    if ($id_proyecto === false) {
        // Display an error message or handle the error appropriately
        echo "Error executing SQL query: " . $e->getMessage();
        die();
    } else {
        // Redirect the user to galeria.php
        header("Location: altaGaleria.php");
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta Galeria Feria Sol</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        .back-button {
            position: absolute;
            left: 10px; /* Position to the left side */
            top: 10px;
            color: black; /* Adjust the color if needed */
        }
        .fixed-section {
            position: static;
            margin-top: 40px;
            width: 100%;
            background-color:#f8f9fa;
        }
        .tituloGaleria {
          font-family: "Libre Baskerville", serif;
          color: #5728b7;
          font-weight: 700;
          font-style: normal;
        }
        .btn {
            border-radius: 25px;
            background: #3498db;
            color: white;
        }
    </style>
</head>
<body>
    <!-- Cabezera Alta-->
    <div class="fixed-section">
        <div class="d-flex align-items-center justify-content-between">
            <a href="loginAdmin.php" class="back-button"><i class="fas fa-arrow-left"></i></a>
        </div>
        
        <div class="row d-flex justify-content-center">
            <div class="col-md-8 col-sm-10 mt-2 mb-2 text-center">
                <h2 class="tituloGaleria"><b>ALTA NUEVA UNIDAD</b></h2>
            </div>
        </div>
    </div>

    <!-- FORMULARIO DE ALTA DE REGISTRO -->
    <div class="container mt-2">
        <form method="post" enctype="multipart/form-data" action="#">
            
            <div class="mb-3">
                <label for="nroPiso" class="form-label">Nivel/Piso:</label>
                <select required class="form-control" name="nroPiso" id="nroPiso">
                    <option value="0">-Seleccione Nivel-</option>
                    <?php
                    $conexion = new conexion();
                    $sql2 = "SELECT * FROM niveles";
                    $nivels = $conexion->consultar($sql2);
                        foreach ($nivels as $n) { ?>
                            <option value="<?php echo $n['id'] ?>"><?php echo $n['nivel'] ?></option>
                        <?php } ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="tipoLocal" class="form-label">Tipo Local:</label>
                <input required class="form-control" type="text" name="tipoLocal" id="tipoLocal">
            </div>

            <div class="mb-3">
                <label for="numLocal" class="form-label">Numero Local:</label>
                <input required class="form-control" type="number" name="numLocal" id="numLocal">
            </div>

            <div class="mb-3">
                <label for="razonSocial" class="form-label">Razon Social:</label>
                <input required class="form-control" type="text" name="razonSocial" id="razonSocial">
            </div>

            <div class="mb-3">
                <label for="propietario" class="form-label">Propietario:</label>
                <input required class="form-control" type="text" name="propietario" id="propietario">
            </div>

            <div class="mb-3">
                <label for="celular" class="form-label">Celular:</label>
                <input required class="form-control" type="number" name="celular" id="celular">
            </div>

            <div class="mb-3">
                <label for="redSocial" class="form-label">Red Social:</label>
                <input required class="form-control" type="text" name="redSocial" id="redSocial">
            </div>

            <div class="mb-3">
                <label for="fechaAlta" class="form-label">Fecha de Alta:</label>
                <input required class="form-control" type="date" name="fechaAlta" id="fechaAlta">
            </div>
            
            <div class="mb-5">
                <label for="imagen" class="form-label">Imagen:</label>
                <input class="form-control" type="file" name="imagen" id="imagen">
            </div>

            <div class="mb-3">
                <input class="btn" type="submit" value="Grabar Nuevo Registro" onclick="processForm(event)">
            </div>
        </form>
    </div>

    <script src="js/scripts.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>