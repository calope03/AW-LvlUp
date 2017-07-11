<?php
require_once 'includes/config.php';
require_once 'includes/Usuario.php';
require_once __DIR__.'/includes/Quiz1.php';

if(!(empty($_GET['id']))){
		$id = $_GET['id'];
	}

$quiz = new \es\ucm\fdi\aw\Quiz();
$quiz->cargarQuizById($id);
if(isset($_SESSION['nombre'])){
	$user = new \es\ucm\fdi\aw\Usuario();
	$usuario123 = $user->dameUsuario($_SESSION['nombre']);
}else{
	$usuario123['rol']="registrado";
}

?>
<!DOCTYPE HTML>
<hmtl>
	<head>
		<title>LVLuP - Quiz</title>
		<link rel = "stylesheet" type = "text/css" href = "css/reset.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/header.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/quiz.css"/>
		<link rel = "stylesheet" type = "text/css" href = "css/sidebar.css" />		
		<link rel = "stylesheet" type = "text/css" href = "css/pie.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/comentarios.css"/>		
		<script defer type="text/javascript" src="js/registro.js"></script>	
		<script defer type="text/javascript" src="js/busquedaAvanzada.js"></script>	
		<script src="js/jquery-1.12.2.min.js"></script>	
		<meta http-equiv="Content-Type" content="text/html; charset= utf-8"/>
		<script>
		function eliminarEvento(id){
			var eliminar=confirm('¿Deseas eliminar este contenido?');
			if (eliminar){
				var pagina= "borrarcontenido.php?id=" + id;
				window.location.href = pagina; //página web a la que te redirecciona si confirmas la eliminación
			}else{
			//Y aquí pon cualquier cosa que quieras que salga si le diste al boton de cancelar
				return false;
			}
		}

		$(document).ready(function(){
			
			$("p.1").click(function(){
				var fallado = false;
				var className = $(this).attr('class');
				var res = className.split(" ");
				for(var c=0; c<res.length; c++){
					if(res[c]=="red"){
						fallado=true;
					}
				}
				if(!fallado){
					$("p."+res[1]).addClass("red");
					$(this).removeClass("red").addClass("green");
					$("h3."+res[1]).text("Acertastes :D");
				}
			});

			$("p.0").click(function(){
				var respondido=false;
				var className = $(this).attr('class');
				var res = className.split(" ");
				for(var c=0; c<res.length; c++){
					if(res[c]=="red"){
						respondido=true;
					}
				}
				if(!respondido){
					$("p."+res[1]).addClass("red");
					$("h3."+res[1]).text("Fallastes D:");
				}
			});

		});

		</script>
	</head>
<body>
	<?php
		require ('views/header.php');
	?>
		
		<!-- === CONTENIDO === -->
		<div id="contenedor">
			
			<?php 
			$login = isset($_SESSION['nombre']) ? $_SESSION['nombre'] : false;
			if($login){
				$nombre=$_SESSION['nombre'];
			}else{
				$nombre="";
			}
			require ('views/menu-derecha.php'); ?>

			<div id="contenido">

				<div class="quizContent">
				
				<?php 
				
				if(!$quiz->isPublicado() AND $nombre!==$quiz->returnAutor() && ($usuario123['rol']!="administrador")&& ($usuario123['rol']!="editor")){?>
					<h1>Este contenido no es accesible</h1>
					
				<?php
				}else {
					$quiz->aumentaVisita($id)?>

					<div class="content">
						
						<img class="imgContent" src="<?php $quiz->getImagen() ?>">

						<div class="descripcion">
							<h1><?php $quiz->getTitulo() ?></h1>
							<div id="descripcionTexto">
								<p><?php $quiz->getTexto() ?></p>								
							</div>
						</div>
						<?php 
						$n=0;
						for($c=0; $c<$quiz->returnNPreguntas(); $c++){ ?>
							<div class="quiz">
								<h1><?php $quiz->getPregunta($c) ?></h1>
								<div>
									<?php for($i=0; $i<4; $i++){ ?>
									<p id="opcion<?php echo $n ?>" class="<?php $quiz->getIsOpcionCorrecta($n) ?> opcionP<?php echo $c ?>" ><?php $quiz->getOpcion($n) ?></p>
									<?php
									$n++;
									} ?>
									<h3 class="opcionP<?php echo $c ?>"><h3>
								</div>	
								
							</div>
						<?php 
						} ?>
						
						<div id="divClear"></div>
						<?php require ('views/comentarios.php'); ?>

					</div>
				<?php 
				}?>
				</div>
				
			</div><!-- FIN Contenido -->		
		
		</div> <!-- FIN Contenedor -->
	<?php require ('views/pie.html'); ?>
	</body>
</html>