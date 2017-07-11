<?php


namespace es\ucm\fdi\aw;

use es\ucm\fdi\aw\Aplicacion as App;

class Noticia extends Contenido {

	private $noticias;
	
	/*private $servername = "localhost";
	private $username = "admin";
	private $password = "admin";
	private $dbname = "lvlup";*/
	
	public function __construct(/*$id, $categoria, $titulo, $autor, $fecha, $texto, $moderado, $publicado, $visitas*/) {
		
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
	

	function guardaNoticia($tituloForm,$cuerpo,$tags,$nick) {
		
		$titulo = $tituloForm;
		$texto = $cuerpo;
		$categoria= "noticia";
		$autor = $nick;
		$moderado = false;
		$publicado = false;
		$visitas =0;
		$valoracion =0;
		$arraytag = explode(",", $tags);
		
		//Cuando se gestionen los usuarios correctamente habra que añadir aqui que el usuario sea el mismo que el que ha iniciado sesion
		
		
		$app = App::getSingleton();
	    $conn = $app->conexionBd();
	    $query = "INSERT INTO contenido (categoria,autor,titulo,texto,moderado,publicado,visitas,valoracion) VALUES ('$categoria','$autor','$titulo','$texto','$moderado','$publicado','$visitas','$valoracion')";
	    $rs = $conn->query($query);
		/*echo $titulo;
		echo $texto;
		echo var_dump($rs);*/
		if($rs){
			$id = mysqli_insert_id($conn);
			$img = "img/Noticias/".$id.".jpeg";
			$query = "UPDATE  contenido SET imagen_portada = '$img' WHERE id='$id'";
			$rs = $conn->query($query);
			//echo var_dump($rs);
			//echo mysqli_errno($conn) . ": " . mysqli_error($conn) . "\n";
			$query = sprintf("INSERT INTO noticia VALUES ('$id')");
			$rs = $conn->query($query);
			foreach ($arraytag as &$valor) {
				$tagParseado = str_replace("'", "''", $valor);
				$query = sprintf("INSERT INTO tags VALUES ('$tagParseado','$id')");
				$rs = $conn->query($query);
			}
		}
		
		
		return $id;
		
	}
	/*function guardaPlataformas($plataformas, $id){
		$app = App::getSingleton();
	    $conn = $app->conexionBd();
		foreach ($plataformas as &$valor) {
				
				$query = sprintf("INSERT INTO plataforma VALUES ('$id','$valor')");
				$rs = $conn->query($query);
			}
	}*/
	function editaNoticia($tituloForm,$cuerpo,$tags,$id) {
		
		//Cuando se gestionen los usuarios correctamente habra que añadir aqui que el usuario sea el mismo que el que ha iniciado sesion
			
		$intid = $id+0;
		$app = App::getSingleton();
	    $conn = $app->conexionBd();		
	    $query = sprintf("SELECT * FROM contenido WHERE id = '$intid'");
	    $rs = $conn->query($query);
		if ($rs) {
	        while($fila = $rs->fetch_assoc()) { 
	          	$noticia = $fila;
	        }

	        $rs->free();
      	}
		//echo var_dump($id);
		$titulo = $tituloForm;
		$texto =$cuerpo;
		$categoria= "noticia";
		$autor = $noticia["autor"];
		$moderado = $noticia["moderado"];
		$publicado = $noticia["publicado"];
		$visitas =$noticia["visitas"] +0;
		$valoracion =$noticia["valoracion"] + 0;
		if(($moderado==1)&&($publicado== 0)){
			$moderado=0;
		}
		//echo var_dump($rs);
		//echo var_dump($texto);
		
			$query = "UPDATE contenido SET titulo= '{$titulo}', moderado='{$moderado}', texto='{$texto}' WHERE id='$intid'";
			$res = $conn->query($query);
      	// echo mysqli_errno($conn) . ": " . mysqli_error($conn) . "\n";
		
		//echo var_dump($res);
		/*echo $titulo;
		echo $texto;
		echo var_dump($rs);*/
		
		$arraytag = explode(",", $tags);
		$query = sprintf("DELETE FROM tags WHERE (id_contenido='$id')");
		$rs = $conn->query($query);
		//echo mysqli_errno($conn) . ": " . mysqli_error($conn) . "\n";
		//echo var_dump($rs);
		if($rs){
			foreach ($arraytag as &$valor) {
				
				$tagParseado = str_replace("'", "''", $valor);
				$query = sprintf("INSERT INTO tags VALUES ('$tagParseado','$intid')");
				$rs = $conn->query($query);
			}
		}
		//echo var_dump($rs);
		
	}
	function borrarNoticia($id){
		$app = App::getSingleton();
	    $conn = $app->conexionBd();
		$query = sprintf("DELETE FROM contenido WHERE (id='$id')");
		$rs = $conn->query($query);
	}
	function publicarNoticia($id){
		$app = App::getSingleton();
	    $conn = $app->conexionBd();
		$query = "UPDATE contenido SET moderado= '1', publicado='1' WHERE id='$id'";
		$rs = $conn->query($query);
		//echo mysqli_errno($conn) . ": " . mysqli_error($conn) . "\n";
	}
	function rechazarNoticia($id){
		$app = App::getSingleton();
	    $conn = $app->conexionBd();
		$query = "UPDATE contenido SET moderado= '1', publicado='0' WHERE id='$id'";
		$rs = $conn->query($query);
	}
	function cargaFormNoticia($id){
		require_once 'includes/Ficha.php';
		$ficha= new \es\ucm\fdi\aw\Ficha();
		$app = App::getSingleton();
	    $conn = $app->conexionBd();
	    $query = sprintf("SELECT * FROM contenido WHERE id = '$id'");
	    $rs = $conn->query($query);
     	if ($rs) {
	        while($fila = $rs->fetch_assoc()) { 
	          	$noticia = $fila;
	        }
	        $rs->free();
      	}
		$query = sprintf("SELECT nombre FROM tags WHERE id_contenido = '$id'");
	    $rs = $conn->query($query);
		$tag="";
		if ($rs) {
	        while($fila = $rs->fetch_assoc()) { 
	          	$tag =$tag. $fila["nombre"].",";
	        }
	        $rs->free();
      	}
		/*echo $noticia["texto"];*/
     	$a = $noticia["texto"];
		$aparseado =str_replace("\"", "'", $a);
		echo "<form action='crearEditarNoticia.php' method='post'enctype='multipart/form-data'>
					<fieldset>
					    <legend>Edita tu noticia:</legend>
					    <label>Título</label>
					    <div id='divClear'></div>
						<input type='text' name='titulo' value='".$noticia["titulo"]."' id='titulo' />
						<div id='divClear'></div>
						<label>Juego asociado</label>
						<div id='divClear'></div>
						<select name='juego'>
							<option value='ninguno'> --Selecciona Juego--</option> ";
							$ficha->comboJuegos();
						echo "</select>
						<div id='divClear'></div>
						<label>Foto para la portada:</label>
						<div id='divClear'></div>
						<input type='file' name='file' size='40'>
						<div id='divClear'></div>
						<label>Cuerpo de la noticia</label>
						<div id='divClear'></div>
						<textarea id='cuerpo-noticia' name='cuerpo-noticia' rows='15' cols='90'>".$aparseado."</textarea>						
						<div id='divClear'></div>
						<label>Etiquetas</label>
					    <div id='divClear'></div>
						<input type='text' name='etiquetas' value='".$tag."' id='etiquetas' />
						<div id='divClear'></div>						
						<p>Usa etiquetas claras, descriptivas y concisas separadas por comas.</p>
						<div id='divClear'></div>
						<div id='bloque_botones'>
							<input id='enviar' type='submit' value='Enviar' />
							<input type='button' name='cancelar' value='Cancelar' onClick='location.href='noticias_novedades.php'/>
						</div>
						<input type='hidden' name='opcion' id='opcion' value = 'editar'/>
						<input type='hidden' name='id' id='id' value = '".$id."'/>
				  	</fieldset>
				</form>";
				//echo $html;
	}
	
		
	
	
	function cargaNoticiasPopulares() {
	    $app = App::getSingleton();
	    $conn = $app->conexionBd();

	    $query = sprintf("SELECT * FROM contenido WHERE categoria = 'noticia' AND publicado = 1 ORDER BY valoracion DESC");
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
     	return $noticias;
  	}
	function cargaNoticiasVisitadas() {
	    $app = App::getSingleton();
	    $conn = $app->conexionBd();

	    $query = sprintf("SELECT * FROM contenido WHERE categoria = 'noticia' AND publicado = 1 ORDER BY visitas DESC");
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
     	return $noticias;
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
	
	function cargaNoticia($id, $nick, $url){
		
		$app = App::getSingleton();
	    $conn = $app->conexionBd();
	    $query = sprintf("SELECT * FROM contenido WHERE id = '$id'");
	 	$query2 = sprintf("SELECT * FROM valoraciones_contenido WHERE id_contenido = '$id'");
	    $rs = $conn->query($query);
     	if ($rs) {
	        while($fila = $rs->fetch_assoc()) { 
	          	$noticia = $fila;
	          	$valoraciones = $fila["valoracion"];
	        }

	        $rs->free();
      	}
      	$rs2 = $conn->query($query2);
      	$num_valoraciones = $rs2->num_rows;
      	

      	#calcular valoraciones
      	if($num_valoraciones > 0)
      		$valorMedio = round(($valoraciones/$num_valoraciones), 1, PHP_ROUND_HALF_EVEN);
      	else
      		$valorMedio = 0;
     	
		$year = 0;
		$month = 0;
		$day_time = 0;
		$day = 0;
		
		list($year, $month, $day_time) = explode("-", $noticia["fecha"]);
		list($day) = explode(" ", $day_time);
		
		$titular = "<h1 id = 'titular'>".$noticia["titulo"]."</h1><br />
				<div id='cuerpo'>" ;
				
		$formulario_valoracion_yavalorado = "Valoración media: $valorMedio puntos - ";
		$formulario_valoraciona_anonimo = "Para valorar, inicia sesión o regístrate - ";
		
		$formulario_valoracion_bueno = "<form class='rating' name='5estrellas' action='gestionaValoracion.php' method='post'>
					<input type='radio' id='star1' name='rating' value='1' /><label for='star1' title='Sucks'>1</label>
					<input type='radio' id='star2' name='rating' value='2' /><label for='star2' title='Kinda bad'>2</label>
					<input type='radio' id='star3' name='rating' value='3' /><label for='star3' title='Meh'>3</label>
					<input type='radio' id='star4' name='rating' value='4' /><label for='star4' title='Pretty good'>4</label>
					<input type='radio' id='star5' name='rating' value='5' /><label for='star5' title='Rocks!'>5</label>
					<input type='submit' id='enviar' value = 'Valóralo' >
					<input type='hidden' name='id' id='id' value = '".$id."'>
					<input type='hidden' name='nick' id='nick' value = '".$nick."'>
				    <input type='hidden' name='url' id='nick' value = '".$url."'>
					<input type='hidden' name='nick_autor' id='nick_autor' value = '".$noticia['autor']."'>
				</form>";
				
		$resto_noticia = "Autor: <a href = 'usuario.php?nombre=".$noticia['autor']."'>".$noticia['autor']."</a> - Publicado: ".$day."/".$month."/".$year."
				
				".$noticia["texto"]."</div>";
		$visitas = $noticia['visitas'] +1;
		$query = "UPDATE contenido SET visitas= '$visitas' WHERE id='$id'";
		$res = $conn->query($query);
		//echo $visitas;
		echo $titular;
		//echo $formulario_valoracion_bueno;
		
		if($nick != ""){ //es usuario registrado
			if(!$this->haValorado($id, $nick)){ //NO ha valorado
				echo $formulario_valoracion_bueno;
			}
			else echo $formulario_valoracion_yavalorado; //ya lo ha valorado antes
			
			$rolusuario= $this->compruebaRol($nick);
			if($rolusuario=="administrador"){
				$botones = "<form name='botones' action='' method='post'>					
					<input id = 'boton' type='button' name='editar' value='Editar' onclick = \"location='editar_noticia.php?id=".$id."'\" />";
				if(($noticia["publicado"]==0)&& ($noticia["moderado"]==0) ){
					$botones = $botones."<input id = 'boton' type='button' name='publicar' value='Publicar' onclick = 'publicarcont(".$id.")'/>
					<input id = 'boton' type='button' name='rechazar' value='Rechazar' onclick = 'rechazarcont(".$id.")'/>";
				}
					$botones = $botones .
					"
					<input id = 'boton' type='button' name='eliminar' value='Eliminar' onclick = 'eliminarNoticia(".$id.")'/>
				</form>";
			}elseif($rolusuario=="editor"){
				$botones = "<form name='botones' action='' method='post'>					
					<input id = 'boton' type='button' name='editar' value='Editar' onclick = \"location='editar_noticia.php?id=".$id."'\" />";
				if(($noticia["publicado"]==0)&& ($noticia["moderado"]==0) ){
					$botones = $botones."<input id = 'boton' type='button' name='publicar' value='Publicar' onclick = 'publicarcont(".$id.")'/>
					<input id = 'boton' type='button' name='rechazar' value='Rechazar' onclick = 'rechazarcont(".$id.")'/></form>";
				}
				$botones = $botones .
					"</form>";	
				
			}elseif($rolusuario=="escritor"){
				
				$query = sprintf("SELECT * FROM contenido WHERE id= '$id'");
				$res = $conn->query($query);
				while($fila = $res->fetch_assoc()) { 
					$autor = $fila;
				}
				if($autor['autor']==$nick){
					if(($noticia["publicado"]==1)&& ($noticia["moderado"]==1) ){
						$botones = "<h1 id = 'titular'>Esta noticia ha sido moderada y ha sido publicada</h1>";
					}elseif(($noticia["publicado"]==0)&& ($noticia["moderado"]==1)){
						$botones = "<h1 id = 'titular'>Esta noticia ha sido moderada y ha sido rechazada</h1>";
					}else{
						$botones = "<h1 id = 'titular'>Pendiente de moderacion</h1>";
					}
					$botones = $botones. "
					<form name='botones' action='' method='post'>
					
					<input id = 'boton' type='button' name='editar' value='Editar' onclick = \"location='editar_noticia.php?id=".$id."'\" />
					<input id = 'boton' type='button' name='eliminar' value='Eliminar' onclick = 'eliminarNoticia(".$id.")'/>
					
				</form>";
				}else{
					$botones = "";
				}
			}else{
				$botones = "";
			}
		}
		else echo $formulario_valoraciona_anonimo;
			
		echo $resto_noticia;
		if(isset($botones))
			echo $botones;
	
	}

	function compruebaRol($nick){
		$app = App::getSingleton();
	    $conn = $app->conexionBd();
	    $query = sprintf("SELECT rol FROM usuario WHERE nick = '$nick'");
	    $rs = $conn->query($query);
		if ($rs) {
	        while($fila = $rs->fetch_assoc()) { 
	          	$usuario = $fila;
	        }

	        $rs->free();
      	}
		return $usuario['rol'];
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
	function guardaJuego($juego,$id){
		$juego = str_replace("'", "''", $juego);;
		$app = App::getSingleton();
	    $conn = $app->conexionBd();
	    $query = sprintf("UPDATE contenido SET ficha_juego='$juego' WHERE id='$id' ");
	    $rs = $conn->query($query);
	}
	/*static function prueba(){
		echo "ENTRA A PRUEBA";
	}*/
	function pideNoticiasFiltradas($plataformas)
	{
		echo "<br />Estoy en clase Noticia <br /><br />";
		var_dump($plataformas);
		echo "<br /><br />";
		
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
					$holi[$i] = $fila["idContenido"];
					$i++;
				}
				echo "<br /><br />";
				var_dump($holi);
				echo "<br /><br />";
				//echo $holi["idContenido"];
				$rs->free();
			}
			else $holi=array();
			
		}
		
		$result = array_unique($holi);
		print_r($result);
	
		
	}
	
}

?>