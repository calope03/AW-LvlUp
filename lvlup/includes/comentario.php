<?php 

	namespace es\ucm\fdi\aw;

	use es\ucm\fdi\aw\Aplicacion as App;
	
	
	class Lista{
		public $lista;
		public $contador;
		
		function __construct($id){
			$app = App::getSingleton();
			$conn = $app->conexionBd();
		
			$query = "SELECT c.id, c.autor, c.texto, c.fecha_publicacion, c.votos_positivos, c.votos_negativos, u.ruta_avatar
			FROM comentarios c, usuario u WHERE c.id_contenido = '$id' AND u.nick= c.autor 
			ORDER BY c.id";
			
			$rs = $conn->query($query);
			if ($rs) {
				$this->contador=0;
				while ($registro = $rs->fetch_assoc()) {
					$comentario = new Comentario();
					$comentario->cargarComentario($registro);
					$this->lista[] = $comentario;
					$this->contador++;
				}
			}
			$rs->free();
			
		}
		
		public function getLista(){
			return $this->lista;
		}
		
		public function getContador(){
			echo $contador;
		}
	}
	
	class Comentario{
		private $id;
		private $autor;
		private $texto;
		private $fecha;
		private $positivos;
		private $negativos;
		private $avatar;
		private $id_contenido;
		
		function __construct(){
			$this->id;
			$this->autor;
			$this->texto;
			$this->fecha;
			$this->positivos;
			$this->negativos;
			$this->avatar;
			$this->id_contenido;
		}
		
		public function guardarNuevoComentario($autor, $texto, $id_contenido){
			$app = App::getSingleton();
			$conn = $app->conexionBd();
			$query = sprintf("INSERT INTO comentarios (autor, texto, id_contenido) VALUES ('$autor', '$texto', '$id_contenido')");
			$rs = $conn->query($query);
			//$rs->free();
		}
		
		public function cargarComentario($registro){
			$this->id = $registro['id'];
			$this->autor = $registro['autor'];
			$this->texto = $registro['texto'];
			$this->fecha = $registro['fecha_publicacion'];
			$this->positivos = $registro['votos_positivos'];
			$this->negativos = $registro['votos_negativos'];
			$this->avatar = $registro['ruta_avatar'];
		}
		
		public function guardarComentario(){
			$app = App::getSingleton();
			$conn = $app->conexionBd();
			
			$sql = "INSERT INTO comentarios (autor, texto, id_contenido, votos_positivos, votos_negativos) 
			VALUES ($this->autor, $this->texto, $this->id_contenido, $this->positivos, $this->negativos)";
			
			$rs = $conn->query($query);
			if ($rs) {
				
			}
			$rs->free();
		}
		
		public function cambiarPuntuacion($id){
			if($tipo){
				$sql = "UPDATE comentarios SET votos_positivos=votos_positivos+1 WHERE id=$this->id";
			}
			else{
				$sql = "UPDATE comentarios SET votos_negativos=votos_negativos+1 WHERE id=$this->id";
			}
		}
		
		public function getId(){
			echo $this->id;
		}
		
		public function devuelveId(){
			return $this->id;
		}
		
		public function getAutor(){
			echo $this->autor;
		}
		
		public function devuelveAutor(){
			return $this->autor;
		}
		
		public function getTexto(){
			echo $this->texto;
		}
		
		public function getFecha(){
			echo $this->fecha;
		}
		
		public function getAvatar(){
			echo $this->avatar;
		}
		
		public function getPositivos(){
			echo $this->positivos;
		}
		
		public function getNegativos(){
			echo $this->negativos;
		}
		
		public function getIdContenido(){
			echo $this->id_contenido;
		}
	}
?>
