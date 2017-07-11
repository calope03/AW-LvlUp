<?php
  require_once __DIR__.'/includes/config.php'; 
  require_once __DIR__.'/includes/Noticia.php';
	
	$noticia= new \es\ucm\fdi\aw\Noticia();
	$titulo = htmlspecialchars(trim(strip_tags($_POST['titulo'])));
	$cuerpo = $_POST['cuerpo-noticia'];
	$cuerpoParseado = str_replace("'", "''", $cuerpo);
	$tags = $_POST['etiquetas'];
	$opcion=$_POST['opcion'];
	$juego=$_POST['juego'];
	$juego= str_replace("ʼ", "'", $juego);
	if(isset($_SESSION['nombre'])){
		$nick = $_SESSION['nombre'];
	}


	#comprobacion de las plataformas
	if(!(empty($_POST['plataforma']))){
		$plataformas=$_POST["plataforma"];
		$count = count($plataformas);
	}
	else{
		$count = 0;
	}

	#si no ha marcado plataformas
	if ($count === 0){
		if($opcion === "crear"){
			$id = $noticia->guardaNoticia($titulo,$cuerpoParseado,$tags,$nick);
		}else{
			$id=$_POST['id'];
			$noticia->editaNoticia($titulo,$cuerpoParseado,$tags,$id);
		}
	}else{# si ha marcado al menos una
		$id = $noticia->guardaNoticia($titulo,$cuerpoParseado,$tags,$nick);
		 $noticia->guardaPlataformas($plataformas,$id);
	}	
	//echo $juego;
	if($juego!="ninguno"){
		$noticia->guardaJuego($juego,$id);
	}
	//echo var_dump($_FILES ["file"]["size"]);
	if($_FILES ["file"]["size"]){
						
		$tamano = $_FILES ["file"]["size"]; // Leemos el tamaño del fichero
		
		$tamaño_max="2097152"; // Tamaño maximo permitido
		if( $tamano < $tamaño_max){ // Comprovamos el tamaño 
			$destino = 'img/Noticias' ; // Carpeta donde se guardata
			$sep=explode('image/',$_FILES["file"]["type"]); // Separamos image/
			$tipo=$sep[1]; // Optenemos el tipo de imagen que es
			//echo var_dump($_FILES ["file"]["type"]);
			if($tipo == "jpeg"){ // Si el tipo de imagen a subir es el mismo de los permitidos, segimos. Puedes agregar mas tipos de imagen
				move_uploaded_file ( $_FILES [ 'file' ][ 'tmp_name' ], $destino . '/' .$id.'.'.$tipo);  // Subimos el archivo
			}else echo "el tipo de archivo no es de los permitidos";// Si no es el tipo permitido lo desimos
		}else echo "El archivo supera el peso permitido.";// Si supera el tamaño de permitido lo desimos
	  
	}
	
		

	header("Location: noticiaX.php?id=".$id);
	
?>