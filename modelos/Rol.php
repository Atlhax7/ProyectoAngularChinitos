<?php 
//incluir la conexion de base de datos
require "../config/Conexion.php";
class Rol{ 


	//implementamos nuestro constructor
public function __construct(){

}



//listar registros
public function select(){
	$sql="SELECT * FROM rol";
	return ejecutarConsulta($sql);
}
}

 ?>
