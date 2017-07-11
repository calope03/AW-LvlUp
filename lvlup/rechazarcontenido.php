<?php
	require_once __DIR__.'/includes/config.php';
	require_once __DIR__.'/includes/Noticia.php';
	$id = $_GET["id"];
	if(isset($_POST['url'])){
		$url=$_POST['url'];
	}else{
		$url="index.php";
	}
	$contenido= new \es\ucm\fdi\aw\Contenido();
	$contenido->rechazarContenido($id);
	header("Location:".$url);
	
?>