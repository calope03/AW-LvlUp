<?php
	require_once __DIR__.'/includes/config.php'; 
	require_once __DIR__.'/includes/Evento.php';
	
	$evento= new \es\ucm\fdi\aw\Evento();
	$titulo = htmlspecialchars(trim(strip_tags($_POST['titulo'])));
	$cuerpo = $_POST['cuerpo-evento'];
	$cuerpoParseado = str_replace("'", "''", $cuerpo);
	$opcion=$_POST['opcion'];
	$plataforma=$_POST['plataforma'];
	$participantes=$_POST['participantes'];
	$fechaIni=$_POST['fechaInicio'];
	$fechaFin=$_POST['fechaFin'];
	$juego=$_POST['juego'];
	
	
	if(isset($_SESSION['nombre'])){
		$nick = $_SESSION['nombre'];
	}
	
	echo $opcion;
	
	if($opcion=="crear"){
		$id=$evento->crearEvento($titulo, $cuerpoParseado, $nick, $participantes, $fechaIni, $fechaFin, $plataforma);
	}else if($opcion=="editar"){
		$id=$_POST['id'];
		$evento->editarEvento($id, $titulo, $cuerpoParseado, $participantes, $fechaIni, $fechaFin, $plataforma);
	}
	
	
	if($juego!="ninguno"){
		$evento->guardaJuego($juego,$id);
	}
	
	
	if($_FILES ["file"]["size"]){
					
		$tamano = $_FILES ["file"]["size"]; // Leemos el tamaño del fichero
		
		$tamaño_max="2097152"; // Tamaño maximo permitido
		if( $tamano < $tamaño_max){ // Comprovamos el tamaño 
			$destino = 'img/Eventos' ; // Carpeta donde se guardata
			$sep=explode('image/',$_FILES["file"]["type"]); // Separamos image/
			$tipo=$sep[1]; // Optenemos el tipo de imagen que es
			//echo var_dump($_FILES ["file"]["type"]);
			if($tipo == "jpeg"){ // Si el tipo de imagen a subir es el mismo de los permitidos, segimos. Puedes agregar mas tipos de imagen
				move_uploaded_file ( $_FILES [ 'file' ][ 'tmp_name' ], $destino . '/' .$id.'.'.$tipo);  // Subimos el archivo
			}else echo "el tipo de archivo no es de los permitidos";// Si no es el tipo permitido lo desimos
		}else echo "El archivo supera el peso permitido.";// Si supera el tamaño de permitido lo desimos
	  
	}
	
		

	header("Location: eventoX.php?id=".$id);
	
?>