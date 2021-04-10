<?php 
session_start();
require_once "../modelos/Usuario.php";
use PHPMailer\PHPMailer\PHPMailer;
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
//require "../PHPMailer/PHPMailerAutoload.php";
$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

$usuario=new Usuario();

$idusuario=isset($_POST["idusuario"])? limpiarCadena($_POST["idusuario"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$tipo_documento=isset($_POST["tipo_documento"])? limpiarCadena($_POST["tipo_documento"]):"";
$num_documento=isset($_POST["num_documento"])? limpiarCadena($_POST["num_documento"]):"";
$direccion=isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
$telefono=isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
$email=isset($_POST["email"])? limpiarCadena($_POST["email"]):"";
$cargo=isset($_POST["cargo"])? limpiarCadena($_POST["cargo"]):"";
$login=isset($_POST["login"])? limpiarCadena($_POST["login"]):"";
$clave=isset($_POST["clave"])? limpiarCadena($_POST["clave"]):"";
$imagen=isset($_POST["imagen"])? limpiarCadena($_POST["imagen"]):"";
$apellido=isset($_POST["apellido"])? limpiarCadena($_POST["apellido"]):"";
$password=substr(str_shuffle($permitted_chars), 0, 8);

switch ($_GET["op"]) {
	case 'guardaryeditar':

	if (!file_exists($_FILES['imagen']['tmp_name'])|| !is_uploaded_file($_FILES['imagen']['tmp_name'])) {
		$imagen=$_POST["imagenactual"];
	}else{
		$ext=explode(".", $_FILES["imagen"]["name"]);
		if ($_FILES['imagen']['type']=="image/jpg" || $_FILES['imagen']['type']=="image/jpeg" || $_FILES['imagen']['type']=="image/png") {
			$imagen=round(microtime(true)).'.'. end($ext);
			move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/usuarios/".$imagen);
		}
	}

	

	//Hash SHA256 para la contraseña
	$passwordHash=hash("SHA256", $password);
	$clavehash=hash("SHA256", $clave);
	if (empty($idusuario)) {
		$rspta=$usuario->insertar($nombre,$tipo_documento,$num_documento,$direccion,$telefono,$email,$cargo,$login,$passwordHash,$imagen,$_POST['permiso'],$apellido);
		echo $rspta ? "Datos registrados correctamente" : "No se pudo registrar todos los datos del usuario";
		//librerias
		
		//Create a new PHPMailer instance
		$mail = new PHPMailer();
		$mail->IsSMTP();
		
		//Configuracion servidor mail
		$mail->setFrom("atlhax7@gmail.com","Comercializadora Monster");
		//$mail->From = "henry83266@gmail.com"; //remitente
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = 'tls'; //seguridad
		$mail->Host = "smtp.gmail.com"; // servidor smtp
		$mail->Port = 587; //puerto
		$mail->Username ='atlhax7@gmail.com'; //nombre usuario
		$mail->Password = 'erick1997'; //contraseña
		
		//Agregar destinatario
		$mail->AddAddress($email);
		$mail->Subject = "Codigo de Ingreso";
		$message = '
		<html>
			<head>
				<title>HTML email</title>
			</head>
			<body>
				<h1>Estimado señor/a '.$nombre." ".$apellido.'</h1>
				<h2>Código de ingreso: <a> '.$password.' </a></h2>
			</body>
		</html>
		';

		$mail->Body = $message;
		$mail->CharSet = 'UTF-8';
		$mail->isHTML(true);
		//Avisar si fue enviado o no y dirigir al index
		if ($mail->Send()) {
			echo 'Enviado Correctamente';
		} else {
			echo 'Error: '.$mail->ErrorInfo;
		}
		
	}else{
		$rspta=$usuario->editar($idusuario,$nombre,$tipo_documento,$num_documento,$direccion,$telefono,$email,$cargo,$login,$clavehash,$imagen,$_POST['permiso'],$apellido);
		echo $rspta ? "Datos actualizados correctamente" : "No se pudo actualizar los datos";
	}
	break;
	

	case 'desactivar':
	$rspta=$usuario->desactivar($idusuario);
	echo $rspta ? "Datos desactivados correctamente" : "No se pudo desactivar los datos";
	break;

	case 'activar':
	$rspta=$usuario->activar($idusuario);
	echo $rspta ? "Datos activados correctamente" : "No se pudo activar los datos";
	break;
	
	case 'mostrar':
	$rspta=$usuario->mostrar($idusuario);
	echo json_encode($rspta);
	break;

	case 'listar':
	$rspta=$usuario->listar();
	$data=Array();

	while ($reg=$rspta->fetch_object()) {
		$data[]=array(
			"0"=>($reg->condicion)?'<button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#formularioregistros" onclick="mostrar('.$reg->idusuario.')"><i class="fa fa-pencil"></i></button>'.' '.'<button class="btn btn-danger btn-xs" onclick="desactivar('.$reg->idusuario.')"><i class="fa fa-close"></i></button>':'<button class="btn btn-warning btn-xs" data-toggle="modal" data-target="#formularioregistros" onclick="mostrar('.$reg->idusuario.')"><i class="fa fa-pencil"></i></button>'.' '.'<button class="btn btn-primary btn-xs" onclick="activar('.$reg->idusuario.')"><i class="fa fa-check"></i></button>',
			"1"=>$reg->nombre,
			"2"=>$reg->tipo_documento,
			"3"=>$reg->num_documento,
			"4"=>$reg->telefono,
			"5"=>$reg->email,
			"6"=>$reg->login,
			"7"=>"<img src='../files/usuarios/".$reg->imagen."' height='50px' width='50px'>",
			"8"=>($reg->condicion)?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>',
			"9"=>$reg->apellido
		);
	}

	$results=array(
             "sEcho"=>1,//info para datatables
             "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
             "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
             "aaData"=>$data); 
	echo json_encode($results);
	break;

	case 'permisos':
			//obtenemos toodos los permisos de la tabla permisos
	require_once "../modelos/Permiso.php";
	$permiso=new Permiso();
	$rspta=$permiso->listar();
//obtener permisos asigandos
	$id=$_GET['id'];
	$marcados=$usuario->listarmarcados($id);
	$valores=array();

//almacenar permisos asigandos
	while ($per=$marcados->fetch_object()) {
		array_push($valores, $per->idpermiso);
	}
			//mostramos la lista de permisos
	while ($reg=$rspta->fetch_object()) {
		$sw=in_array($reg->idpermiso,$valores)?'checked':'';
		echo '<li><input type="checkbox" '.$sw.' name="permiso[]" value="'.$reg->idpermiso.'">'.$reg->nombre.'</li>';
	}
	break;

	case 'verificar':
	//validar si el usuario tiene acceso al sistema
	$logina=$_POST['logina'];
	$clavea=$_POST['clavea'];

	//Hash SHA256 en la contraseña
	$clavehash=hash("SHA256", $clavea);
	
	$rspta=$usuario->verificar($logina, $clavehash);

	$fetch=$rspta->fetch_object();
	if (isset($fetch)) {
		# Declaramos la variables de sesion
		$_SESSION['idusuario']=$fetch->idusuario;
		$_SESSION['nombre']=$fetch->nombre;
		$_SESSION['imagen']=$fetch->imagen;
		$_SESSION['login']=$fetch->login;

		//obtenemos los permisos
		$marcados=$usuario->listarmarcados($fetch->idusuario);

		//declaramos el array para almacenar todos los permisos
		$valores=array();

		//almacenamos los permisos marcados en al array
		while ($per = $marcados->fetch_object()) {
			array_push($valores, $per->idpermiso);
		}

		//determinamos lo accesos al usuario
		in_array(1, $valores)?$_SESSION['escritorio']=1:$_SESSION['escritorio']=0;
		in_array(2, $valores)?$_SESSION['almacen']=1:$_SESSION['almacen']=0;
		in_array(3, $valores)?$_SESSION['compras']=1:$_SESSION['compras']=0;
		in_array(4, $valores)?$_SESSION['ventas']=1:$_SESSION['ventas']=0;
		in_array(5, $valores)?$_SESSION['acceso']=1:$_SESSION['acceso']=0;
		in_array(6, $valores)?$_SESSION['consultac']=1:$_SESSION['consultac']=0;
		in_array(7, $valores)?$_SESSION['consultav']=1:$_SESSION['consultav']=0;

	}
	echo json_encode($fetch);


	break;
	case 'salir':
	   //limpiamos la variables de la secion
	session_unset();

	  //destruimos la sesion
	session_destroy();
		  //redireccionamos al login
	header("Location: ../index.php");
	break;

	case 'selectRol':
		require_once "../modelos/Rol.php";
		$rol = new Rol();
		$rspta = $rol -> select();
		while($reg=$rspta->fetch_object()){
			echo '<option value=' .$reg->Codigo_perfil.'>'.$reg->Descripcion_perfil.'</option>';
		}
	break;
}
?>

