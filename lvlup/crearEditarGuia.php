<?php
  require_once __DIR__.'/includes/config.php'; 
  require_once __DIR__.'/includes/GuiasTrucos.php';
	
	$guia= new \es\ucm\fdi\aw\GuiasTrucos();
	$titulo = htmlspecialchars(trim(strip_tags($_POST['título'])));
	$cuerpo = $_POST['text'];
	$cuerpoParseado = str_replace("'", "''", $cuerpo);
	$tags = $_POST['tags'];
	$opcion=$_POST['opcion'];
	$juego=$_POST['juego'];
	
	
	if(isset($_SESSION['nombre'])){
		$nick = $_SESSION['nombre'];
	}
	

	
	if($opcion === "crear"){
		$id = $guia->guardaGuia($titulo,$cuerpoParseado,$tags,$nick);
	}else{
		$id=$_POST['id'];
		$guia->editaGuia($titulo,$cuerpoParseado,$tags,$id);
	}
		
	if($juego!="ninguno"){
		$guia->guardaJuego($juego,$id);
	}

	//echo var_dump($_FILES ["file"]["size"]);
	if($_FILES ["file"]["size"]){
						
		$tamano = $_FILES ["file"]["size"]; // Leemos el tamaño del fichero
		
		$tamaño_max="2097152"; // Tamaño maximo permitido
		if( $tamano < $tamaño_max){ // Comprovamos el tamaño 
			$destino = 'img/Guias' ; // Carpeta donde se guarda
			$sep=explode('image/',$_FILES["file"]["type"]); // Separamos imagen/
			$tipo=$sep[1]; // Obtenemos el tipo de imagen que es
			//echo var_dump($_FILES ["file"]["type"]);
			if($tipo == "jpeg"){ // Si el tipo de imagen a subir es el mismo de los permitidos, seguimos. Puedes agregar mas tipos de imagen
				move_uploaded_file ( $_FILES [ 'file' ][ 'tmp_name' ], $destino . '/' .$id.'.'.$tipo);  // Subimos el archivo
			}else echo "el tipo de archivo no es de los permitidos";// Si no es el tipo permitido lo desimos
		}else echo "El archivo supera el peso permitido.";// Si supera el tamaño de permitido lo decimos
	  
	}
	
		

	header("Location: guia.php?id=".$id);
	
?>