<?php


namespace es\ucm\fdi\aw;

use es\ucm\fdi\aw\Aplicacion as App;

class Ficha {
	
	public function __construct(){}
	
	function guardaFicha($nombre,$ano,$plataformas,$edad,$desarrolladora,$milliseconds){
		$ruta="img/juegos/".$milliseconds.".jpeg";
		$app = App::getSingleton();
	    $conn = $app->conexionBd();
		$query = sprintf("INSERT INTO ficha_juego VALUES ('$nombre','$plataformas','$desarrolladora','$edad','$ruta','$ano')");
		$rs = $conn->query($query);
		//echo mysqli_errno($conn) . ": " . mysqli_error($conn) . "\n";
	}
	function dameFicha($nombre){
		$nombre = str_replace("'", "''", $nombre);
		$app = App::getSingleton();
		$conn = $app->conexionBd();
		$query = sprintf("SELECT * FROM ficha_juego WHERE nombre='$nombre'");
		$rs = $conn->query($query);
		if ($rs && $rs->num_rows == 1) {
		  $fila = $rs->fetch_assoc();
		  $ficha = $fila;
		  $rs->free();

		  return $ficha;
		}
		return false;
	}
	function comboJuegos(){
		$app = App::getSingleton();
		$conn = $app->conexionBd();
		$query = sprintf("SELECT nombre FROM ficha_juego ORDER BY nombre ASC");
		$rs = $conn->query($query);
		if ($rs->num_rows >= 0) {
			while($fila = $rs->fetch_assoc()) {
				$nombre = str_replace("'", "ʼ", $fila['nombre']);				
				echo "<option value='".$nombre."'> ".$nombre."</option>";
			}
		}
	}
}