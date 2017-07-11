<?php

namespace es\ucm\fdi\aw;

use es\ucm\fdi\aw\Aplicacion as App;

class Busqueda {

	public function __construct() {
		
	}
	function busqueda($palabra){
		$app = App::getSingleton();
	    $conn = $app->conexionBd();
		$palabra = str_replace(" ", "%", $palabra);
	    $query = "SELECT * FROM contenido WHERE publicado=1 AND texto LIKE '%$palabra%' ORDER BY fecha DESC";
	    $rs = $conn->query($query);
		//echo $query;
		if (mysqli_num_rows($rs) !=0) {
			$i=1;
			while($fila = $rs->fetch_assoc()) {		
				
				$buscado[$i] = $fila;
				$i++;
			}

			$rs->free();

		}else{
			$buscado=array();
		}
     	return $buscado;
	}
}

  	?>
	
	