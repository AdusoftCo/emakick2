<?php include 'headerd.php';
if($_GET){
    if(isset($_GET['modifica2'])){
        $id = $_GET['modifica2'];
    
        $_SESSION['id_proyect2'] = $id;
        #vamos a consultar para llenar la tabla 
        $conexion = new conexion();
        $proyecto= $conexion->consultar("SELECT * FROM `medias` WHERE id=".$id);
    }
}
#femeninterior.cod_art, femeninterior.id_prov, femeninterior.descripcion, femeninterior.precio_doc, 
#        femeninterior.precio_oferta, femeninterior.fecha_alta FROM femeninterior
if($_POST){
    $id = $_SESSION['id_proyect2'];
    #debemos recuperar la imagen actual y borrarla del servidor para lugar pisar con la nueva imagen en el server y en la base de datos
    #recuperamos la imagen de la base antes de borrar 
    #$imagen = $conexion->consultar("select imagen FROM `proyectos` where id=".$id);
    #la borramos de la carpeta 
    #unlink("imagenes/".$imagen[0]['imagen']);
    #levantamos los datos del formulario
    $cod_art = $_POST['cod_art'];
    $id_prov = $_POST['id_prov'];
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
    $a = (25 * $costo)/ 100;
    $b = $costo - $a;
    $c = (12 * $b)/ 100;
    $d = $b + $c;
    $e = (26 * $d)/ 100;
    $docena = $d + $e;
    $f = $d / 12;
    $g = (55 * $f)/ 100;
    $oferta = $f + $g;

    #creo una instancia(objeto) de la clase de conexion
    
    $conexion = new conexion();
    $sql2 = "UPDATE `medias` SET `cod_art` = '$cod_art', `id_prov` = '$id_prov', 
            `descripcion` = '$descripcion', `costo`= '$costo', `precio_doc` = '$docena', 
            `precio_oferta` = '$oferta', `fecha_alta` = '$fecha_alta'
             WHERE `medias`.`id` = '$id';";
    $id_proyect2 = $conexion->ejecutar($sql2);
    
    if ($id_proyect2 === false) {
    // Display an error message or handle the error appropriately
        echo "Error executing SQL query: " . $conexion->error;
        die();
        }else{
    // Redirect the user to galeria.php
            header("Location:galeria2.php");
            exit();
    }
    #header("location:galeria2.php");
    #die();
}
?>

<?php #leemos proyectos 1 por 1
foreach($proyecto as $fila){ ?>
    <div class="row d-flex justify-content-center mt-4 mb-5">
        <div class="col-md-8 col-sm-10">
            <div class="card" style="background-color:#0daca5;">
                <div class="card-header">
                    <i><b>Datos del Articulo a MODIFICAR</b></i>
                </div>

                <div class="card-body">
                        <!--para recepcionar archivos uso enctype-->
                    <form method="post" enctype="multipart/form-data">
                        <div>
                            <label for="cod_art">Codigo del Articulo</label>
                            <input required class="form-control" type="text" name="cod_art" id="cod_art" value="<?php echo $fila['cod_art']; ?>">
                        </div>
                            
                        <div>
                            <label for="id_prov">Fabricante</label>
                            <!--<input required class="form-control" type="number" name="id_prov" id="id_prov" value="">-->
                            <br>
                            <select required class="form-control" id="id_prov" name="id_prov">
                            <?php   
                                $conexion = new conexion();
                                $sql = "SELECT * FROM fabricants";
                                $fabrics = $conexion -> consultar($sql);
                                foreach ($fabrics as $f){ 
                                    if ($f['id'] == $fila['id_prov']){ ?>
                                        <option value="<?php echo $f['id']; ?>"> <?php echo $f['nombre']; ?> </option>
                                    <?php } ?>
                                <?php } ?>
                                
                                    <?php foreach ($fabrics as $f){  ?>
                                            <option value="<?php echo $f['id']; ?>"> <?php echo $f['nombre']; ?> </option>
                                    <?php } ?>
                            </select>                            
                        </div>
                        
                        <div>
                            <label for="descripcion">Detalle</label>
                            <input required class="form-control" type="text" name="descripcion" id="descripcion" value="<?php echo $fila['descripcion']; ?>">
                        </div>

                        <div>
                            <label for="precio_doc">Precio-Costo-Docena</label>
                            <input required class="form-control" type="number" name="costo" id="costo" value="<?php echo $fila['costo']; ?>">
                        </div>
                        
                        <!--<div>
                            <label for="precio_ofer">Precio Oferta x Unidad</label>
                            <input required class="form-control" type="number" name="precio_oferta" id="precio_oferta" value="<?php echo $fila['precio_oferta']; ?>">
                        </div>-->
                        
                        <div>
                            <label for="fecha_alta">Fecha de Alta</label>
                            <input required class="form-control" type="date" name="fecha_alta" id="fecha_alta" value="<?php echo $fila['fecha_alta']; ?>">
                        </div>
                        
                        <div>
                            <br>
                            <input class="btn btn-warning btn-md" type="submit" value="Modificar Registro" onclick="processForm(event);">
                            <input class="btn btn-danger btn-md mx-2" type="button" name="Cancelar" value="Cancelar" onClick="location.href='galeria2.php'">
                        </div>
                    </form>
                </div> <!--cierra el body-->
            </div>  <!--cierra el card-->
        </div><!--cierra el col-->
    </div><!--cierra el row-->
<?php #cerramos la llave del foreach
    } ?>
    
<script type="text/javascript">
    function processForm(e) {
        var resulta = confirm("¿Desea realmente MODIFICAR el Registro...?");

        if (resulta == false) {
            e.preventDefault();
        }else{
            alert('Ya lo MODIFICASTE!');
        }
    }
</script>
<?php include 'footer.php'; ?>
