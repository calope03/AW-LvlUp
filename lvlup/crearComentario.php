<?php
  require_once __DIR__.'/includes/config.php'; 
  require_once __DIR__.'/includes/comentario.php';
	
	$comentario= new \es\ucm\fdi\aw\Comentario();
	$texto = htmlspecialchars(trim(strip_tags($_POST['comment'])));
	$id_contenido = $_POST['id_contenido'];
	$autor = $_POST['autor'];
	$url = $_POST['url'];
	
	
	$comentario->guardarNuevoComentario($autor, $texto, $id_contenido);

	header("Location:".$url."");
?>