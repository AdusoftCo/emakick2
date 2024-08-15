<?php include 'headerd.php'; ?>

<?php
if ($_POST) { # si hay envio de datos, los inserto en la base de datos  
    #$id = $_SESSION['id'];
    $cod_art = $_POST['cod_art'];
    $id_prov = $_POST['id_prov'];
    $descripcion = $_POST['descripcion'];
    $costo = $_POST['costo'];
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
    if ($id_prov == 16) {
        $a = (20 * $costo)/ 100;
        $b = $costo - $a;
        $c = (7 * $b)/ 100;
        $d = $b + $c;
        $doce = $d * 12;
        $e = (30 * $doce)/ 100;
        $docena = $doce + $e;
        $f = (50 * $d)/ 100;
        $oferta = $f + $d;
    } else {
        $a = (30 * $costo) / 100;
        $docena = $costo + $a;
        $f = $costo / 12;
        $g = (55 * $f) / 100;
        $oferta = $f + $g;
    }
    
    #creo una instancia(objeto) de la clase de conexion
    $conexion = new conexion();

    $sql = "INSERT INTO `masculinos` (`id`, `cod_art`, `id_prov`, `descripcion`, `costo`, `precio_doc`, `precio_oferta`, `fecha_alta`) 
            VALUES (NULL, '$cod_art', '$id_prov', '$descripcion', '$costo', '$docena', '$oferta', '$fecha_alta')";

    $id_proyecto = $conexion->ejecutar($sql);

    header("location:galeria3.php");
    die();
}

if ($_GET) {
    #ademas de borrar de la base , tenemos que borrar la foto de la carpeta imagenes
    if (isset($_GET['modifica3'])) {
        $id = $_GET['modifica3'];
        header("Location:modifica3.php?modifica3=" . $id);
        die();
    }

    if (isset($_GET['borrar3'])) {
        $id = $_GET['borrar3'];
        $conexion = new conexion();
        #borramos el registro de la base 
        $sql = "DELETE FROM `masculinos` WHERE `masculinos`.`id` =" . $id;

        $id_proyecto = $conexion->ejecutar($sql);
        #para que no intente borrar muchas veces
        header("Location:galeria3.php");
        die();
    }
}

$conexion = new conexion();

$sql = "SELECT `masculinos`.`id`, `masculinos`.`cod_art`, `masculinos`.`id_prov`, `masculinos`.`descripcion`, `masculinos`.`precio_doc`, 
        `masculinos`.`precio_oferta`, `fabricants`.`nombre` FROM `masculinos` INNER JOIN `fabricants` ON `masculinos`.`id_prov`=`fabricants`.`id`";
$masculinos = $conexion->consultar($sql);
?>

<!-- FORMULARIO DE ALTA DE REGISTRO -->

<div class="row d-flex justify-content-center mt-0 mb-0">
    <h2 style="text-align:center; margin: 0; padding: 10px;"><b><i>CATEGORIA MEN & KIDS</i></b></h2>
    <div class="col-md-8 col-sm-10">
        <div class="card" style="background-color:#95dab5;">
            <div class="card-header text-center">
                <i><b>ALTA DE NUEVO REGISTRO</b></i>
            </div>

            <div class="card-body">
                <!--para recepcionar archivos uso enctype-->
                <form action="#" method="post" enctype="multipart/form-data">
                    <div>
                        <label for="cod_art">Codigo del Articulo</label>
                        <input required class="form-control" type="text" name="cod_art" id="cod_art">
                    </div>

                    <div>
                        <label for="id_prov">Fabricante</label>
                        <!--<input required class="form-control" type="text" name="nombre" id="nombre">-->
                        <br>
                        <select required class="form-control" name="id_prov" id="id_prov">
                            <option value="0"> -Seleccione Proveedor- </option>
                            <?php
                            $conexion = new conexion();
                            $sql = "SELECT * FROM fabricants";
                            $fabrics = $conexion->consultar($sql);
                            foreach ($fabrics as $f) { ?>
                                <option value="<?php echo $f['id']; ?>"> <?php echo $f['nombre']; ?> </option>
                            <?php } ?>

                        </select>
                    </div>

                    <div>
                        <label for="descripcion">Detalle</label>
                        <input required class="form-control" name="descripcion" id="descripcion">
                    </div>

                    <div>
                        <label for="precio_doc">Precio fabrica</label>
                        <input required class="form-control" type="number" name="costo" id="costo">
                    </div>

                    <div>
                        <label for="fecha_alta">Fecha de Alta</label>
                        <input required class="form-control" type="date" name="fecha_alta" id="fecha_alta">
                    </div>

                    <div>
                        <br>
                        <input class="btn btn-warning" type="submit" value="Grabar Registro"
                            onclick="return processForm(event);">
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

<!-- TABLA CON REGISTRO ACTUALES -->
<div style="background-color:#abd7fc;">
    <div class="row d-flex justify-content-center mb-0">
        <div class="col-md-10 col-sm-6">
            <div>
                <h2 style="text-align:center; padding: 10px;"><b>Modificar ó Borrar Registros</b></h2>
            </div>
            <table class="table tabla__galeria" style="background-color:#FAFAFA;">
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Fabricante</th>
                        <th>Descripcion</th>
                        <th>Docena</th>
                        <th>OferxUni</th>
                        <th>Modificar</th>
                        <th>Borrar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php #leemos registros 1 por 1
                    foreach ($masculinos as $m) { ?>
                        <tr>
                            <td>
                                <?php echo $m['cod_art']; ?>
                            </td>
                            <td>
                                <?php echo $m['nombre']; ?>
                            </td>
                            <td>
                                <?php echo $m['descripcion']; ?>
                            </td>
                            <td>
                                <?php echo $m['precio_doc']; ?>
                            </td>
                            <td>
                                <?php echo $m['precio_oferta']; ?>
                            </td>
                            <td><a name="modifica3" id="modifica3" class="btn btn-warning"
                                    href="?modifica3=<?php echo $m['id']; ?>">Modificar</a></td>
                            <td><a onclick='wantdelete(event)' name="borrar3" id="borrar3" class="btn btn-danger"
                                    href="?borrar3=<?php echo $m['id']; ?>">Borrar</a></td>
                        </tr>

                    <?php #cerramos la llave del foreach
                    } ?>
                </tbody>
            </table>

            <?php #leemos proyectos 1 por 1 for mobile
            foreach ($masculinos as $m) { ?>
                <div class="col card__mobile  mb-4">
                    <div class="card border border-3 shadow w-100">

                        <div class="card-body">
                            <p class="card-text text-dark">Art.:
                                <?php echo $m['cod_art']; ?>
                            </p>
                            <p class="card-text text-dark">
                                <?php echo $m['nombre']; ?>
                            </p>
                            <p class="card-text text-dark">
                                <?php echo $m['descripcion']; ?>
                            </p>
                            <p class="card-text text-dark">Docena:
                                <?php echo $m['precio_doc']; ?>
                            </p>
                            <p class="card-text text-dark">Ofer.Unidad:
                                <?php echo $m['precio_oferta']; ?>
                            </p>
                            <a name="modifica3" id="modifica3" class="btn btn-warning"
                                href="?modifica3=<?php echo $m['id']; ?>">Modificar</a>
                            <a onclick='wantdelete(event)' name="eliminar" id="eliminar" class="btn btn-danger"
                                href="?borrar3=<?php echo $m['id']; ?>">Eliminar</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <!--cierra el col-->
    </div>
    <?php include 'footerd.php'; ?>
</div>
<!--Funcion para Preguntar Borrado-->
<script>
    function processForm(e) {
        var respuest = confirm("Desea GRABAR el Registro ...?");
        if (respuest == false) {
            e.preventDefault();
        } else {
            alert('ALTA Exitosa !!!');
        }
    }

    function wantdelete(e) {
        var respuest2 = confirm("Desea realmente BORRAR el Registro ...?");
        if (respuest2 == false) {
            e.preventDefault();
        } else {
            alert('BORRADO Con fir ma do !!!');
        }
    }
</script>
