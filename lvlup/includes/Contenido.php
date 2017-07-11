<?php
namespace es\ucm\fdi\aw;

use es\ucm\fdi\aw\Aplicacion as App;
class Contenido {

	protected $id;

  	protected $categoria;

  	protected $titulo;

	protected $autor;

	protected $fecha;

	protected $texto;

	protected $moderado;

	protected $publicado;

	protected $visitas;
	
	protected $valoracion;


	public function __construct(/*$id, $categoria, $titulo,$autor, $fecha, $texto, $moderado, $publicado, $visitas*/) {
		/*$this->id = $id;
	    $this->categoria = $categoria;
	    $this->titulo = $titulo;
	    $this->autor = $autor;
	    $this->texto = $texto;
	    $this->moderado = $moderado;
	    $this->fecha = $fecha;
	    $this->publicado = $publicado;
	    $this->visitas = $visitas;*/
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
	function __construct9($id, $categoria, $titulo, $autor, $fecha, $texto, $moderado, $publicado, $visitas){
		$this->id = $id;
	    $this->categoria = $categoria;
	    $this->titulo = $titulo;
	    $this->autor = $autor;
	    $this->texto = $texto;
	    $this->moderado = $moderado;
	    $this->fecha = $fecha;
	    $this->publicado = $publicado;
	    $this->visitas = $visitas;
	}
	function cargaContenidoRecientes($array_plataformas,$categoria) {
	    $app = App::getSingleton();
	    $conn = $app->conexionBd();
		//print_r($array_plataformas);
		$array_resultado = array();
		if (empty($array_plataformas)) {
		
			$query = sprintf("SELECT * FROM contenido WHERE categoria = '$categoria' AND publicado = 1 ORDER BY fecha DESC");
			$rs = $conn->query($query);
			//echo print_r($rs);
			//echo mysqli_errno($conn) . ": " . mysqli_error($conn) . "\n";
			if (mysqli_num_rows($rs) !=0) {
				$i=1;
				while($fila = $rs->fetch_assoc()) {		
					
					$noticias[$i] = $fila;
					$i++;
				}

				$rs->free();

			}else{
				$noticias=array();
			}
			
			$array_resultado = $noticias;
		}
		else{//le llega para filtrar
			$query = sprintf("SELECT * FROM contenido WHERE categoria = '$categoria' AND publicado = 1 ORDER BY fecha DESC");
			$rs = $conn->query($query);
			//echo print_r($rs);
			//echo mysqli_errno($conn) . ": " . mysqli_error($conn) . "\n";
			if (mysqli_num_rows($rs) !=0) {
				$i=1;
				while($fila = $rs->fetch_assoc()) {		
					
					$noticias[$i] = $fila;
					$i++;
				}

				$rs->free();

			}else{
				$noticias=array();
			}
			
			if(!empty($noticias))
			{
				$array_ids_filtrados = $this->pideContenidoFiltradas($array_plataformas,$categoria);
				
				$cant = 1;
				
				for ($i = 1; $i <= count($noticias); $i++) 
				{
					for ($j = 1; $j <= count($array_ids_filtrados); $j++) 
					{
						if($noticias[$i]['id'] == $array_ids_filtrados[$j])
						{
							$array_resultado[$cant] = $noticias[$i];
							$cant++;
						}
					}
				}
			}
		}
		
     	return $array_resultado;
  	}
	
	function cargaContenidoVisitadas($array_plataformas,$categoria) {
	    $app = App::getSingleton();
	    $conn = $app->conexionBd();
		//print_r($array_plataformas);
		$array_resultado = array();
		if (empty($array_plataformas)) {
		
			$query = sprintf("SELECT * FROM contenido WHERE categoria = '$categoria' AND publicado = 1 ORDER BY visitas DESC");
			$rs = $conn->query($query);
			//echo print_r($rs);
			//echo mysqli_errno($conn) . ": " . mysqli_error($conn) . "\n";
			if (mysqli_num_rows($rs) !=0) {
				$i=1;
				while($fila = $rs->fetch_assoc()) {		
					
					$noticias[$i] = $fila;
					$i++;
				}

				$rs->free();

			}else{
				$noticias=array();
			}
			
			$array_resultado = $noticias;
		}
		else{//le llega para filtrar
			$query = sprintf("SELECT * FROM contenido WHERE categoria = '$categoria' AND publicado = 1 ORDER BY visitas DESC");
			$rs = $conn->query($query);
			//echo print_r($rs);
			//echo mysqli_errno($conn) . ": " . mysqli_error($conn) . "\n";
			if (mysqli_num_rows($rs) !=0) {
				$i=1;
				while($fila = $rs->fetch_assoc()) {		
					
					$noticias[$i] = $fila;
					$i++;
				}

				$rs->free();

			}else{
				$noticias=array();
			}
			
			if(!empty($noticias))
			{
				$array_ids_filtrados = $this->pideContenidoFiltradas($array_plataformas,$categoria);
				
				$cant = 1;
				
				for ($i = 1; $i <= count($noticias); $i++) 
				{
					for ($j = 1; $j <= count($array_ids_filtrados); $j++) 
					{
						if($noticias[$i]['id'] == $array_ids_filtrados[$j])
						{
							$array_resultado[$cant] = $noticias[$i];
							$cant++;
						}
					}
				}
			}
		}
		
     	return $array_resultado;
  	}
	
	function cargaContenidoPopulares($array_plataformas,$categoria) {
	    $app = App::getSingleton();
	    $conn = $app->conexionBd();
		//print_r($array_plataformas);
		$array_resultado = array();
		if (empty($array_plataformas)) {
		
			$query = sprintf("SELECT * FROM contenido WHERE categoria = '$categoria' AND publicado = 1 ORDER BY valoracion DESC");
			$rs = $conn->query($query);
			//echo print_r($rs);
			//echo mysqli_errno($conn) . ": " . mysqli_error($conn) . "\n";
			if (mysqli_num_rows($rs) !=0) {
				$i=1;
				while($fila = $rs->fetch_assoc()) {		
					
					$noticias[$i] = $fila;
					$i++;
				}

				$rs->free();

			}else{
				$noticias=array();
			}
			
			$array_resultado = $noticias;
		}
		else{//le llega para filtrar
			$query = sprintf("SELECT * FROM contenido WHERE categoria = '$categoria' AND publicado = 1 ORDER BY valoracion DESC");
			$rs = $conn->query($query);
			//echo print_r($rs);
			//echo mysqli_errno($conn) . ": " . mysqli_error($conn) . "\n";
			if (mysqli_num_rows($rs) !=0) {
				$i=1;
				while($fila = $rs->fetch_assoc()) {		
					
					$noticias[$i] = $fila;
					$i++;
				}

				$rs->free();

			}else{
				$noticias=array();
			}
			
			if(!empty($noticias))
			{
				$array_ids_filtrados = $this->pideContenidoFiltradas($array_plataformas,$categoria);
				
				$cant = 1;
				
				for ($i = 1; $i <= count($noticias); $i++) 
				{
					for ($j = 1; $j <= count($array_ids_filtrados); $j++) 
					{
						if($noticias[$i]['id'] == $array_ids_filtrados[$j])
						{
							$array_resultado[$cant] = $noticias[$i];
							$cant++;
						}
					}
				}
			}
		}
     	return $array_resultado;
  	}
	
	function pideContenidoFiltradas($plataformas,$categoria)
	{
		//echo "<br />Estoy en clase Noticia <br /><br />";
		//var_dump($plataformas);
		//echo "<br /><br />";
		$app = App::getSingleton();
	    $conn = $app->conexionBd();
		$i = 1;
		foreach ($plataformas as &$valor) 
		{		
			$query = sprintf("SELECT idContenido FROM plataforma WHERE plataforma = '$valor'");
			$rs = $conn->query($query);
			if(mysqli_num_rows($rs) != 0)
			{
				while($fila = $rs->fetch_assoc())
				{
					$obtencion[$i] = $fila["idContenido"];
					$i++;
				}
				//echo "<br /><br />";
				//var_dump($holi);
				//echo "<br /><br />";
				//echo $holi["idContenido"];
				$rs->free();
			}
			else $obtencion=array();
		}
		$resultado = array_unique($obtencion);
		return $resultado;
	}
	function borrarContenido($id){
		$app = App::getSingleton();
	    $conn = $app->conexionBd();
		$query = sprintf("DELETE FROM contenido WHERE (id='$id')");
		$rs = $conn->query($query);
	}
	function publicarContenido($id){
		$app = App::getSingleton();
	    $conn = $app->conexionBd();
		$query = "UPDATE contenido SET moderado= 1, publicado=1 WHERE id='$id'";
		$rs = $conn->query($query);
		echo mysqli_errno($conn) . ": " . mysqli_error($conn) . "\n";
	}
	function rechazarContenido($id){
		$app = App::getSingleton();
	    $conn = $app->conexionBd();
		$query = "UPDATE contenido SET moderado= '1', publicado='0' WHERE id='$id'";
		$rs = $conn->query($query);
	}
	function cargaModeradas($nick,$categoria) {
	    $app = App::getSingleton();
	    $conn = $app->conexionBd();
		if($categoria!=""){
			 $query = sprintf("SELECT * FROM contenido WHERE categoria = '$categoria' AND moderado = 1 AND autor = '$nick' ORDER BY fecha DESC");
		}else{
			$query = sprintf("SELECT * FROM contenido WHERE moderado = 1 AND autor = '$nick' ORDER BY fecha DESC");
		}	   
	    $rs = $conn->query($query);
		//echo var_dump($rs);
		//echo print_r($rs);
		//echo mysqli_errno($conn) . ": " . mysqli_error($conn) . "\n";
     	if (mysqli_num_rows($rs) !=0) {
			$i=1;
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
	function cargaNoModeradas($nick,$categoria) {
	    $app = App::getSingleton();
	    $conn = $app->conexionBd();
		if($categoria!=""){
			 $query = sprintf("SELECT * FROM contenido WHERE categoria = '$categoria' AND moderado=0 AND autor = '$nick' ORDER BY fecha DESC");
		}else{
			//echo var_dump($categoria);
			$query = sprintf("SELECT * FROM contenido WHERE moderado=0 AND autor = '$nick' ORDER BY fecha DESC");
			//$query = sprintf("SELECT * FROM contenido WHERE id=87");
		}	   
	    $rs = $conn->query($query);
		//echo var_dump($rs);
		//echo print_r($rs);
		//echo mysqli_errno($conn) . ": " . mysqli_error($conn) . "\n";
     	if (mysqli_num_rows($rs) !=0) {
			$i=1;
	        while($fila = $rs->fetch_assoc()) {		
				
	          	$contenido[$i] = $fila;
				$i++;
	        }

	        $rs->free();

      	}else{
			$contenido=array();
		}
		//echo var_dump($contenido);
     	return $contenido;
  	}
	function noModeradas($nick,$categoria) {
	    $app = App::getSingleton();
	    $conn = $app->conexionBd();
		if($categoria!=""){
			 $query = sprintf("SELECT * FROM contenido WHERE categoria = '$categoria' AND moderado=0 ORDER BY fecha DESC");
		}else{
			//echo var_dump($categoria);
			$query = sprintf("SELECT * FROM contenido WHERE moderado=0 ORDER BY fecha DESC");
			//$query = sprintf("SELECT * FROM contenido WHERE id=87");
		}	   
	    $rs = $conn->query($query);
		//echo var_dump($rs);
		//echo print_r($rs);
		//echo mysqli_errno($conn) . ": " . mysqli_error($conn) . "\n";
     	if (mysqli_num_rows($rs) !=0) {
			$i=1;
	        while($fila = $rs->fetch_assoc()) {		
				
	          	$contenido[$i] = $fila;
				$i++;
	        }

	        $rs->free();

      	}else{
			$contenido=array();
		}
		//echo var_dump($contenido);
     	return $contenido;
  	}
	function dameContenido($id){
		$app = App::getSingleton();
		$conn = $app->conexionBd();
		$query = sprintf("SELECT * FROM contenido WHERE id='$id'");
		$rs = $conn->query($query);
		if ($rs && $rs->num_rows == 1) {
		  $fila = $rs->fetch_assoc();
		  $cont = $fila;
		  $rs->free();

		  return $cont;
		}
		return false;
	}
	
	
	function guardaPlataformas($plataformas, $id){
		$app = App::getSingleton();
	    $conn = $app->conexionBd();
		foreach ($plataformas as &$valor) {
				
				$query = sprintf("INSERT INTO plataforma VALUES ('$id','$valor')");
				$rs = $conn->query($query);
			}
	}

	function haValorado($id, $nick){
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

	function guardaValoracionContenido($puntuacion, $id, $nick){
		
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

	public function setTitulo($titulo){
		$this->titulo = $titulo;
	}

	public function getTitulo(){
		return $this->titulo;
	}

	public function setTexto($texto){
		$this->texto = $texto;
	}

	public function setAutor($autor){
		$this->autor = $autor;
	}

	public function getAutor(){
		return $this->autor;
	}

	public function getTexto(){
		return $this->texto;
	}

	public function getPuntuacion($val, $id){
		$app = App::getSingleton();
	    $conn = $app->conexionBd();
	    $query2 = sprintf("SELECT * FROM valoraciones_contenido WHERE id_contenido = '$id'");
	    $rs2 = $conn->query($query2);
      	$num_valoraciones = $rs2->num_rows;
      	

      	#calcular valoraciones
      	if($num_valoraciones > 0)
      		$valorMedio = round(($val/$num_valoraciones), 1, PHP_ROUND_HALF_EVEN);
      	else
      		$valorMedio = 0;

      	$this->valoracion = $valorMedio;
      	return $valorMedio;

	}

	public function getValoracion(){
		return $this->valoracion;
	}

	public function setImagen($imagen){
		$this->imagen = $imagen;
	}

	public function getImagen(){
		return $this->imagen;
	}

	public function getPublicado(){
		return $this->publicado;
	}

	public function getModerado(){
		return $this->moderado;
	}

	public function setPublicado($publicado){
		$this->publicado = $publicado;
	}

	public function setModerado($moderado){
		$this->moderado = $moderado;
	}


}
?>
