<?php
//session_start();
//echo "estoy iniciando sesion";
require_once __DIR__.'/includes/config.php'; 
require_once __DIR__.'/includes/Usuario.php';
$usuario= new \es\ucm\fdi\aw\Usuario();
$url = $_POST["url"];
$urlseparada = explode("?", $url);
if(isset($urlseparada[1])){
	$error = explode("&", $urlseparada[1]);
}
//echo var_dump($urlseparada);
$nick = $_POST["usuario"];
$pass = $_POST["contrasena"];
$pass = sha1($pass);
echo $pass;
$ok=$usuario->login($nick,$pass);
if($ok==true){
	$_SESSION['nombre'] = $nick;
	$user=$usuario->dameUsuario($nick);
	if($user['pend_notificar']==1){
		$usuario->noNotificar($nick);
		if($error[0]=="error=true"){
			
			header("Location:".$urlseparada[0]."?".$error[1]."&nivel=true");
		}else{
			header("Location:".$urlseparada[0]."?".$error[0]."&nivel=true");
		}
	}else{
		if($error[0]=="error=true"){
			header("Location:".$urlseparada[0]."?".$error[1]);
		}else{
			header("Location:".$urlseparada[0]."?".$error[0]);
		}
	}
	
	
}else{
	if($error[0]=="error=true"||$urlseparada[0]=="error=true"){
		header("Location:".$urlseparada[0]."?"."error=true&".$error[1]);
	}else{
		header("Location:".$urlseparada[0]."?"."error=true&".$error[0]);
	}
}
//$_SESSION['nombre'] ="admin";
//header("Location:".$url."");
?>