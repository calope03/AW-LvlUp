<?php
  require_once __DIR__.'/includes/config.php'; 
  //require_once __DIR__.'/includes/Noticia.php';
  require_once __DIR__.'/includes/Review.php';
	
	//$noticia= new \es\ucm\fdi\aw\Noticia();
	$review= new \es\ucm\fdi\aw\Review();
	$titulo = htmlspecialchars(trim(strip_tags($_POST['titulo'])));
	$cuerpo = $_POST['cuerpo-review'];
	$cuerpoParseado = str_replace("'", "''", $cuerpo);
	$tags = $_POST['etiquetas'];
	$opcion=$_POST['opcion'];
	$juego=$_POST['juego'];
	
	
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
			$id = $review->guardaReview($titulo,$cuerpoParseado,$tags,$nick);
		}else{
			$id=$_POST['id'];
			$review->editaReview($titulo,$cuerpoParseado,$tags,$id);
		}
	}else{# si ha marcado al menos una
		$id = $review->guardaReview($titulo,$cuerpoParseado,$tags,$nick);
		$review->guardaReview($plataformas,$id);
	}	
	if($juego!="ninguno"){
		$review->guardaJuego($juego,$id);
	}
	


	if($_FILES ["file"]["size"])
	{	
		$tamano_img = $_FILES ["file"]["size"]; // Leemos el tamaño del fichero imagen
		$tamaño_max="2097152"; // Tamaño maximo permitido
		
		if($tamano_img < $tamaño_max)
		{ // Comprobamos el tamaño 
			$destino = 'img/Reviews' ; // Carpeta donde se guardara
			$sep=explode('image/',$_FILES["file"]["type"]); // Separamos image/
			$tipoimg=$sep[1]; // Optenemos el tipo de imagen que es
						
			if($tipoimg == "jpeg")
			{ // Si el tipo de imagen y video a subir es el mismo de los permitidos, seguimos. Puedes agregar mas tipos de imagen
				move_uploaded_file ( $_FILES [ 'file' ][ 'tmp_name' ], $destino . '/' .$id.'.'.$tipoimg);  // Subimos el archivo imagen
			}else echo "el tipo de archivo no es de los permitidos";// Si no es el tipo permitido lo desimos
		}
		else echo "El archivo supera el peso permitido.";// Si supera el tamaño de permitido lo desimos
	  
	}
	
	if($_FILES ["videofile"]["size"])
	{	
		$tamano_vid = $_FILES ["videofile"]["size"]; // Leemos el tamaño del fichero video
		$tamaño_max="2097152"; // Tamaño maximo permitido
		
		if($tamano_vid < $tamaño_max)
		{ // Comprobamos el tamaño 
			$destino = 'img/Reviews' ; // Carpeta donde se guardara
			$otrosep=explode('video/',$_FILES["videofile"]["type"]); // Separamos video/
			$tipovid=$otrosep[1]; // Optenemos el tipo de video que es
			
			if($tipovid == "mp4")
			{ // Si el tipo de imagen y video a subir es el mismo de los permitidos, seguimos. Puedes agregar mas tipos de vid
				move_uploaded_file ( $_FILES [ 'videofile' ][ 'tmp_name' ], $destino . '/vr' .$id.'.'.$tipovid);  // Subimos el archivo video
			}else echo "el tipo de archivo no es de los permitidos";// Si no es el tipo permitido lo desimos
		}
		else echo "El archivo supera el peso permitido.";// Si supera el tamaño de permitido lo desimos
	  
	}
		

	header("Location: review.php?id=".$id);
	
?>