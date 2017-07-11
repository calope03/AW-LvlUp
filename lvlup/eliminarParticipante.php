<?php
	require_once __DIR__.'/includes/config.php';
	require_once __DIR__.'/includes/Evento.php';
	$id = $_GET["id"];
	$nick = $_GET["nick"];
	echo $id;
	echo $nick;
	$evento= new \es\ucm\fdi\aw\Evento();
	$evento->eliminarParticipante($id, $nick);
	header("Location: eventoX.php?id=".$id);	
?>