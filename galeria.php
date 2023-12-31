<?php session_start();
include 'conexion.php';
include 'calculos.php';

$opcion = isset($_GET['option']) ? $_GET['option'] : '';
$conexion = new conexion();


// Check if a search query is submitted
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['searchQuery'])) {
    $searchQuery = $_GET['searchQuery'];

    // Use the search method from the conexion class
    $results = $conexion->search("%$searchQuery%", $opcion);

    // Output the search results as HTML
    displaySearchResults($results);

    exit();
} 

if ($opcion) {
        //$opcion = $option;
        
        $texto = strtoupper($opcion);

        #Seccion que TOMA variables pa Borrar o Modificar Registro
        if ($_GET) {
            if (isset($_GET['modificar'])) {
                $id = $_GET['modificar'];
                header("Location:modificar.php?modificar=" . $id);
                die();
            }

            if(isset($_GET['registrar'])) {
                header("Location:registrar.php?option=" . $option);
                die();
            }

            if (isset($_GET['borrar'])) {
                $id = $_GET['borrar'];
                $conexion = new conexion();

                #borramos el registro de la base 
                $sql = "DELETE FROM $opcion WHERE $opcion.`id` =".$id;
                $id_proyecto = $conexion->ejecutar($sql);
                #para que no intente borrar muchas veces
                header("Location:galeria.php?option=" . $option);
                die();

                //header("Location:galeria.php");
                //die();
            }
        }
    }
        $sql = "SELECT " . $opcion . ".id, " . $opcion . ".cod_art, " . $opcion . ".id_prov, " 
                . $opcion . ".descripcion, " . $opcion . ".precio_doc, " . $opcion . ".precio_oferta," 
                . $opcion . ".fecha_alta, " . $opcion . ".imagen, fabricants.nombre 
                FROM " . $opcion . "
                INNER JOIN fabricants ON " . $opcion . ".id_prov = fabricants.id";
        $opData = $conexion->consultar($sql);

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

<body>
    <div class="fixed-section">
        <div class="d-flex align-items-center justify-content-between">
            <a href="index_admin.php" class="back-link"><i class="fas fa-arrow-left"></i></a>

            <div id="search-box" class="mt-3">
                <form id="search-form" method="get" action="galeria.php">
                    <input type="text" id="searchQuery" name="searchQuery" placeholder="Search records..."
                        class="form-control p-1">
                    <button type="submit" class="search-icon"><i class="fas fa-search"></i></button>
                </form>
            </div>
            
            
        </div>

        
        <div class="row d-flex justify-content-center mb-0">
            <div class="col-md-8 col-sm-10 mt-3">
                <h2><b><i>SECCION
                    <?php echo $texto; ?>
                </i></b></h2>
                <div class="ms-4 mt-4">
                    <a class="btn boton" name="registrar" id="registrar" href="registrar.php?option=<?php echo $opcion; ?>" >
                        <span class="text-span">ALTA NUEVO ARTICULO</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!--cierra el col
    
        <button class="btn boton dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <span class="text-span">ALTA NUEVO ARTICULO</span>
                    </button>    -->

    <!-- TABLA CON LOS REGISTROS ACTUALES -->
    
    <div style="background-color:#f2f0f7; margin-top: 35px;">
        <div class="row d-flex justify-content-center mb-5">
            <div class="col-md-10 col-sm-6 mt-3">
                <div>
                    <h3 style="text-align:center; padding: 10px;"><b>MODIFICAR O BORRAR ARTICULOS</b></h2>
                </div>
                <div id="search-results-container">
                    <!-- Search results will be inserted here dynamically -->
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
                        foreach ($opData as $op) { ?>
                            <tr>
                                <td>
                                    <?php echo $op['cod_art']; ?>
                                </td>
                                <td>
                                    <?php echo $op['nombre']; ?>
                                </td>
                                <td>
                                    <?php echo $op['descripcion']; ?>
                                </td>
                                <td>
                                    <?php echo $op['precio_doc']; ?>
                                </td>
                                <td>
                                    <?php echo $op['precio_oferta']; ?>
                                </td>
                                <td><a name="modificar" id="modificar" class="btn btn-warning"
                                        href="?modificar=<?php echo $op['id']; ?>">Modificar</a></td>
                                <td><a onclick='wantdelete(event)' name="eliminar" id="eliminar" class="btn btn-danger"
                                        href="?borrar=<?php echo $op['id']; ?>">Eliminar</a></td>
                            </tr>
                            <!--cerramos la llave del foreach-->
                        <?php
                        } ?>
                    </tbody>
                </table>
                <!--Mobile Design From Here-->
                <?php #leemos proyectos 1 por 1
                foreach ($opData as $op) { 
                    displaySearchResults($op); 
                } ?>
            </div>
            <!--cierra el col-->
        </div>
    </div>

    <!-- Include jQuery directly from CDN <a  class="btn btn-warning" href="?modificar=<?php echo $op['id']; ?>">Modificar</a>-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>

    <script>
        //const searchButton = document.querySelector('.search-icon');
        const searchForm = document.getElementById('search-form');
        const searchResultsContainer = document.getElementById('search-results-container');

        searchForm.addEventListener('submit', (event) => {
            event.preventDefault(); // Prevent default form submission
            const searchQuery = document.getElementById('searchQuery').value;

            // Make an AJAX request to galeria.php with the searchQuery
            fetch(`galeria.php?option=<?php echo $opcion; ?>&searchQuery=${searchQuery}`)
                    .then(response => response.text())
                    .then(html => {
                        // Update the page content with the search results
                        searchResultsContainer.innerHTML = html;
                        
                    })
                    .catch(error => console.error('Error:', error));
            });
    </script>


    <script type="text/javascript">
        function wantdelete(e) {
            var respuest2 = confirm("Desea realmente BORRAR el Registro ...?");
            if (respuest2 == false) {
                e.preventDefault();
            } else {
                alert('BORRADO Con fir ma do !!!');
            }
        }
    </script>
</body>

</html>