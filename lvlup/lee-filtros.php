<?php
  require_once __DIR__.'/includes/config.php'; 
  require_once __DIR__.'/includes/Noticia.php';
	
	/*$valoracion = new \es\ucm\fdi\aw\Noticia();
	
	$puntos = $_POST["rating"];
	$id = $_POST["id"];
	$nick = $_POST["nick"];
		
	//echo var_dump($id);
	//echo var_dump($nick);
	
	$valoracion->guardaValoracionContenido($puntos, $id, $nick);
	//$valoracion->registraValoracion($id, $nick);
	header("Location: noticiaX.php?id=".$id."");*/
	
	$noticia= new \es\ucm\fdi\aw\Noticia();
	
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
		//echo "no has marcado ninguna plataforma";
		/*if($opcion === "crear"){
			$id = $noticia->guardaNoticia($titulo,$cuerpoParseado,$tags,$nick);
		}else{
			$id=$_POST['id'];
			$noticia->editaNoticia($titulo,$cuerpoParseado,$tags,$id);
		}*/
	}else{# si ha marcado al menos una
		//echo "has marcado al menos una plataforma";
		
		/*foreach ($plataformas as &$valor) {
				
			$query = sprintf("INSERT INTO plataforma VALUES ('$id','$valor')");
			$rs = $conn->query($query);
		}*/
		
		$noticia->pideNoticiasFiltradas($plataformas);
		
		//$id = $noticia->guardaNoticia($titulo,$cuerpoParseado,$tags,$nick);
		 //$noticia->guardaPlataformas($plataformas,$id);
	}
	
	/* la funcion guardaPlataformas
		
		function guardaPlataformas($plataformas, $id){
		$app = App::getSingleton();
	    $conn = $app->conexionBd();
		foreach ($plataformas as &$valor) {
				
				$query = sprintf("INSERT INTO plataforma VALUES ('$id','$valor')");
				$rs = $conn->query($query);
			}
	}
		
	*/ //la funcion guardaPlataformas
	
	
	
	//header("Location: noticiaX.php?id=".$id);	
?>