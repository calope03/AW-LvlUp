<?php
	require_once __DIR__.'/includes/config.php';
	require_once __DIR__.'/includes/Evento.php';
	$id = $_GET["id"];
	$nick = $_GET["nick"];
	$equipo = $_GET["equipo"];
	$evento= new \es\ucm\fdi\aw\Evento();
	$evento->anyadirParticipante($id, $nick, $equipo);
	header("Location: eventoX.php?id=".$id);
	
?>