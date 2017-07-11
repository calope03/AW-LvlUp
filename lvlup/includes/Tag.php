<?php


namespace es\ucm\fdi\aw;

use es\ucm\fdi\aw\Aplicacion as App;



class Tag {

	private $tag;
	
	/*private $servername = "localhost";
	private $username = "admin";
	private $password = "admin";
	private $dbname = "lvlup";*/
	
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
	//ahora declaro una serie de métodos constructores que aceptan diversos números de parámetros
	/*function __construct9($id, $categoria, $titulo, $autor, $fecha, $texto, $moderado, $publicado, $visitas){
		 parent::__construct($id, $categoria, $titulo, $autor, $fecha, $texto, $moderado, $publicado, $visitas);
	}*/
	
	
	function dameContenidoSegunTag($tag, $categoria) {
	    $app = App::getSingleton();
	    $conn = $app->conexionBd();
		
		
		/*$query = sprintf("SELECT DISTINCT id_contenido 
							FROM tags
							WHERE nombre = '$tag' 
							ORDER BY id_contenido DESC");*/
							
		$query = sprintf("SELECT id, titulo, imagen_portada 
							FROM contenido as c, tags as t
							WHERE t.nombre = '$tag' AND c.id = t.id_contenido AND c.categoria = '$categoria' AND c.publicado = 1 
							ORDER BY c.fecha DESC");
							
		$rs = $conn->query($query);
		
		if (mysqli_num_rows($rs) !=0) {
			$i=0;
			while($fila = $rs->fetch_assoc()) {		
				
				$contenido[$i] = $fila;
				$i++;
			}

			$rs->free();

		}else{
			$contenido=array();
		}
		
     	return $contenido;
  	}
	
	function dameTagsPopulares(){
			
		$app = App::getSingleton();
	    $conn = $app->conexionBd();
	    $query = sprintf
		("SELECT count(id_contenido) as cuenta, nombre
FROM tags, contenido
WHERE publicado = 1 AND id_contenido=id
GROUP BY nombre
ORDER BY cuenta DESC
LIMIT 10");
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
	}
	
}

?>