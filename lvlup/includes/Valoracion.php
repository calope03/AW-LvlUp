<?php


namespace es\ucm\fdi\aw;

use es\ucm\fdi\aw\Aplicacion as App;

class Valoracion {

	private $valoraciones;
	public function __construct() {
		
		//obtengo un array con los parámetros enviados a la función
		$params = func_get_args();
		//saco el número de parámetros que estoy recibiendo
		$num_params = func_num_args();
		//cada constructor de un número dado de parámtros tendrá un nombre defunción
		//atendiendo al siguiente modelo __construct1() __construct2()...
		$funcion_constructor ='__construct'.$num_params;
		//compruebo si hay un constructor con ese número de parámetros
		if (method_exists($this,$funcion_constructor)) {
			//si existía esa función, la invoco, reenviando los parámetros que recibí en el constructor original
			call_user_func_array(array($this,$funcion_constructor),$params);
		}
	}
	function haValorado($nick, $id){
		$yaValorado = false;
		
		$app = App::getSingleton();
	    $conn = $app->conexionBd();
	    $query = sprintf("SELECT * FROM valoraciones_contenido WHERE id_contenido = '$id' AND nick ='$nick' ");
	    $rs = $conn->query($query);
		
     	if ($rs && $rs->num_rows == 1) { 
		 
	        $rs->free();
			$yaValorado = true;
      	}else{
			$query = sprintf("SELECT * FROM contenido WHERE id= '$id'");
			$res = $conn->query($query);
			while($fila = $res->fetch_assoc()) { 
	          	$autor = $fila;
	        }
			if($autor['autor']==$nick){
				$yaValorado = true;
			}
		}
		
		return $yaValorado;
	}
	function guardaValoracionContenido($puntuacion, $id, $nick, $nick_autor){
		
		$app = App::getSingleton();
	    $conn = $app->conexionBd();
	    $query = sprintf("SELECT valoracion FROM contenido WHERE id = '$id'");
	    $rs = $conn->query($query);
     	if ($rs) {
	        while($fila = $rs->fetch_assoc()) { 
	          	$contenido = $fila;
	        }

	        $rs->free();
      	}
		
		$puntuacion_actualizada = $contenido["valoracion"] + $puntuacion;
		
		$query = sprintf("UPDATE contenido SET valoracion='$puntuacion_actualizada' WHERE id = '$id'");
		$rs = $conn->query($query);
		
		
		
		if($rs){
			$query = sprintf("INSERT INTO valoraciones_contenido (id_contenido, nick) VALUES ('$id', '$nick')");
			
			$rs = $conn->query($query);
			
			/*echo var_dump($rs);
			echo mysqli_errno($conn).": ".mysqli_error($conn)."\n";			
			break;*/
			if($puntuacion==1){
				$puntuacion=1;
			}else if($puntuacion==2){
				$puntuacion=8;
			}else if($puntuacion==3){
				$puntuacion=27;
			}else if($puntuacion==4){
				$puntuacion=64;
			}else if($puntuacion==5){
				$puntuacion=125;
			}
			$this->compruebaNivel($puntuacion,$nick_autor);
			/// llamar a comprobar nivel
		}
		
		
		
	}
	function compruebaNivel($puntuacion,$nick){
		echo $puntuacion;
		
		$app = App::getSingleton();
	    $conn = $app->conexionBd();
		$query = sprintf("SELECT * FROM usuario WHERE nick ='$nick'");
	    $rs = $conn->query($query);
		if ($rs && $rs->num_rows == 1) {
		  $fila = $rs->fetch_assoc();
		  $user = $fila;
		  $rs->free();
		}
		//echo var_dump($user);	
		$query = sprintf("SELECT count(id) AS c FROM contenido WHERE autor = '$nick' AND publicado=1 GROUP BY autor");
	    $rs = $conn->query($query);
		//echo mysqli_errno($conn).": ".mysqli_error($conn)."\n";	
		//echo var_dump($rs);		
		if ($rs && $rs->num_rows == 1) {
		  $fila = $rs->fetch_assoc();
		  //echo var_dump($fila);
		  $cantidad = $fila['c'];
		  echo var_dump($cantidad);
		  $rs->free();
		}
		//echo var_dump($cantidad);
		if($user['rol']=="registrado"){
			if($user['nivel']=="junior"){
				$exp=$puntuacion+$user['experiencia'];
				if($exp>=100){
					$exp=$exp-100;
					$query = sprintf("UPDATE usuario SET experiencia = '$exp',nivel='senior',pend_notificar=1 WHERE nick = '$nick'");			
					$rs = $conn->query($query);
				}else if($exp<0){
					$query = sprintf("UPDATE usuario SET experiencia = 0 WHERE nick = '$nick'");			
					$rs = $conn->query($query);
				}else{
					$query = sprintf("UPDATE usuario SET experiencia = '$exp' WHERE nick = '$nick'");			
					$rs = $conn->query($query);
				}
			}else{
				$exp=$puntuacion+$user['experiencia'];
				if($exp>=200){
					$exp=$exp-200;
					$query = sprintf("UPDATE usuario SET experiencia = '$exp',nivel='junior',rol='escritor',pend_notificar=1 WHERE nick = '$nick'");			
					$rs = $conn->query($query);
				}else if($exp<0){
					$query = sprintf("UPDATE usuario SET experiencia = 0 WHERE nick = '$nick'");			
					$rs = $conn->query($query);
				}else{
					$query = sprintf("UPDATE usuario SET experiencia = '$exp' WHERE nick = '$nick'");			
					$rs = $conn->query($query);
				}
			}
		}else if($user['rol']=="escritor"){
			if($user['nivel']=="junior"){
				$exp=$puntuacion+$user['experiencia'];
				//echo var_dump($exp);
				if($exp>=1250){
					$exp=$exp-1250;
					$query = sprintf("UPDATE usuario SET experiencia = '$exp',nivel='senior',pend_notificar=1 WHERE nick = '$nick'");			
					$rs = $conn->query($query);
					echo mysqli_errno($conn).": ".mysqli_error($conn)."\n";	
				}else if($exp<0){
					$query = sprintf("UPDATE usuario SET experiencia = 0 WHERE nick = '$nick'");			
					$rs = $conn->query($query);
				}else{
					$query = sprintf("UPDATE usuario SET experiencia = '$exp' WHERE nick = '$nick'");			
					$rs = $conn->query($query);
				}
			}else{
				$exp=$puntuacion+$user['experiencia'];
				if($exp>=3000){
					if($cantidad>=40){
						$exp=$exp-3000;
						$query = sprintf("UPDATE usuario SET experiencia = '$exp',nivel='junior',rol='editor',pend_notificar=1 WHERE nick = '$nick'");			
						$rs = $conn->query($query);
					}else{
						$query = sprintf("UPDATE usuario SET experiencia = '$exp'  WHERE nick = '$nick'");			
						$rs = $conn->query($query);
					}
				}else if($exp<0){
					$query = sprintf("UPDATE usuario SET experiencia = 0 WHERE nick = '$nick'");			
					$rs = $conn->query($query);
				}else{
					$query = sprintf("UPDATE usuario SET experiencia = '$exp' WHERE nick = '$nick'");			
					$rs = $conn->query($query);
				}
			}
		}else if($user['rol']=="editor"){
			if($user['nivel']=="junior"){
				$exp=$puntuacion+$user['experiencia'];
				if($exp>=3000){
					$exp=$exp-3000;
					$query = sprintf("UPDATE usuario SET experiencia = '$exp',nivel='senior',pend_notificar=1 WHERE nick = '$nick'");			
					$rs = $conn->query($query);
				}else if($exp<0){
					$query = sprintf("UPDATE usuario SET experiencia = 0 WHERE nick = '$nick'");			
					$rs = $conn->query($query);
				}else{
					$query = sprintf("UPDATE usuario SET experiencia = '$exp' WHERE nick = '$nick'");			
					$rs = $conn->query($query);
				}
			}else{
				$exp=$puntuacion+$user['experiencia'];
				if($exp>=4000){
					if($cantidad>=100){
						$exp=$exp-4000;
						$query = sprintf("UPDATE usuario SET experiencia = '$exp',nivel='junior',rol='administrador',pend_notificar=1 WHERE nick = '$nick'");			
						$rs = $conn->query($query);
					}else{
						$query = sprintf("UPDATE usuario SET experiencia = '$exp'  WHERE nick = '$nick'");			
						$rs = $conn->query($query);
					}
				}else if($exp<0){
					$query = sprintf("UPDATE usuario SET experiencia = 0 WHERE nick = '$nick'");			
					$rs = $conn->query($query);
				}else{
					$query = sprintf("UPDATE usuario SET experiencia = '$exp' WHERE nick = '$nick'");			
					$rs = $conn->query($query);
				}
			}
		}else if($user['rol']=="administrador"){
				$exp=$puntuacion+$user['experiencia'];
				$query = sprintf("UPDATE usuario SET experiencia = '$exp' WHERE nick = '$nick'");			
				$rs = $conn->query($query);
				
			
		}
		
		
		
	}
	function registraValoracion($id, $nick){
		
		$app = App::getSingleton();
	    $conn = $app->conexionBd();
	    $query = sprintf("INSERT INTO valoracion_contenido (id_contenido, nick) VALUES ('$id', '$nick')");
	    $rs = $conn->query($query);
		
     	if ($rs) {
	        while($fila = $rs->fetch_assoc()) { 
	          	$contenido = $fila;
	        }

	        $rs->free();
      	}
		
		$puntuacion_actualizada = $contenido["valoracion"] + $puntuacion;
		
		$query = sprintf("UPDATE contenido SET valoracion='$puntuacion_actualizada' WHERE id = '$id'");
		$rs = $conn->query($query);
		
	}
	function registraValoracionComentario($puntos, $id, $nick, $nick_autor){
		
		$app = App::getSingleton();
	    $conn = $app->conexionBd();
	    $query = sprintf("INSERT INTO valoraciones_comentarios (id_comentario, nick) VALUES ('$id', '$nick')");
	    $rs = $conn->query($query);
		
		//echo mysqli_connect_errno($conn) . ": " . mysqli_error($conn) . "\n";
		
		if($puntos > 0){
			$query = sprintf("UPDATE comentarios SET votos_positivos= votos_positivos + '$puntos' WHERE id = '$id'");
			$rs = $conn->query($query);
		}
		else{
			
			$query = sprintf("UPDATE comentarios SET votos_negativos= votos_negativos + '$puntos' WHERE id = '$id'");
			$rs = $conn->query($query);
			
			
		}
	    
		
		$this->compruebaNivel($puntos,$nick_autor);
		
		
		
		
		
		/*
     	if ($rs) {
	        while($fila = $rs->fetch_assoc()) { 
	          	$contenido = $fila;
	        }

	        $rs->free();
      	}
		
		$puntuacion_actualizada = $contenido["valoracion"] + $puntuacion;
		
		$query = sprintf("UPDATE contenido SET valoracion='$puntuacion_actualizada' WHERE id = '$id'");
		$rs = $conn->query($query);
		
		
		
		if($rs){
			$query = sprintf("INSERT INTO valoraciones_contenido (id_contenido, nick) VALUES ('$id', '$nick')");
			
			$rs = $conn->query($query);
			
		
			
			$query = sprintf("UPDATE usuario SET experiencia = experiencia + '$puntuacion' WHERE nick = '$nick_autor'");
			
			$rs = $conn->query($query);
		}
		*/
		
	}
	
	function haValoradoComentario($nick, $id){
		$yaValorado = false;
		
		$app = App::getSingleton();
	    $conn = $app->conexionBd();
	    $query = sprintf("SELECT * FROM valoraciones_comentarios WHERE id_comentario = '$id' AND nick ='$nick' ");
	    $rs = $conn->query($query);
		
		//echo mysqli_connect_errno($conn) . ": " . mysqli_error($conn) . "\n";
		
     	if ($rs && $rs->num_rows == 1){ 
		//echo "HAVALRADO";
	        $rs->free();
			$yaValorado = true;
      	}
		/*
		else{
			$query = sprintf("SELECT * FROM contenido WHERE id= '$id'");
			$res = $conn->query($query);
			while($fila = $res->fetch_assoc()) { 
	          	$autor = $fila;
	        }
			if($autor['autor']==$nick){
				$yaValorado = true;
			}
		}*/
		
		return $yaValorado;
	}
	
	function muestraVotosComentario($id){
		
		$app = App::getSingleton();
	    $conn = $app->conexionBd();
	    $query = sprintf("SELECT votos_positivos, votos_negativos FROM comentarios WHERE id = '$id'");
	    $rs = $conn->query($query);
		
		while($fila = $rs->fetch_assoc()) { 
	          	$comentario = $fila;
	    }
		
		echo "<em>A favor:</em> ".$comentario['votos_positivos']." puntos - <em>En contra:</em> ".$comentario['votos_negativos']." puntos.";
		
     	/*if ($rs && $rs->num_rows == 1){ 
	        $rs->free();
			$yaValorado = true;
      	}*/
		/*
		else{
			$query = sprintf("SELECT * FROM contenido WHERE id= '$id'");
			$res = $conn->query($query);
			while($fila = $res->fetch_assoc()) { 
	          	$autor = $fila;
	        }
			if($autor['autor']==$nick){
				$yaValorado = true;
			}
		}*/
		
	}
	
	
	/*function dameTagsPopulares(){
			
		$app = App::getSingleton();
	    $conn = $app->conexionBd();
	    $query = sprintf
		("
		SELECT count(id_contenido) as cuenta, nombre
		FROM tags
		GROUP BY nombre
		ORDER BY cuenta DESC
		LIMIT 10
		");
		//hacer top 10 de tags más repetidos, por orden de repeticion
	    $rs = $conn->query($query);
		
		if ($rs && mysqli_num_rows($rs) !=0) {
			
			$i=0;
			while($fila = $rs->fetch_assoc()) {		
				
				$tags[$i] = $fila['nombre'];
				$i++;
			}

			$rs->free();

		}
	
		return $tags;
	}*/
}
?>