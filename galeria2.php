<?php include 'conexion.php'; ?>

<?php
#Seccion que TOMA variables para ALTA de Registro
if($_POST){  # si hay envio de datos, los inserto en la base de datos  
    #$id = $_SESSION['id'];
    $cod_art = $_POST['cod_art'];
    $id_prov = $_POST['id_prov'];
    $descripcion = $_POST['descripcion'];
    $docena = $_POST['precio_doc'];
    $oferta = $_POST['precio_oferta'];
    $fecha_alta = $_POST['fecha_alta'];
    
    #creo una instancia(objeto) de la clase de conexion
    $conexion = new conexion();
    
    $sql = "INSERT INTO `medias` (`id`, `cod_art`, `id_prov`, `descripcion`, `precio_doc`, `precio_oferta`, `fecha_alta`) 
            VALUES (NULL, '$cod_art', '$id_prov', '$descripcion', '$docena', '$oferta', '$fecha_alta')";
    
    $id_proyecto = $conexion->ejecutar($sql);

    header("location:galeria2.php");
    die();
}
 
if($_GET){
    #ademas de borrar de la base , tenemos que borrar la foto de la carpeta imagenes
    if(isset($_GET['modifica2'])){
        $id = $_GET['modifica2'];
        header("Location:modifica2.php?modifica2=".$id);
        die();
    }

    if(isset($_GET['borrar2'])){
        $id = $_GET['borrar2'];
        $conexion = new conexion();
        #borramos el registro de la base 
        $sql ="DELETE FROM `medias` WHERE `medias`.`id` =".$id;

        $id_proyecto = $conexion->ejecutar($sql);
         #para que no intente borrar muchas veces
         header("Location:galeria2.php");
         die();
    }
}    

$conexion = new conexion();

$sql = "SELECT `medias`.`id`, `medias`.`cod_art`, `medias`.`id_prov`, `medias`.`descripcion`, `medias`.`precio_doc`, 
        `medias`.`precio_oferta`, `fabricants`.`nombre` FROM `medias` INNER JOIN `fabricants` ON `medias`.`id_prov`=`fabricants`.`id`";
$medias = $conexion -> consultar($sql);
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
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
    crossorigin="anonymous">
    <style>
        body, html {
                margin: 0;
                padding: 0;
                position: relative;
            }
        .dropdown-container {
            margin-top: 20px; /* Adjust the value as needed */
        }
        h2 {
            margin-top: 50px; /* Adjust the value as needed */
            text-align: center;
        }
        .dropdown-menu.wider {
            width: 400px;
            max-width: 110%; /* Adjust the value as needed */
            
        }
        .boton {
            background-color: #5728b7;
            color: white;
            border-radius: 5px;
        }
        .cambia {
            color: aliceblue;
        }
        .back-link:last-child {
            position: fixed;
            top: 10px;
            left: 20px; /* Adjust the left position as needed */
            color: #333;
            text-decoration: none;
        }
        /* Style for the search box */
        #search-box {
            position: fixed;
            top: 3px;
            left: 180px; /* Adjust the left position as needed */
            display: none;
        }
        .search-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #5728b7;
            cursor: pointer;
        }

        @media (max-width: 768px) {
            .dropdown-container {
                margin-top: 10px; /* Adjust the value as needed */
            }
            .tabla__galeria {
                display:none!important;
            }
            .card__mobile{
                display:block!important;
            }
            .back-link {
                position: fixed;
                top: 18px;
                left: 20px;
                color: #333; /* Set your desired color */
                text-decoration: none;
            }
            /* Style for the search icon */
            .back-link:last-child {
                top: 16px;
                left: auto;
                right: 35px;
            }
        }
    </style>
</head>

<body>
    <div class="d-flex align-items-center justify-content-between">
        <div id="search-box" class="mt-3">
            <input type="text" placeholder="Search records..." class="form-control p-0">
            <a href="#" id="search-button" class="search-icon"><i class="fas fa-search"></i></a>
        </div>
        <a href="index_admin.php" class="back-link"><i class="fas fa-arrow-left"></i></a>
        <a href="#" class="back-link" id="search-icon"><i class="fas fa-search"></i></a>
    </div>

    <!-- FORMULARIO DE ALTA DE REGISTRO -->
    <div class="row d-flex justify-content-center mt-0 mb-0 dropdown-container">
        <div class="col-md-8 col-sm-10">
            <h2><b><i>SECCION DAMAS</i></b></h2>        
                <div class="dropdown ms-4 mt-4">
                    <button class="btn boton dropdown-toggle" type="button" 
                    id="dropdownMenuButton" data-bs-toggle="dropdown"  
                    aria-expanded="false">
                        <span class="text-span">ALTA NUEVO ARTICULO</span>
                    </button>
                    <div class="dropdown-menu wider" aria-labelledby="dropdownMenuButton" 
                        style="background-color:#f2f0f7; transform: translate3d(-21px, 40px, 0px); height: 430px;">
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
                                    $fabrics = $conexion -> consultar($sql);
                                    foreach ($fabrics as $f){ ?>
                                        <option value="<?php echo $f['id'] ?>;"> <?php echo $f['nombre']; ?> </option>
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
                            <input class="btn btn-warning" type="submit" value="Grabar Registro" onclick="return processForm(event);">
                        </div>
                    </form>
                </div> <!--cierra el body-->
            </div><!--cierra el card-->
        </div><!--cierra el col-->
    </div><!--cierra el row-->

    <!-- TABLA CON REGISTRO ACTUALES -->
    <div style="background-color:#f2f0f7;">
        <div class="row d-flex justify-content-center mt-4 mb-5">
            <div class="col-md-10 col-sm-6">
                <div>
                    <h2 style="text-align:center; padding: 10px;"><b>MODIFICAR O BORRAR ARTICULOS</b></h2>
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
                    <tbody >
                        <?php #leemos registros 1 por 1
                        foreach($medias as $m){ ?>
                        <tr >
                            <td><?php echo $m['cod_art'];?></td>
                            <td><?php echo $m['nombre'];?></td>
                            <td><?php echo $m['descripcion'];?></td>
                            <td><?php echo $m['precio_doc'];?></td>
                            <td><?php echo $m['precio_oferta'];?></td>
                            <td><a name="modifica2" id="modifica2" class="btn btn-warning" href="?modifica2=<?php echo $m['id'];?>">Modificar</a></td>
                            <td><a onclick='wantdelete(event)' name="borrar2" id="borrar2" class="btn btn-danger" href="?borrar2=<?php echo $m['id'];?>">Borrar</a></td>
                        </tr>

                        <?php #cerramos la llave del foreach
                        } ?>
                    </tbody>
                </table>
                <!--Mobile Design From Here-->
                <?php #leemos proyectos 1 por 1
                    foreach($medias as $m){ ?>
                    <div class="col card__mobile  mb-4">
                        <div class="card border border-3 shadow w-100">
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th scope="col">Cod.Artículo: </th>
                                            <td><?php echo $dama['cod_art']; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="col">Proveedor : </th>
                                                <td>
                                                    <?php echo $dama['nombre']; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="col">Descripción : </th>
                                                <td>
                                                    <?php echo $dama['descripcion']; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="col">Precio Docena: $</th>
                                                <td>
                                                    <?php echo $dama['precio_doc']; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="col">Oferta Unidad: $</th>
                                                <td>
                                                    <?php echo $dama['precio_oferta']; ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="d-flex justify-content-center mb-2">
                                        <div>
                                            <a name="modificar" id="modificar" class="btn btn-warning"
                                                href="?modificar=<?php echo $dama['id']; ?>">Modificar</a>
                                            <a onclick='wantdelete(event)' name="eliminar" id="eliminar" class="btn btn-danger"
                                                href="?borrar=<?php echo $dama['id']; ?>">Eliminar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php } ?>
            </div><!--cierra el col-->  
        </div>
    
    </div>
<!-- Include jQuery directly from CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>

<!-- Initialize Bootstrap dropdown -->
<script>
    // Apply the color-change class when the button is clicked
    document.getElementById('dropdownMenuButton').addEventListener('click', function() {
        const textSpan = document.querySelector('.text-span');
        textSpan.classList.add('cambia');
    });
</script>

<script>
    const searchInput = document.getElementById('search-input');
    const searchButton = document.getElementById('search-button');

    searchButton.addEventListener('click', () => {
        const searchQuery = searchInput.value;
        // Here you can implement your search logic using the searchQuery
        // For example, you can use AJAX to fetch search results from the server
        console.log('Search query:', searchQuery);
        // Implement your search logic here
    });
</script>

<script>
    $(document).ready(function() {
        $('.dropdown-toggle').dropdown();
    });
</script>

<script>
    const searchIcon = document.getElementById('search-icon');
    const searchBox = document.getElementById('search-box');

    searchIcon.addEventListener('click', () => {
        searchBox.style.display = searchBox.style.display === 'none' ? 'block' : 'none';
    });
</script>
<!--Funcion para Preguntar Borrado-->
<script>
    function processForm(e) {
        var respuest = confirm("Desea GRABAR el Registro ...?");
        if (respuest == false) {
            e.preventDefault();
        }else{
            alert('ALTA Exitosa !!!');
        }
    }

    function wantdelete(e){
        var respuest2 = confirm("Desea realmente BORRAR el Registro ...?");
        if (respuest2 == false) {
            e.preventDefault();
        }else{
            alert('BORRADO Con fir ma do !!!');
        }
    }
</script>