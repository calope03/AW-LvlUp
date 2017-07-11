<?php
  require_once __DIR__.'/includes/config.php'; 
  //require_once __DIR__.'/includes/Noticia.php';
  require_once __DIR__.'/includes/Valoracion.php';
	
	$url = $_POST['url'];
	
	$valoracion = new \es\ucm\fdi\aw\Valoracion(); 
	
	$puntos = $_POST["rating"];
	$id_comentario = $_POST["id"];
	//echo $id_comentario;
	$nick = $_POST["nick"];
	$nick_autor = $_POST["nick_autor"];
		
	$valoracion->registraValoracionComentario($puntos, $id_comentario, $nick, $nick_autor);
	//$valoracion->registraValoracion($id, $nick);
	
	//echo var_dump($url);	
	
	header("Location:".$url."");
	
		
?>