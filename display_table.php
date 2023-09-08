<?php
session_start();

// Obtener la tabla HTML de la variable de sesión
$tablaHTML = $_SESSION['tablaHTML'];

// Mostrar la tabla en la nueva pantalla
echo $tablaHTML;
?>