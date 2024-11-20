<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include "conexion.php";
$conexion = new conexion();

// Check if 'piso' is passed via URL and store it in a session or a variable
if (isset($_GET['piso'])) {
    $nroPiso = intval($_GET['piso']);
    $_SESSION['nroPiso'] = $nroPiso;  // store it in session if needed
} else {
    $nroPiso = $_SESSION['nroPiso'] ?? null;  // fallback to session if not in URL
}

if ($_GET) {
    if (isset($_GET['modificar'])) {

        $id = $_GET['modificar'];

        $_SESSION['id_proyecto'] = $id;
        #vamos a consultar para llenar la tabla 
        $conexion = new conexion();

        $proyecto = $conexion->consultar("SELECT * FROM `locales` WHERE id=" . $id);
    }
}

if ($_POST) {

    $id = $_SESSION['id_proyecto'];

    #levantamos los datos del formulario
    #$nroPiso = $_POST['nroPiso'];
    #$tipoLocal = $_POST['tipoLocal'];
    $numLocal = $_POST['numLocal'];
    $razonSocial = $_POST['razonSocial'];
    #$rubro = $_POST['rubro'];
    $propietario = $_POST['propietario'];
    $celular = $_POST['celular'];
    $redSocial = $_POST['redSocial'];

    $imagen_actual = $conexion->consultar("SELECT imagen FROM `locales` WHERE id=" . $id);

    # Nombre de la imagen
    if (!empty($_FILES['imagen']['name'])) {
        # la borramos de la carpeta
        unlink("imagenes/" . $imagen_actual[0]['imagen']);

        # nombre de la nueva imagen
        $imagen_nueva = $_FILES['imagen']['name'];
        # tenemos que guardar la nueva imagen en una carpeta
        $imagen_temporal = $_FILES['imagen']['tmp_name'];
        # creamos una variable fecha para concatenar al nombre de la imagen, para que cada imagen sea distinta y no se pisen
        $fecha = time();
        $imagen_nueva = $fecha . "_" . $imagen_nueva;

        if ($_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
            // Check if the file was successfully uploaded
            if (move_uploaded_file($imagen_temporal, "imagenes/" . $imagen_nueva)) {
                echo "File uploaded successfully.";
            } else {
                echo "Error moving the uploaded file.";
            }
        } else {
            echo "Error during file upload. Error code: " . $_FILES['imagen']['error'];
        }
    } else {
        // If no new image is uploaded, keep the current image name
        $imagen_nueva = $imagen_actual[0]['imagen'];
    }

    $fecActualzda = $_POST['fecActualzda'];

    $conexion = new conexion();

    # Construimos la consulta SQL
    $sql = "UPDATE `locales` SET `numLocal`= '$numLocal', `razonSocial`= '$razonSocial', `propietario` = '$propietario', `celular` = '$celular', `redSocial` = '$redSocial', 
            `imagen` = '$imagen_nueva', `fecActualzda` = '$fecActualzda' WHERE `id` = '$id';";

    $id_proyecto = $conexion->ejecutar($sql);

    if ($id_proyecto === false) {
        // Display an error message or handle the error appropriately
        echo "Error executing SQL query: " . $conexion->error;
        die();
    } else {
        // Redirect the user to galeria.php
        header("Location: abmFeriaSol.php?piso=" . $nroPiso);
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificacion</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        .back-button {
            position: absolute;
            left: 10px; /* Position to the left side */
            top: 10px;
            color: black; /* Adjust the color if needed */
        }
        .tituloGaleria {
          color: #5728b7;
          font-weight: 700;
          font-style: normal;
        }
        .btn {
            border-radius: 25px;
        }
        .btnModif {
            background: #3498db;
            color: white;
        }
        .btnDanger {
            background: #e31212;
            color: white;
        }
    </style>
</head>
<body>
    
<?php #leemos proyectos 1 por 1
foreach ($proyecto as $fila) { ?>
<div class="container mt-3">
    <div class="row justify-content-center mt-4 mb-5">
    
        <a href="abmFeriaSol.php?piso=<?php echo $nroPiso; ?>" class="back-button"><i class="fas fa-arrow-left"></i></a>    
    
        <div class="col-md-8 col-sm-10">
        
            <div class="mt-2">
                <div class="text-center tituloGaleria">
                    <h3><b>Datos de la Unidad a MODIFICAR</b></h3>
                </div>

                <div class="card-body">
                    <!--para recepcionar archivos uso enctype <option value="<?php echo $n['id'] ?>"><?php echo $n['nivel'] ?></option>-->
                    <form method="post" enctype="multipart/form-data">
                        
                    <input type="hidden" name="nroPiso" value="<?php echo $nroPiso; ?>">
                        <div class="mb-3">
                            <label for="numLocal" class="form-label">Numero :</label>
                            <input required class="form-control" type="number" name="numLocal" id="numLocal"
                            value="<?php echo $fila['numLocal']; ?>">
                        </div>

                        <div class="mb-3">
                            <label for="razonSocial" class="form-label">Razon Social:</label>
                            <input required class="form-control" type="text" name="razonSocial" id="razonSocial"
                            value="<?php echo $fila['razonSocial']; ?>">
                        </div>

                        <div class="mb-3">
                            <label for="propietario" class="form-label">Propietario:</label>
                            <input required class="form-control" type="text" name="propietario" id="propietario"
                            value="<?php echo $fila['propietario']; ?>">
                        </div>

                        <div class="mb-3">
                            <label for="celular" class="form-label">Celular:</label>
                            <input required class="form-control" type="number" name="celular" id="celular"
                            value="<?php echo $fila['celular']; ?>">
                        </div>

                        <div class="mb-3">
                            <label for="redSocial" class="form-label">Red Social:</label>
                            <input required class="form-control" type="text" name="redSocial" id="redSocial"
                            value="<?php echo $fila['redSocial']; ?>">
                        </div>

                        <div class="mb-3">
                            <label for="imagen" class="form-label">Imagen:</label>
                            <input class="form-control" type="file" name="imagen" id="imagen">
                            <small class="text-muted">Archivo Actual : <?php echo $fila['imagen']; ?></small>
                        </div>

                        <div class="mb-4">
                            <label for="fecActualzda" class="form-label">Actualizacion:</label>
                            <input required class="form-control" type="date" name="fecActualzda" id="fecActualzda"
                                value="<?php echo $fila['fecActualzda']; ?>">
                        </div>
                                                
                        <div>
                            <br>
                            <input class="btn btnModif btn-md" type="submit" value="Modificar Registro"
                                onclick="return processForm(event);">
                            <input class="btn btnDanger btn-md mx-2" type="button" name="Cancelar" value="Cancelar"
                                onClick="location.href='abmFeriaSol.php?piso=<?php echo $nroPiso; ?>'">
                        </div>
                    </form>
                </div>
                <!--cierra el body-->
            </div>
            <!--cierra el card-->
            </div>
            <!--cierra el col-->
        </div>
        <!--cierra el row-->
    </div>
</div>
<?php } ?>

<script type="text/javascript">
    function processForm(e) {
        var respuest = confirm("¿Desea realmente MODIFICAR el Registro...?");
        if (respuest == false) {
            e.preventDefault();
        } else {
            alert('Ya lo MODIFICASTE!');
        }
    }
</script>
<!-- <div class="mb-3">
    `nroPiso` = '$nroPiso', `tipoLocal` = '$tipoLocal', `numLocal` = '$numLocal',
                            <label for="nroPiso" class="form-label">Nivel/Piso:</label>
                            <select required class="form-control" id="nroPiso" name="nroPiso">
                            <?php
                                $sql2 = "SELECT * FROM niveles";
                                $nivels = $conexion->consultar($sql2);
                                
                                foreach ($nivels as $n) {
                                    if ($n['id'] == $fila['nroPiso']) {
                                        echo "<option value=\"{$n['id']}\" selected>{$n['nivel']}</option>";
                                    } else {
                                        echo "<option value=\"{$n['id']}\">{$n['nivel']}</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="tipoLocal" class="form-label">Tipo Local:</label>
                            <input required class="form-control" type="text" name="tipoLocal" id="tipoLocal"
                            value="<?php echo $fila['tipoLocal']; ?>">
                        </div>

                        <div class="mb-3">
                            <label for="numLocal" class="form-label">Numero:</label>
                            <input required class="form-control" type="number" name="numLocal" id="numLocal"
                            value="<?php echo $fila['numLocal']; ?>">
                        </div>-->
</body>
</html>
