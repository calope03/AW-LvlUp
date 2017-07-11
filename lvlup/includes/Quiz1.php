<?php 

	namespace es\ucm\fdi\aw;

	use es\ucm\fdi\aw\Aplicacion as App;
	
	
	class ListaQuizs{
		public $lista;
		public $contador;
		
		function __construct($tipo){
			$app = App::getSingleton();
			$conn = $app->conexionBd();

			switch($tipo){
				case 1: $order="fecha";break;
				case 2: $order="visitas";break;
				default: $order="fecha";break;
			}
			//cambiar query
			$query = "SELECT c.id, c.titulo, c.autor, c.fecha, c.imagen_portada, c.texto, e.fecha_inicio, e.participantesMaximos, e.numParticipantes
				FROM contenido as c, evento as e WHERE c.categoria = 'evento' AND e.id=c.id AND c.publicado = 1 
				ORDER BY $order DESC";
			
			$rs = $conn->query($query);
			if ($rs) {
			
				$this->contador=0;
				while ($registro = $rs->fetch_assoc()) {
					$quiz = new Quiz();
					$quiz->cargaQuiz($registro);
					$this->lista[] = $quiz;
					$this->contador++;
				}
				$rs->free();
			}
			
			
		}
		
	}
	
	class Quiz extends Contenido{
	
		private $preguntas;
		private $opciones;
		private $imagen;
		private $nPreguntas;


		
		function __construct(){
			$this->id;
			$this->preguntas;
			$this->opciones;
			$this->imagen;
			$this->nPreguntas=0;

		}
		
		public function cargaQuiz($registro){
			parent::__construct($registro['id'], "quiz", $registro['titulo'], $registro['autor'],$registro['fecha'], $registro["texto"], $registro["moderado"], $registro["publicado"], $registro["visitas"]);

			
			$this->cargarPreguntas($this->id);
			 
			$this->cargarOpciones($this->preguntas);
			
		}
		
		public function cargarQuizById($id){
			$app = App::getSingleton();
			$conn = $app->conexionBd();
			
			$query = "SELECT c.id,c.titulo, c.imagen_portada, c.autor, c.fecha, c.texto, c.moderado, c.publicado, c.visitas FROM contenido as c, quiz as q WHERE c.id=$id AND q.id=c.id ";
			
			$rs = $conn->query($query);
			if ($rs) {
				while ($registro = $rs->fetch_assoc()) {
					parent::__construct($registro['id'], "evento", $registro['titulo'], $registro['autor'],$registro['fecha'], $registro["texto"], $registro["moderado"], $registro["publicado"], $registro["visitas"]);
					
					$this->imagen = $registro["imagen_portada"];
			
					$this->cargarPreguntas($this->id);
			 
					$this->cargarOpciones($this->preguntas);
				}
				$rs->free();
			
			}
		}	
		
		public function aumentaVisita($id){
			$app = App::getSingleton();
			$conn = $app->conexionBd();
			
			$query = "UPDATE `contenido` SET `visitas` = `visitas`+1 WHERE id=$id";

			$rs = $conn->query($query);
		}
		
		public function crearQuiz(){
			$app = App::getSingleton();
			$conn = $app->conexionBd();
			
			$query = "";
			return $id;
		}
		
		public function editarQuiz(){
			$app = App::getSingleton();
			$conn = $app->conexionBd();		

			$query = "";
		}
		
		private function cargarPreguntas($id){
			$app = App::getSingleton();
			$conn = $app->conexionBd();
			$query = "SELECT `idPregunta`, `texto` FROM `pregunta` WHERE idQuiz=$id";
			$rs = $conn->query($query);
			if ($rs) {
				while ($registro = $rs->fetch_assoc()) {
				    $this->preguntas[] = array($registro["idPregunta"], $registro["texto"]);
				    $this->nPreguntas++;
				    
			   	}
			   	$rs->free();
			}
			
		}
		
		private function cargarOpciones($preguntas){
			$app = App::getSingleton();
			$conn = $app->conexionBd();
			
			for($c=0; $c<$this->nPreguntas; $c++){
			    $id=$preguntas[$c][0];
		    	$query ="SELECT `texto`, `correcta` FROM `opcion` WHERE idPregunta=$id";
		    	$rs = $conn->query($query);
		    	if ($rs) {
		    		while ($registro = $rs->fetch_assoc()) {
		    		    $this->opciones[]=array($registro["texto"], $registro["correcta"]);
		    		}
		    		$rs->free();
		    	}
			}
			
		
		}
		
		public function getId(){
			echo $this->id;
		}
		
		public function getTitulo(){
			echo $this->titulo;
		}
		
		public function getAutor(){
			echo $this->autor;
		}
		
		public function returnAutor(){
			return $this->autor;
		}
		
		public function getFechaPublicacion(){
			echo $this->fecha;
		}
		
		public function getImagen(){
			echo $this->imagen;
		}
		
		public function getTexto(){
			echo $this->texto;
		}
		
		public function getPregunta($c){
		    echo $this->preguntas[$c][1];
		}
		
		public function getOpcion($c){
		    echo $this->opciones[$c][0];
		}
		
		public function getIsOpcionCorrecta($c){
		    echo $this->opciones[$c][1];
		}
		
		public function returnNPreguntas(){
		    return $this->nPreguntas;
		}
		
		public function isPublicado(){
			return $this->publicado;
		}
		
		
	}
?>
