<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/Usuario.php';
$user= new \es\ucm\fdi\aw\Usuario();
$password=$_POST['password'];
$correo=$_POST['correo'];
$descripcion=$_POST['descripcion'];


if(isset($_SESSION['nombre'])){
	$nick = $_SESSION['nombre'];
}
	
if($password != ""){
	//echo ("voy a cambiar la contraseña");
	$user->cambiarPass($nick,$password);
}
if($correo!= ""){
	//echo ("voy a cambiar la correo");
	$user->cambiarCorreo($nick,$correo);	
}
if($descripcion!=""){
	//echo ("voy a cambiar la descripcion");
	$user->cambiarDescripcion($nick,$descripcion);	
}
if($_FILES ["avatar"]["size"]){
						
	$tamano = $_FILES ["avatar"]["size"]; // Leemos el tamaño del fichero
	
	$tamaño_max="2097152"; // Tamaño maximo permitido
	if( $tamano < $tamaño_max){ // Comprovamos el tamaño 
		$destino = 'img/avatar' ; // Carpeta donde se guardata
		$sep=explode('image/',$_FILES["avatar"]["type"]); // Separamos image/
		$tipo=$sep[1]; // Optenemos el tipo de imagen que es
		//echo var_dump($_FILES ["avatar"]["type"]);
		if($tipo == "jpeg"){ // Si el tipo de imagen a subir es el mismo de los permitidos, segimos. Puedes agregar mas tipos de imagen
			move_uploaded_file ( $_FILES [ 'avatar' ][ 'tmp_name' ], $destino . '/' .$nick.'.'.$tipo);  // Subimos el archivo
			$ruta=$destino . '/' .$nick.'.'.$tipo;
			$user->cambiaAvatar($nick,$ruta);
		}else echo "el tipo de archivo no es de los permitidos";// Si no es el tipo permitido lo desimos
	}else echo "El archivo supera el peso permitido.";// Si supera el tamaño de permitido lo desimos
}
header("Location: sobremi.php");
?>