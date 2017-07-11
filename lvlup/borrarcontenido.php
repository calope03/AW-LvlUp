<?php
	require_once __DIR__.'/includes/config.php';
	require_once __DIR__.'/includes/Noticia.php';
	$id = $_GET["id"];
	$noticia= new \es\ucm\fdi\aw\Noticia();
	$noticia->borrarNoticia($id);
	header("Location: index.php?borrado=true");
	
?>