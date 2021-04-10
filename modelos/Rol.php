<?php 
//incluir la conexion de base de datos
require "../config/Conexion.php";
class Rol{ 


	//implementamos nuestro constructor
public function __construct(){

}

// inserta registro
public function insertar($Codigo_perfil,$Descripcion_perfil,$Observaciones){
	$sql="INSERT INTO rol(Codigo_perfil,Descripcion_perfil,Observaciones) VALUES ('$Codigo_perfil','$Descripcion_perfil','$Observaciones')";
	return ejecutarConsulta($sql);
}

//listar registros
public function select(){
	$sql="SELECT * FROM rol";
	return ejecutarConsulta($sql);
}
}

 ?>
