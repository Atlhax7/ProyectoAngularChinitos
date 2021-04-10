<?php
session_start();
require_once "../modelos/Rol.php";

$rol = new Rol();

$Codigo_perfil=isset($_POST["Codigo_perfil"])? limpiarCadena($_POST["Codigo_perfil"]):"";
$Descripcion_perfil=isset($_POST["Descripcion_perfil"])? limpiarCadena($_POST["Descripcion_perfil"]):"";
$Observaciones=isset($_POST["Observaciones"])? limpiarCadena($_POST["Observaciones"]):"";

switch ($_GET["op"]){
    case 'guardaryeditar':
        if(empty($Codigo_perfil)){
            $rspta=$rol->insertar($Codigo_perfil,$Descripcion_perfil,$Observaciones);
            echo $rspta ? "Datos registrados correctamente" : "No se pudo registrar los datos";
        }
        
        break;
}

?>