<?php
  require_once __DIR__.'/includes/config.php'; 
  //require_once __DIR__.'/includes/Noticia.php';
	
	$quiz= new \es\ucm\fdi\aw\Quiz();
	$titulo = htmlspecialchars(trim(strip_tags($_POST['titulo'])));
	$descripcion = $_POST['descripcion'];
	$descrParseada = str_replace("'", "''", $descripcion);
	$juego=$_POST['juego'];
	
	if(isset($_SESSION['nombre'])){
		$nick = $_SESSION['nombre'];
	}
	
	$idQuiz = $quiz->guardaContenidoQuiz($titulo,$descrParseada,$nick);
	
	#comprobacion de las preguntas
	for($i = 0; $i < 10; $i++)
	{
		$tituloForm = "pregunta".$i;
		//echo $tituloForm;
		
		if(isset($_POST[$tituloForm]))
		{
			$pregunta = $_POST[$tituloForm];
			
			//var_dump($pregunta);
			
			#comprobacion de las respuestas
			$pos = 0;
			for($j = 0; $j < 4; $j++)
			{
				$tituloForm = "p".$i."opcion".$j;
				
				if(isset($_POST[$tituloForm]) && $_POST[$tituloForm] != "")
				{
					$respuestas[$pos] = $_POST[$tituloForm];
					$pos++;
					//echo "ENTRA";
				}
			}
			
			if(count($respuestas) === 4) //si para esa pregunta hay 4 respuestas rellenadas, todo OK
			{
				/*echo "LA PREGUNTA: ";
				var_dump($pregunta);
				echo " Y LAS RESPUESTAS: ";
				var_dump($respuestas);
				echo "VALOR ";
				var_dump($_POST['respuestap0']);
				break;*/
				$nombre = "respuestap".$i;
				$numCorrecta = $_POST[$nombre] - 1;
				
				$idPregunta = $quiz->guardaPregunta($idQuiz, $pregunta);
				$quiz->guardaRespuestas($idPregunta,$respuestas,$numCorrecta);
			}
			$respuestas = array();
			
			
		}
		
	}
	if($juego!="ninguno"){
		$quiz->guardaJuego($juego,$id);
	}
	
	#controlando imagen
	
	//echo var_dump($_FILES ["file"]["size"]);
	if($_FILES ["file"]["size"]){
						
		$tamano = $_FILES ["file"]["size"]; // Leemos el tamaño del fichero
		$tamano_max="2097152"; // Tamaño maximo permitido
		
		if( $tamano < $tamano_max){ // Comprobamos el tamaño 
			$destino = 'img/Quizs' ; // Carpeta donde se guardara
			$sep=explode('image/',$_FILES["file"]["type"]); // Separamos image/
			$tipo=$sep[1]; // Obtenemos el tipo de imagen que es
			//echo var_dump($_FILES ["file"]["type"]);
			if($tipo == "jpeg"){ // Si el tipo de imagen a subir es el mismo de los permitidos, seguimos. Puedes agregar mas tipos de imagen
				move_uploaded_file ( $_FILES [ 'file' ][ 'tmp_name' ], $destino . '/' .$idQuiz.'.'.$tipo);  // Subimos el archivo
			}else echo "El tipo de archivo no es de los permitidos";// Si no es el tipo permitido lo decimos
		}else echo "El archivo supera el peso permitido.";// Si supera el tamaño de permitido lo decimos
	  
	}
	
		

	header("Location: quizX.php?id=".$idQuiz);
	
?>