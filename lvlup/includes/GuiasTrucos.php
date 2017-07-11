<?php


namespace es\ucm\fdi\aw;

use es\ucm\fdi\aw\Aplicacion as App;

class GuiasTrucos extends Contenido {

	
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
	function __construct9($id, $categoria, $titulo, $autor, $fecha, $texto, $moderado, $publicado, $visitas){
		 parent::__construct($id, $categoria, $titulo, $autor, $fecha, $texto, $moderado, $publicado, $visitas);
	}

	function cargaGuiasRecientes() {
	    $app = App::getSingleton();
	    $conn = $app->conexionBd();

	    $query = sprintf("SELECT * FROM contenido WHERE categoria = 'guia' AND publicado = 1 ORDER BY fecha DESC");
	    $rs = $conn->query($query);
		
     	if (mysqli_num_rows($rs) != 0) {
			$i=1;
	        while($fila = $rs->fetch_assoc()) {		
				
	          	$guias[$i] = $fila;
	          	$guias[$i]['valoracion'] = $this->getPuntuacion($guias[$i]['valoracion'], $guias[$i]['id']);
				$i++;
	        }

	        $rs->free();

      	}else{
			$guias=array();
		}
     	return $guias;
  	}

  	function cargaGuiasPopulares() {
	    $app = App::getSingleton();
	    $conn = $app->conexionBd();

	    $query = sprintf("SELECT * FROM contenido WHERE categoria = 'guia' AND publicado = 1 ORDER BY valoracion DESC");
	    $rs = $conn->query($query);
		//echo print_r($rs);
		//echo mysqli_errno($conn) . ": " . mysqli_error($conn) . "\n";
     	if (mysqli_num_rows($rs) !=0) {
			$i=1;
	        while($fila = $rs->fetch_assoc()) {		
				
	          	$guias[$i] = $fila;
	          	$guias[$i]['valoracion'] = $this->getPuntuacion($guias[$i]['valoracion'], $guias[$i]['id']);
				$i++;
	        }

	        $rs->free();

      	}else{
			$guias=array();
		}
     	return $guias;
  	}

	function cargaGuiasVisitadas() {
	    $app = App::getSingleton();
	    $conn = $app->conexionBd();

	    $query = sprintf("SELECT * FROM contenido WHERE categoria = 'guia' AND publicado = 1 ORDER BY visitas DESC");
	    $rs = $conn->query($query);
		//echo print_r($rs);
		//echo mysqli_errno($conn) . ": " . mysqli_error($conn) . "\n";
     	if (mysqli_num_rows($rs) !=0) {
			$i=1;
	        while($fila = $rs->fetch_assoc()) {		
				
	          	$guias[$i] = $fila;
	          	$guias[$i]['valoracion'] = $this->getPuntuacion($guias[$i]['valoracion'], $guias[$i]['id']);
				$i++;
	        }

	        $rs->free();

      	}else{
			$guias=array();
		}
     	return $guias;
  	}

  	function borrarGuia($id){
		$app = App::getSingleton();
	    $conn = $app->conexionBd();
		$query = sprintf("DELETE FROM contenido WHERE (id='$id')");
		$rs = $conn->query($query);
	}

	function publicarGuia($id){
		$app = App::getSingleton();
	    $conn = $app->conexionBd();
		$query = "UPDATE contenido SET moderado= '1', publicado='1' WHERE id='$id'";
		$rs = $conn->query($query);
		//echo mysqli_errno($conn) . ": " . mysqli_error($conn) . "\n";
	}

	function rechazarGuia($id){
		$app = App::getSingleton();
	    $conn = $app->conexionBd();
		$query = "UPDATE contenido SET moderado= '1', publicado='0' WHERE id='$id'";
		$rs = $conn->query($query);
	}

	function cargaGuia($id){
		$app = App::getSingleton();
	    $conn = $app->conexionBd();
	    $query = sprintf("SELECT * FROM contenido WHERE id = '$id'");
	    $rs = $conn->query($query);
     	if ($rs) { 
     		$fila = $rs->fetch_assoc();
	    	$guia = $fila;
	    	$guia['valoracion'] = $this->getPuntuacion($guia['valoracion'], $guia['id']);
	    	$this->setTitulo($guia["titulo"]);
	    	$this->setTexto($guia["texto"]);
	    	$this->setImagen($guia["imagen_portada"]);
	    	$this->setAutor($guia["autor"]);
	    	$this->setModerado($guia["moderado"]);
	    	$this->setPublicado($guia["publicado"]);
	    	$rs->free();	
	    }

		$query = "UPDATE contenido SET visitas= visitas+1 WHERE id='$id'";
		$res = $conn->query($query);

	    return $guia;
	
	}

	function guardaGuia($tituloForm,$cuerpo,$tags,$nick) {
		
		$titulo = $tituloForm;
		$texto = $cuerpo;
		$categoria= "guia";
		$autor = $nick;
		$moderado = false;
		$publicado = false;
		$visitas =0;
		$valoracion =0;
		$arraytag = explode(",", $tags);
		
		
		$app = App::getSingleton();
	    $conn = $app->conexionBd();
	    $query = "INSERT INTO contenido (categoria,autor,titulo,texto,moderado,publicado,visitas,valoracion) VALUES ('$categoria','$autor','$titulo','$texto','$moderado','$publicado','$visitas','$valoracion')";
	    $rs = $conn->query($query);
		
		if($rs){
			$id = mysqli_insert_id($conn);
			$img = "img/Guias/".$id.".jpeg";
			$query = "UPDATE  contenido SET imagen_portada = '$img' WHERE id='$id'";
			$rs = $conn->query($query);
			
			$query = sprintf("INSERT INTO guia VALUES ('$id')");
			$rs = $conn->query($query);
			foreach ($arraytag as &$valor) {
				$tagParseado = str_replace("'", "''", $valor);
				$query = sprintf("INSERT INTO tags VALUES ('$tagParseado','$id')");
				$rs = $conn->query($query);
			}
		}
		
		return $id;
		
	}

	function editaGuia($tituloForm,$cuerpo,$tags,$id) {
		
		$intid = $id+0;
		$app = App::getSingleton();
	    $conn = $app->conexionBd();		
	    $query = sprintf("SELECT * FROM contenido WHERE id = '$intid'");
	    $rs = $conn->query($query);
		if ($rs) {
	        while($fila = $rs->fetch_assoc()) { 
	          	$guia = $fila;
	        }

	        $rs->free();
      	}
		
		$titulo = $tituloForm;
		$texto =$cuerpo;
		$categoria= "guia";
		$autor = $guia["autor"];
		$moderado = $guia["moderado"];
		$publicado = $guia["publicado"];
		$visitas =$guia["visitas"] +0;
		$valoracion =$guia["valoracion"] + 0;
		
		
		$query = "UPDATE contenido SET titulo= '{$titulo}', moderado= 0, publicado = 0, texto='{$texto}' WHERE id='$intid'";
		$res = $conn->query($query);
      	
		
		$arraytag = explode(",", $tags);
		$query = sprintf("DELETE FROM tags WHERE (id_contenido='$id')");
		$rs = $conn->query($query);
		
		if($rs){
			foreach ($arraytag as &$valor) {
				
				$tagParseado = str_replace("'", "''", $valor);
				$query = sprintf("INSERT INTO tags VALUES ('$tagParseado','$intid')");
				$rs = $conn->query($query);
			}
		}
		
		
	}

	function guardaJuego($juego,$id){
		$juego = str_replace("'", "''", $juego);;
		$app = App::getSingleton();
	    $conn = $app->conexionBd();
	    $query = sprintf("UPDATE contenido SET ficha_juego='$juego' WHERE id='$id' ");
	    $rs = $conn->query($query);
	}

}

?>