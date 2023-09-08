<?php session_start();
include 'conexion.php';
include 'calculos.php';

$conexion = new conexion();

if ($_GET && isset($_GET['modificar'])) {
    $id = $_GET['modificar'];
    $_SESSION['id_proyecto'] = $id;
    $opcion = $_GET['option'];
    
    $_GET['option'] = $_SESSION['option'];
    //echo "Session Option: " . $_SESSION['option'] . "<br>";

    $proyecto = $conexion->consultar("SELECT * FROM $opcion WHERE id=" . $id);
    }

    if($_POST) {
        $id = $_SESSION['id_proyecto'];
        #debemos recuperar la imagen actual y borrarla del servidor para lugar pisar con la nueva imagen en el server y en la base de datos
        #recuperamos la imagen de la base antes de borrar 
        #$imagen = $conexion->consultar("select imagen FROM `proyectos` where id=".$id);
        #la borramos de la carpeta 
        #unlink("imagenes/".$imagen[0]['imagen']);
        
        #levantamos los datos del formulario
        $cod_art = $_POST['cod_art'];
        $id_prov = $_POST['id_prov'];
        // Debug code
        #echo "Selected id_prov: " . $id_prov . "<br>";

        // Check if the id_prov exists in the fabricants table
        #$sql = "SELECT COUNT(*) AS count FROM fabricants WHERE id = $id_prov";
        #$result = $conexion->consultar($sql);
        #$count = $result[0]['count'];
        #echo "Matching rows in fabricants: " . $count . "<br>";

        $descripcion = $_POST['descripcion'];
        $costo = $_POST['costo'];
        #$docena = $_POST['precio_doc'];
        #$oferta = $_POST['precio_oferta'];
        $fecha_alta = $_POST['fecha_alta'];
        
        #nombre de la imagen
        #$imagen = $_FILES['archivo']['name'];
        #tenemos que guardar la imagen en una carpeta 
        #$imagen_temporal=$_FILES['archivo']['tmp_name'];
        #creamos una variable fecha para concatenar al nombre de la imagen, para que cada imagen sea distinta y no se pisen 
        #$fecha = new DateTime();
        #$imagen= $fecha->getTimestamp()."_".$imagen;
        #move_uploaded_file($imagen_temporal,"imagenes/".$imagen);

        # Calculo del COSTO Y OBTENCION DE NUEVOS PRECIOS
        
        $result = calculos($id_prov, $costo);
        $docena = $result[0];
        $oferta = $result[1];

        $sql = "UPDATE $opcion SET `cod_art` = '$cod_art' , `id_prov` = '$id_prov' , 
                `descripcion` = '$descripcion' ,`costo`= '$costo', `precio_doc` = '$docena' , 
                `precio_oferta` = '$oferta' , `fecha_alta` = '$fecha_alta' 
                WHERE $opcion.`id` = '$id';";
        
        $id_proyecto = $conexion->ejecutar($sql);

    if ($id_proyecto === false) {
        // Display an error message or handle the error appropriately
        echo "Error executing SQL query: " . $e->getMessage();
        die();
    } else {
        // Redirect the user to galeria.php
        header("Location: galeria.php?option=" . $_SESSION['option']);
        exit();
    }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeria</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
    
</head>     
<?php #leemos proyectos 1 por 1
$texto = $_SESSION['option'];

foreach($proyecto as $fila){ ?>
    <a href="galeria.php?option=<?php echo $_SESSION['option']; ?>" class="back-link"><i class="fas fa-arrow-left"></i></a>
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-8 col-sm-10">
                <div class="text-center mt-5 mb-5">
                    <h2><b><i>SECCION <?php echo strtoupper($texto); ?></i></b></h2>
                    <h2><i><b>Datos del Articulo a MODIFICAR</b></i></h2>
                </div>
                <div class="card" style="background-color: #f2f0f7;">
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="cod_art" class="form-label">Codigo del Articulo</label>
                                <input required class="form-control" type="text" name="cod_art" id="cod_art" value="<?php echo $fila['cod_art']; ?>">
                            </div>
    
                            <div class="mb-3">
                                <label for="id_prov" class="form-label">Fabricante</label>
                                <select required class="form-control" id="id_prov" name="id_prov">
                                    <?php
                                    $sql = "SELECT * FROM fabricants";
                                    $fabrics = $conexion->consultar($sql);
                                    foreach ($fabrics as $f) {
                                        if ($f['id'] == $fila['id_prov']) {
                                            echo "<option value=\"{$f['id']}\" selected>{$f['nombre']}</option>";
                                        } else {
                                            echo "<option value=\"{$f['id']}\">{$f['nombre']}</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
    
                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Detalle</label>
                                <input required class="form-control" type="text" name="descripcion" id="descripcion"
                                    value="<?php echo $fila['descripcion']; ?>">
                            </div>

                            <div class="mb-3">
                                <label for="costo" class="form-label">Precio-Costo-Docena</label>
                                <input required class="form-control" type="number" name="costo" id="costo"
                                    value="<?php echo $fila['costo']; ?>">
                            </div>

                            <div class="mb-3">
                                <label for="fecha_alta" class="form-label">Fecha de Alta</label>
                                <input required class="form-control" type="date" name="fecha_alta" id="fecha_alta"
                                    value="<?php echo $fila['fecha_alta']; ?>">
                            </div>

                            <div class="d-flex justify-content-center mt-4">
                                <input class="btn btn-warning btn-md" type="submit" value="Modificar Registro"
                                    onclick="return processForm(event);">
                                <input class="btn btn-danger btn-md mx-2" type="button" name="Cancelar" value="Cancelar"
                                    onClick="location.href='galeria.php?option=<?php echo $_SESSION['option']; ?>'">
                            </div>
                        </form>
                    </div><!--cierra el card-body-->
                </div><!--cierra el card-->
            </div><!--cierra el col-->
        </div>
    </div>

<?php } ?>

<script type="text/javascript">
    function processForm(e){
        var respuest = confirm("¿Desea realmente MODIFICAR el Registro...?");
        if (respuest == false) {
            e.preventDefault();
        }else{
            alert('Ya lo MODIFICASTE!');
        }
    }
</script>
º