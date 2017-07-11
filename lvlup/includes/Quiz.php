<?php

namespace es\ucm\fdi\aw;

use es\ucm\fdi\aw\Aplicacion as App;



class Quiz extends Contenido {

	private $quizs;
	
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
	

	function guardaContenidoQuiz($titulo,$descrParseada,$nick) {
		
		$categoria= "quiz";
		$autor = $nick;
		$texto = $descrParseada;
		$moderado = false;
		$publicado = false;
		$visitas =0;
		$valoracion =0;
		
		//Cuando se gestionen los usuarios correctamente habra que añadir aqui que el usuario sea el mismo que el que ha iniciado sesion
		
		$app = App::getSingleton();
	    $conn = $app->conexionBd();
	    $query = "INSERT INTO contenido (categoria,autor,titulo,texto,moderado,publicado,visitas,valoracion) VALUES ('$categoria','$autor','$titulo','$texto','$moderado','$publicado','$visitas','$valoracion')";
	    $rs = $conn->query($query);
		
		if($rs){
			$idQuiz = mysqli_insert_id($conn);
			$img = "img/Quizs/".$idQuiz.".jpeg";
			$query = "UPDATE contenido SET imagen_portada = '$img' WHERE id='$idQuiz'";
			$rs = $conn->query($query);
			//echo var_dump($rs);
			//echo mysqli_errno($conn) . ": " . mysqli_error($conn) . "\n";
			$query = sprintf("INSERT INTO quiz VALUES ('$idQuiz')");
			$rs = $conn->query($query);
		}
		
		$query = sprintf("INSERT INTO quiz (id) VALUES ('$idQuiz')");
	    $rs = $conn->query($query);
		
		return $idQuiz;
		
	}
	
	function guardaPregunta($idQuiz, $pregunta)
	{
		$app = App::getSingleton();
	    $conn = $app->conexionBd();
		
		$query = sprintf("INSERT INTO pregunta (idQuiz, texto) VALUES ('$idQuiz','$pregunta')");
		$rs = $conn->query($query);
		
		//echo mysqli_errno($conn) . ": " . mysqli_error($conn) . "\n";
		
		if($rs){
			
			$idPregunta = mysqli_insert_id($conn);
		}
		
		return $idPregunta;
	}
	
	function guardaRespuestas($idPregunta,$respuestas,$numCorrecta)
	{
		$app = App::getSingleton();
	    $conn = $app->conexionBd();
		
		for($i = 0; $i < count($respuestas); $i++)
		{
			if($i === $numCorrecta)
			{
				$query = "INSERT INTO opcion (idPregunta, texto, correcta) VALUES ('$idPregunta','$respuestas[$i]', 1)";
			}
			else
			{
				$query = "INSERT INTO opcion (idPregunta, texto, correcta) VALUES ('$idPregunta','$respuestas[$i]', 0)";
			}
			$rs = $conn->query($query);
		}
		
	}
	
}

?>