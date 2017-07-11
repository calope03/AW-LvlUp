<?php 

	namespace es\ucm\fdi\aw;

	use es\ucm\fdi\aw\Aplicacion as App;
	
	
	class ListaEventos{
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
			
			$query = "SELECT c.id, c.titulo, c.autor, c.fecha, c.imagen_portada, c.texto, c.moderado, c.publicado, c.visitas, e.fecha_inicio, e.participantesMaximos, e.numParticipantes
				FROM contenido as c, evento as e WHERE c.categoria = 'evento' AND e.id=c.id AND c.publicado = 1 
				ORDER BY $order DESC";
			
			$rs = $conn->query($query);
			if ($rs) {
			
				$this->contador=0;
				while ($registro = $rs->fetch_assoc()) {
					$evento = new Evento();
					$evento->cargaEvento($registro);
					$this->lista[] = $evento;
					$this->contador++;
				}
				$rs->free();
			}
			
			
		}
		
	}
	
	class Evento extends Contenido{
	
		private $fechaEvento;
		private $fechaFin;
		private $descripcion;
		private $imagen;
		private $plataformas;
		private $equipo1;
		private $equipo2;
		private $n1;
		private $n2;
		public $numParticipantes;
		public $participantesActuales;
		
		function __construct(){
			$this->fechaEvento;
			$this->fechaFin;
			$this->numParticipantes;
			$this->participantesActuales;
			$this->descripcion;
			$this->imagen;
			$this->plataformas;
			$this->equipo1;
			$this->equipo2;
			$this->n1 = 0;
			$this->n2 = 0;
		}
		
		public function cargaEvento($registro){
			parent::__construct($registro['id'], "evento", $registro['titulo'], $registro['autor'],$registro['fecha'], $registro["texto"], $registro['moderado'], $registro['publicado'], $registro['visitas']);

			$app = App::getSingleton();
			$conn = $app->conexionBd();
			
			$this->fechaEvento = $registro['fecha_inicio'];
			$this->numParticipantes = $registro['participantesMaximos'];
			$this->participantesActuales = $registro['numParticipantes'];
			$this->imagen = $registro['imagen_portada'];
			
			$this->cargarPlataformas($this->id);
			 
			$this->cargarParticipantes($this->id);
			
		}
		
		public function cargarEventoById($id){
			$app = App::getSingleton();
			$conn = $app->conexionBd();
			
			$query = "SELECT c.id, c.titulo, c.autor, c.fecha, c.imagen_portada, c.texto, c.publicado, c.visitas ,e.fecha_fin, e.fecha_inicio, e.participantesMaximos, e.numParticipantes
				FROM contenido as c, evento as e WHERE c.id=$id AND e.id=c.id ";
			$rs = $conn->query($query);
			if ($rs) {
				while ($registro = $rs->fetch_assoc()) {
					parent::__construct($registro['id'], "evento", $registro['titulo'], $registro['autor'],$registro['fecha'], $registro["texto"], $registro['moderado'], $registro['publicado'], $registro['visitas']);
					$this->fechaEvento = $registro['fecha_inicio'];
					$this->fechaFin = $registro['fecha_fin'];
					$this->numParticipantes = $registro["participantesMaximos"];
					$this->participantesActuales = $registro["numParticipantes"];
					$this->imagen = $registro["imagen_portada"];
				}
				$rs->free();
				$this->cargarPlataformas($id);
				$this->cargarParticipantes($id);
			
			}
		}

		public function aumentaVisita($id){
			$app = App::getSingleton();
			$conn = $app->conexionBd();
			
			$query = "UPDATE `contenido` SET `visitas` = `visitas`+1 WHERE id=$id";

			$rs = $conn->query($query);
		}

		public function anyadirParticipante($id, $nick, $equipo){
			$app = App::getSingleton();
			$conn = $app->conexionBd();
			
			$query = "INSERT INTO `participantes_evento`(`nick_usuario`, `idEvento`, `Equipo`) VALUES ('$nick',$id,$equipo)";
			
			$rs = $conn->query($query);

			$query = "UPDATE `evento` SET `numParticipantes` = `numParticipantes`+1 WHERE id=$id";

			$rs = $conn->query($query);
			
		}
		
		public function eliminarParticipante($id, $nick){
			$app = App::getSingleton();
			$conn = $app->conexionBd();
			
			$query = "DELETE FROM `participantes_evento` WHERE nick_usuario='$nick' AND idEvento=$id";
			
			$rs = $conn->query($query);

			$query = "UPDATE `evento` SET `numParticipantes` = `numParticipantes`-1 WHERE id=$id";

			$rs = $conn->query($query);
			
		}
		
		public function crearEvento($titulo, $texto, $autor, $participantes, $fechaIni, $fechaFin, $plataforma){
			$app = App::getSingleton();
			$conn = $app->conexionBd();
			
			$query = "INSERT INTO `contenido`(`categoria`, `titulo`, `autor`, `texto`, `moderado`, `publicado`)
			VALUES ('evento', '$titulo', '$autor', '$texto', 0,0)";
			
			echo $query;
			
			$rs = $conn->query($query);
			
			if($rs){
			$id = mysqli_insert_id($conn);
			$img = "img/Eventos/".$id.".jpeg";
			
			$query = "UPDATE  contenido SET imagen_portada = '$img' WHERE id='$id'";
			
			$rs = $conn->query($query);
			
			$query = sprintf("INSERT INTO `evento`(`id`, `fecha_inicio`, `fecha_fin`, `participantesMaximos`) VALUES ('$id', '$fechaIni', '$fechaFin', '$participantes')");
			
			$rs = $conn->query($query);
			
			$query = sprintf("INSERT INTO `plataforma`(`idContenido`, `plataforma`) VALUES ('$id', '$plataforma')");
			
			$rs = $conn->query($query);
			
			}
			
			return $id;
		}
		
		public function editarEvento($id, $titulo, $texto, $participantes, $fechaIni, $fechaFin, $plataforma){
			//Cuando se gestionen los usuarios correctamente habra que añadir aqui que el usuario sea el mismo que el que ha iniciado sesion
				
			
			$app = App::getSingleton();
			$conn = $app->conexionBd();		
			$query = sprintf("SELECT * FROM contenido WHERE id = '$intid'");
			$rs = $conn->query($query);
			if ($rs) {
				while($fila = $rs->fetch_assoc()) { 
					$evento = $fila;
				}

				$rs->free();
			}
			$moderado = $evento["moderado"];
			$publicado = $evento["publicado"];
			if(($moderado==1)&&($publicado== 0)){
			$moderado=0;
			}
			
			
			$query = "UPDATE contenido SET titulo= '{$titulo}', texto='{$texto}',moderado='{$moderado}'WHERE id=$id";
			
			$rs = $conn->query($query);

			if($rs){
				$query = "UPDATE evento SET fecha_inicio= '{$fechaIni}', fecha_fin='{$fechaFin}', participantesMaximos='{$participantes}' 
				WHERE id=$id";
				$rs = $conn->query($query);
				$query = "UPDATE plataforma SET plataforma='{$plataforma}' WHERE idContenido=$id";
				$rs = $conn->query($query);
			}
			
		
		}
		
		private function cargarParticipantes($id){
			$app = App::getSingleton();
			$conn = $app->conexionBd();
			$query = "SELECT nick_usuario, equipo FROM participantes_evento as p WHERE p.idEvento=$id";
			$rs = $conn->query($query);
			if($rs){
				while ($registro = $rs->fetch_assoc()) {
					if($registro["equipo"]=="1"){
						$this->equipo1[]=$registro["nick_usuario"];
						$this->n1++;
					}else if($registro["equipo"]=="2"){
						$this->equipo2[]=$registro["nick_usuario"];
						$this->n2++;
					}
				}
				
			$rs->free();
			}
		}
		
		private function cargarPlataformas($id){
			$app = App::getSingleton();
			$conn = $app->conexionBd();
			$query ="SELECT plataforma FROM plataforma WHERE idContenido =$id";
			$rs = $conn->query($query);
			
			if ($rs) {
				
				while ($registro = $rs->fetch_assoc()) { 
					
					$this->plataformas = $registro["plataforma"];
				}
				$rs->free();
			}
		}
		
		public function estaRegistrado($nick){
			$registrado = false;
			if(!is_null ( $this->equipo1 )){
				if(in_array($nick , $this->equipo1)){
					$registrado = true;
				}
			}
			if(!is_null($this->equipo2)){
				if(in_array($nick , $this->equipo2)){
				$registrado = true;
				}
			}
			return $registrado;
		}		
		

		
		public function getId(){
			echo $this->id;
		}
		
		public function getFechaEvento(){
			echo $this->fechaEvento;
		}
		
		public function getFechaEventoFin(){
			echo $this->fechaFin;
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
		
		public function getPlataformas(){
			echo $this->plataformas;
		}
		
		public function getMaxParticipantes(){
			echo $this->numParticipantes;
		}
		
		public function getParticipantesAct(){
			echo $this->participantesActuales;
		}	
		
		public function getParticipante1($c){
			echo $this->equipo1[$c];
		}
		
		public function getParticipante2($c){
			echo $this->equipo2[$c];
		}
		
		public function getContador1(){
			return $this->n1;
		}	
		
		public function getContador2(){
			return $this->n2;
		}
		
		public function isPublicado(){
			return $this->publicado;
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
