<?php
  require_once __DIR__.'/includes/config.php'; 
  require_once __DIR__.'/includes/Ficha.php';
	
	$ficha= new \es\ucm\fdi\aw\Ficha();
	$nombre = htmlspecialchars(trim(strip_tags($_POST['nombre'])));
	$nombre = str_replace("'", "''", $nombre);
	$ano =htmlspecialchars(trim(strip_tags($_POST['año'])));
	$ano=$ano+0;
	$plataformas = htmlspecialchars(trim(strip_tags($_POST['plataformas'])));
	$desarrolladora = htmlspecialchars(trim(strip_tags($_POST['desarrolladora'])));
	$edad=$_POST['edad'];
	$edad=$edad+0;
	$milliseconds = round(microtime(true) * 1000);
	/*echo var_dump($nombre);
	echo var_dump($ano);
	echo var_dump($plataformas);
	echo var_dump($edad);
	echo var_dump($desarrolladora);*/
	$id = $ficha->guardaFicha($nombre,$ano,$plataformas,$edad,$desarrolladora,$milliseconds);



	//echo var_dump($_FILES ["file"]["size"]);
	if($_FILES ["file"]["size"]){
			//echo var_dump("estoy insertando");				
		$tamano = $_FILES ["file"]["size"]; // Leemos el tamaño del fichero
		//echo var_dump($tamano);
		$tamaño_max="2097152"; // Tamaño maximo permitido
		if( $tamano < $tamaño_max){ // Comprovamos el tamaño 
			$destino = 'img/juegos' ; // Carpeta donde se guardata
			$sep=explode('image/',$_FILES["file"]["type"]); // Separamos image/
			$tipo=$sep[1]; // Optenemos el tipo de imagen que es
			//echo var_dump($_FILES ["file"]["type"]);
			//echo var_dump($destino);
			if($tipo == "jpeg"||$tipo == "jpg"){ // Si el tipo de imagen a subir es el mismo de los permitidos, segimos. Puedes agregar mas tipos de imagen
					echo var_dump("estoy insertando");		
					$oki=is_uploaded_file ( $_FILES [ 'file' ][ 'tmp_name' ]); 
				$ok=move_uploaded_file ( $_FILES [ 'file' ][ 'tmp_name' ], $destino . '/' .$milliseconds.'.'.$tipo);  // Subimos el archivo
				echo var_dump($oki);
				echo var_dump($ok);
				echo var_dump(__DIR__);
			}else echo "el tipo de archivo no es de los permitidos";// Si no es el tipo permitido lo desimos
		}else echo "El archivo supera el peso permitido.";// Si supera el tamaño de permitido lo desimos
	  
	}	

	header("Location: sobremi.php");
	
?>