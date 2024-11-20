<?php
session_start();
include "conexion.php";
$conexion = new conexion();

// Check if the 'piso' parameter is passed in the URL
$nroPiso = isset($_GET['piso']) ? intval($_GET['piso']) : null;

// Prepare the SQL query based on the 'nroPiso' value
if ($nroPiso) {
    // Only select records for the chosen 'nroPiso'
    $sql = "SELECT locales.*, niveles.nivel 
            FROM locales 
            LEFT JOIN niveles ON locales.nroPiso = niveles.id 
            WHERE locales.nroPiso = " . $nroPiso;
} else {
    // If no 'nroPiso' is selected, display all records
    $sql = "SELECT locales.*, niveles.nivel 
            FROM locales 
            LEFT JOIN niveles ON locales.nroPiso = niveles.id";
}

// Fetch the records using the 'consultar' method
$result = $conexion->consultar($sql);

if ($_GET) {
    if (isset($_GET['modificar'])) {
        $id = $_GET['modificar'];
        header("Location:modificar.php?modificar=" . $id);
        die();
    }

    if(isset($_GET['registrar'])) {
        header("Location:altaGaleria.php");
        die();
    }

    if (isset($_GET['eliminar'])) {
        $id = $_GET['eliminar'];
        $conexion = new conexion();

         // Ensure $id is properly escaped to prevent SQL injection
        $id = intval($id);  // Convert $id to an integer

        #borramos el registro de la base 
        $sql = "DELETE FROM locales WHERE `id` =" . $id;
        $id_proyecto = $conexion->ejecutar($sql);
        #para que no intente borrar muchas veces
        header("Location:abmFeriaSol.php");
        die();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edicion Pisos Galeria F.S.</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        .back-button {
            position: absolute;
            left: 10px; /* Position to the left side */
            top: 10px;
            color: black; /* Adjust the color if needed */
        }
        .boton {
            background-color: white;
            color: #5728b7;
            border-style: solid;
            border-color: #5728b7;
            border-radius: 25px;
            cursor: pointer;
            transition: background-color 0.5s ease, color 0.3s ease; /* Smooth transition */
        }
        .boton:hover {
            background-color: #5728b7; /* Color when hovered */
            color: white;             /* Optional: Change text color when hovered */
            border: none;
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
        .tituloABM {
            color: #5728b7;
        }
    </style>
</head>
<body>
    
<div class="main-content">
        <!-- Cabezera -->
        <div class="container mt-3">
            <div class="row">
                <div class="col">
                    <a href="loginAdmin.php" class="back-button"><i class="fas fa-arrow-left"></i></a>
                </div>
                <div class="col text-end">
                    <a href="loginAdmin.php" class="btn boton">Salir</a>
                </div>
            </div>
        </div>

        <div class="text-center mt-4">
            <img src="imagenes/crud.jpg" alt="Logo" width="150" height="150" class="img-fluid d-block mx-auto">
        </div>

        <div class="row d-flex justify-content-center mb-0">
            <div class="col-md-8 col-sm-10 mt-3">
                
                <div class="ms-4 mt-1">
                    <a class="btn btn-outline-dark boton" name="registrar" id="registrar" href="altaGaleria.php">
                        <span class="text-span">ALTA DE UNIDAD</span>
                    </a>
                </div>
            </div>
        </div>
        
        <!--Tabla con Registros Unidades Vigentes-->
        <h3 class="text-center tituloABM mt-4 mb-3">Listado de Unidades</h3>
        <div class="container">
            <div class="row justify-content-center">
                <?php
                if (count($result) > 0) {  // Check if there are any results
                    foreach ($result as $row) {
                        ?>
                        <div class="col mb-4">
                            <div class="card border border-3 shadow w-100">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th scope="col">Piso :</th>
                                                <td><?php echo htmlspecialchars($row['nivel']); ?> - Ultima Vista  <?php echo htmlspecialchars($row['fecActualzda']); ?></td>
                                                
                                            </tr>
                                            <tr>
                                                <th scope="col">Unidad :</th>
                                                <td><?php echo htmlspecialchars($row['tipoLocal']); ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="col">Numero :</th>
                                                <td><?php echo htmlspecialchars($row['numLocal']); ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="col">Razon Social :</th>
                                                <td><?php echo htmlspecialchars($row['razonSocial']); ?></td>
                                            </tr>
                                            <tr>
                                                <th scope="col">Celular :</th>
                                                <td><?php echo htmlspecialchars($row['celular']); ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="d-flex justify-content-center mb-2">
                                        <a name="modificar" id="modificar" class="btn btnModif mr-2" href="modifGaleria.php?modificar=<?php echo htmlspecialchars($row['id']); ?>&piso=<?php echo $nroPiso; ?>">Modificar</a>
                                        <a onclick="wantdelete(event)" name="eliminar" id="eliminar" class="btn btnDanger" href="abmFeriaSol.php?eliminar=<?php echo htmlspecialchars($row['id']); ?>">Eliminar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "<p>No hay Unidades !!!</p>";
                }
                ?>
            </div>
        </div>
        
</div>

<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/scripts.js"></script>

</body>
</html>
<!--<div class="col mb-4">
            <div class="card border border-3 shadow w-100">
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th scope="col">Piso : </th>
                                
                            </tr>
                            <tr>
                                <th scope="col">Unidad : </th>
                                <td></td>
                            </tr>
                            <tr>
                                <th scope="col">Numero : </th>
                                <td></td>
                            </tr>
                            <tr>
                                <th scope="col">Razon Social : </th>
                                <td></td>
                            </tr>
                            <tr>
                                <th scope="col">Celular : </th>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center mb-2">
                        <a name="modificar" id="modificar" class="btn btn-warning mr-2" href="modificar.php?option=' . $_GET['option'] . '&modificar=' . $result['id'] . '">Modificar</a>
                        <a onclick="wantdelete(event)" name="eliminar" id="eliminar" class="btn btn-danger" href="galeria.php?option=' . $_GET['option'] . '&borrar=' . $result['id'] . '">Eliminar</a>
                    </div>
                </div>
            </div>
        </div>
            <button <th></th> class="btn btn-outline-dark btn-custom mb-3" onclick="llamarAPI()">Llamar API</button> -->