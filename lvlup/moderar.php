<?php
require_once 'includes/config.php';
require_once 'includes/Contenido.php';
//require_once 'includes/Usuario.php';
$contenido= new \es\ucm\fdi\aw\Contenido();
$user= new \es\ucm\fdi\aw\Usuario();
if(isset($_GET['categoria'])){
	$categoria=$_GET['categoria'];
}else{
	$categoria="";
}
if(isset($_SESSION['nombre'])){
	$nick=$_SESSION['nombre'];
	//$usuariox =$user->dameUsuario($nick);
}else{
	$nick="";
}
?>
<!DOCTYPE HTML>
<hmtl>
	<head>
		<title> LVLuP </title>
		<link rel = "stylesheet" type = "text/css" href = "css/reset.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/miPerfil.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/editar-articulos.css"/>	
		<link rel = "stylesheet" type = "text/css" href = "css/sidebar.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/pie.css" />
		<script defer type="text/javascript" src="js/registro.js"></script>	
		<script defer type="text/javascript" src="js/busquedaAvanzada.js"></script>	
		<script src="js/jquery-1.12.2.min.js"></script>	
		<meta http-equiv="Content-Type" content="text/html; charset= utf-8"/>
	</head>
	
<body>
	<?php require ('views/miPerfil.php'); ?>
	<div id="divClear"></div>
		<!-- === CONTENIDO === -->
	<div id="contenido">
	<?php
	switch ($categoria) {
		case "noticia":
			$arraycont=$contenido->noModeradas($nick,$categoria);		
			$count =count($arraycont);
			for($i =1; $i <= $count; $i++) {
				$img = $arraycont[$i]['imagen_portada'];
				$id = $arraycont[$i]['id'];
				$titulo = $arraycont[$i]['titulo'];
				$autor = $arraycont[$i]['autor'];
				$fecha = $arraycont[$i]['fecha'];
				$visitas = $arraycont[$i]['visitas'];
				$valoracion = $arraycont[$i]['valoracion'];
				list($year, $month, $day_time) = explode("-", $fecha);
				list($day) = explode(" ", $day_time);
				echo "	<div class = 'articulo'>	
						
						<img id = 'imagen' src='".$img."'>
						
						<div id = 'contenido-articulo'>
							<h1><a href='noticiaX.php?id=".$id."'>".$titulo."</a></h1>
							<div id = 'datos-articulo'>
								<a id= 'usuario' href='usuario.php?nombre=$autor'>".$autor."</a>
								<p id ='fecha'>".$day."/".$month."/".$year."</p>
								<a id= 'enlaces' href='publicarcontenido.php?id=".$id."'>Publicar</a>
								<a id= 'enlaces' href='rechazarcontenido.php?id=".$id."'>Rechazar</a>
								<a id= 'enlaces' href='editar_noticia.php?id=".$id."'>Editar</a>";
								if($user['rol']=="administrador"){
									echo "<a id= 'enlaces' href='borrarcontenido.php?id=".$id."'>Eliminar</a>";
								}
								echo"
								<div id='divClear'></div>
							</div>
							<div id='divClear'></div>
						</div>
						<div id='divClear'></div>
						</div>";
						
			}
			break;
			
		case "review":
			$arraycont=$contenido->noModeradas($nick,$categoria);		
			$count =count($arraycont);
			for($i =1; $i <= $count; $i++) {
				$img = $arraycont[$i]['imagen_portada'];
				$id = $arraycont[$i]['id'];
				$titulo = $arraycont[$i]['titulo'];
				$autor = $arraycont[$i]['autor'];
				$fecha = $arraycont[$i]['fecha'];
				$visitas = $arraycont[$i]['visitas'];
				$valoracion = $arraycont[$i]['valoracion'];
				list($year, $month, $day_time) = explode("-", $fecha);
				list($day) = explode(" ", $day_time);
				echo "	<div class = 'articulo'>	
						
						<img id = 'imagen' src='".$img."'>
						
						<div id = 'contenido-articulo'>
							<h1><a href='review.php?id=".$id."'>".$titulo."</a></h1>
							<div id = 'datos-articulo'>
								<a id= 'usuario' href='usuario.php?nombre=$autor'>".$autor."</a>
								<p id ='fecha'>".$day."/".$month."/".$year."</p>
								<a id= 'enlaces' href='publicarcontenido.php?id=".$id."'>Publicar</a>
								<a id= 'enlaces' href='rechazarcontenido.php?id=".$id."'>Rechazar</a>
								<a id= 'enlaces' href='editar-review.php?id=".$id."'>Editar</a>";
								if($user['rol']=="administrador"){
									echo "<a id= 'enlaces' href='borrarcontenido.php?id=".$id."'>Eliminar</a>";
								}
								echo"
								<div id='divClear'></div>
							</div>
							<div id='divClear'></div>
						</div>
						<div id='divClear'></div>
						</div>";
						
			}
			break;
		case "quiz":
			$arraycont=$contenido->noModeradas($nick,$categoria);		
			$count =count($arraycont);
			for($i =1; $i <= $count; $i++) {
				$img = $arraycont[$i]['imagen_portada'];
				$id = $arraycont[$i]['id'];
				$titulo = $arraycont[$i]['titulo'];
				$autor = $arraycont[$i]['autor'];
				$fecha = $arraycont[$i]['fecha'];
				$visitas = $arraycont[$i]['visitas'];
				$valoracion = $arraycont[$i]['valoracion'];
				list($year, $month, $day_time) = explode("-", $fecha);
				list($day) = explode(" ", $day_time);
				echo "	<div class = 'articulo'>	
						
						<img id = 'imagen' src='".$img."'>
						
						<div id = 'contenido-articulo'>
							<h1><a href='quizX.php?id=".$id."'>".$titulo."</a></h1>
							<div id = 'datos-articulo'>
								<a id= 'usuario' href='usuario.php?nombre=$autor'>".$autor."</a>
								<p id ='fecha'>".$day."/".$month."/".$year."</p>
								<a id= 'enlaces' href='publicarcontenido.php?id=".$id."'>Publicar</a>
								<a id= 'enlaces' href='rechazarcontenido.php?id=".$id."'>Rechazar</a>
								";
								if($user['rol']=="administrador"){
									echo "<a id= 'enlaces' href='borrarcontenido.php?id=".$id."'>Eliminar</a>";
								}
								echo"
								<div id='divClear'></div>
							</div>
							<div id='divClear'></div>
						</div>
						<div id='divClear'></div>
						</div>";
						
			}
			break;
			case "evento":
			$arraycont=$contenido->noModeradas($nick,$categoria);		
			$count =count($arraycont);
			for($i =1; $i <= $count; $i++) {
				$img = $arraycont[$i]['imagen_portada'];
				$id = $arraycont[$i]['id'];
				$titulo = $arraycont[$i]['titulo'];
				$autor = $arraycont[$i]['autor'];
				$fecha = $arraycont[$i]['fecha'];
				$visitas = $arraycont[$i]['visitas'];
				$valoracion = $arraycont[$i]['valoracion'];
				list($year, $month, $day_time) = explode("-", $fecha);
				list($day) = explode(" ", $day_time);
				echo "	<div class = 'articulo'>	
						
						<img id = 'imagen' src='".$img."'>
						
						<div id = 'contenido-articulo'>
							<h1><a href='eventoX.php?id=".$id."'>".$titulo."</a></h1>
							<div id = 'datos-articulo'>
								<a id= 'usuario' href='usuario.php?nombre=$autor'>".$autor."</a>
								<p id ='fecha'>".$day."/".$month."/".$year."</p>
								<a id= 'enlaces' href='publicarcontenido.php?id=".$id."'>Publicar</a>
								<a id= 'enlaces' href='rechazarcontenido.php?id=".$id."'>Rechazar</a>
								<a id= 'enlaces' href='editar-evento.php?id=".$id."'>Editar</a>";
								if($user['rol']=="administrador"){
									echo "<a id= 'enlaces' href='borrarcontenido.php?id=".$id."'>Eliminar</a>";
								}
								echo"
								<div id='divClear'></div>
							</div>
							<div id='divClear'></div>
						</div>
						<div id='divClear'></div>
						</div>";
						
			}
			break;
			case "guia":
			$arraycont=$contenido->noModeradas($nick,$categoria);		
			$count =count($arraycont);
			for($i =1; $i <= $count; $i++) {
				$img = $arraycont[$i]['imagen_portada'];
				$id = $arraycont[$i]['id'];
				$titulo = $arraycont[$i]['titulo'];
				$autor = $arraycont[$i]['autor'];
				$fecha = $arraycont[$i]['fecha'];
				$visitas = $arraycont[$i]['visitas'];
				$valoracion = $arraycont[$i]['valoracion'];
				list($year, $month, $day_time) = explode("-", $fecha);
				list($day) = explode(" ", $day_time);
				echo "	<div class = 'articulo'>	
						
						<img id = 'imagen' src='".$img."'>
						
						<div id = 'contenido-articulo'>
							<h1><a href='guia.php?id=".$id."'>".$titulo."</a></h1>
							<div id = 'datos-articulo'>
								<a id= 'usuario' href='usuario.php?nombre=$autor'>".$autor."</a>
								<p id ='fecha'>".$day."/".$month."/".$year."</p>
								<a id= 'enlaces' href='publicarcontenido.php?id=".$id."'>Publicar</a>
								<a id= 'enlaces' href='rechazarcontenido.php?id=".$id."'>Rechazar</a>
								<a id= 'enlaces' href='editar-guia.php?id=".$id."'>Editar</a>";
								if($user['rol']=="administrador"){
									echo "<a id= 'enlaces' href='borrarcontenido.php?id=".$id."'>Eliminar</a>";
								}
								echo"
								<div id='divClear'></div>
							</div>
							<div id='divClear'></div>
						</div>
						<div id='divClear'></div>
						</div>";
						
			}
			break;
		default:
			$arraycont=$contenido->noModeradas($nick,$categoria);		
			$count =count($arraycont);
			for($i =1; $i <= $count; $i++) {
				$img = $arraycont[$i]['imagen_portada'];
				$id = $arraycont[$i]['id'];
				$titulo = $arraycont[$i]['titulo'];
				$autor = $arraycont[$i]['autor'];
				$fecha = $arraycont[$i]['fecha'];
				$visitas = $arraycont[$i]['visitas'];
				$valoracion = $arraycont[$i]['valoracion'];
				$categoria=$arraycont[$i]['categoria'];
				list($year, $month, $day_time) = explode("-", $fecha);
				list($day) = explode(" ", $day_time);
				echo "	<div class = 'articulo'>	
						
						<img id = 'imagen' src='".$img."'>
						
						<div id = 'contenido-articulo'>";
						if($categoria=="noticia"){
							echo "<h1><a href='noticiaX.php?id=".$id."'>".$titulo."</a></h1>
							<div id = 'datos-articulo'>
							    <p id ='fecha'>".$categoria."</p>
								<a id= 'usuario' href='usuario.php?nombre=$autor'>".$autor."</a>
								<p id ='fecha'>".$day."/".$month."/".$year."</p>
								<a id= 'enlaces' href='publicarcontenido.php?id=".$id."'>Publicar</a>
								<a id= 'enlaces' href='rechazarcontenido.php?id=".$id."'>Rechazar</a>
								<a id= 'enlaces' href='editar_noticia.php?id=".$id."'>Editar</a>";
								if($user['rol']=="administrador"){
									echo "<a id= 'enlaces' href='borrarcontenido.php?id=".$id."'>Eliminar</a>";
								}
								echo"
								<div id='divClear'></div>
							</div>
							<div id='divClear'></div>
						</div>
						<div id='divClear'></div>
						</div>";
				        }else if($categoria=="review"){
				        	echo "<h1><a href='review.php?id=".$id."'>".$titulo."</a></h1><div id = 'datos-articulo'>
							    <p id ='fecha'>".$categoria."</p>
								<a id= 'usuario' href='usuario.php?nombre=$autor'>".$autor."</a>
								<p id ='fecha'>".$day."/".$month."/".$year."</p>
								<a id= 'enlaces' href='publicarcontenido.php?id=".$id."'>Publicar</a>
								<a id= 'enlaces' href='rechazarcontenido.php?id=".$id."'>Rechazar</a>
								<a id= 'enlaces' href='editar-review.php?id=".$id."'>Editar</a>";
								if($user['rol']=="administrador"){
									echo "<a id= 'enlaces' href='borrarcontenido.php?id=".$id."'>Eliminar</a>";
								}
								echo"
								<div id='divClear'></div>
							</div>
							<div id='divClear'></div>
						</div>
						<div id='divClear'></div>
						</div>";
				        }else if($categoria=="quiz"){
				        	echo "<h1><a href='quizX.php?id=".$id."'>".$titulo."</a></h1>
							<div id = 'datos-articulo'>
							    <p id ='fecha'>".$categoria."</p>
								<a id= 'usuario' href='usuario.php?nombre=$autor'>".$autor."</a>
								<p id ='fecha'>".$day."/".$month."/".$year."</p>
								<a id= 'enlaces' href='publicarcontenido.php?id=".$id."'>Publicar</a>
								<a id= 'enlaces' href='rechazarcontenido.php?id=".$id."'>Rechazar</a>";
								if($user['rol']=="administrador"){
									echo "<a id= 'enlaces' href='borrarcontenido.php?id=".$id."'>Eliminar</a>";
								}
								echo"
								<div id='divClear'></div>
							</div>
							<div id='divClear'></div>
						</div>
						<div id='divClear'></div>
						</div>";
				        }else if($categoria=="evento"){
				        	echo "<h1><a href='eventoX.php?id=".$id."'>".$titulo."</a></h1><div id = 'datos-articulo'>
							    <p id ='fecha'>".$categoria."</p>
								<a id= 'usuario' href='usuario.php?nombre=$autor'>".$autor."</a>
								<p id ='fecha'>".$day."/".$month."/".$year."</p>
								<a id= 'enlaces' href='publicarcontenido.php?id=".$id."'>Publicar</a>
								<a id= 'enlaces' href='rechazarcontenido.php?id=".$id."'>Rechazar</a>
								<a id= 'enlaces' href='editar-evento.php?id=".$id."'>Editar</a>";
								if($user['rol']=="administrador"){
									echo "<a id= 'enlaces' href='borrarcontenido.php?id=".$id."'>Eliminar</a>";
								}
								echo"
								<div id='divClear'></div>
							</div>
							<div id='divClear'></div>
						</div>
						<div id='divClear'></div>
						</div>";
				        }else if($categoria=="guia"){
				        	echo "<h1><a href='guia.php?id=".$id."'>".$titulo."</a></h1><div id = 'datos-articulo'>
							    <p id ='fecha'>".$categoria."</p>
								<a id= 'usuario' href='usuario.php?nombre=$autor'>".$autor."</a>
								<p id ='fecha'>".$day."/".$month."/".$year."</p>
								<a id= 'enlaces' href='publicarcontenido.php?id=".$id."'>Publicar</a>
								<a id= 'enlaces' href='rechazarcontenido.php?id=".$id."'>Rechazar</a>
								<a id= 'enlaces' href='editar-guia.php?id=".$id."'>Editar</a>";
								if($user['rol']=="administrador"){
									echo "<a id= 'enlaces' href='borrarcontenido.php?id=".$id."'>Eliminar</a>";
								}
								echo"
								<div id='divClear'></div>
							</div>
							<div id='divClear'></div>
						</div>
						<div id='divClear'></div>
						</div>";
				        }
				        
					
						
						
			}
			break;
	}
			

	if($i > $count){echo "	<div class = 'articulo'>
					No hay mas contenido
			</div>";
	}
	?>

			</div>
			<?php require ('views/pie.html'); ?>
	</body>
</html>