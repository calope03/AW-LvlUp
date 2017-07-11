<?php
require_once 'includes/config.php';
require_once 'includes/Usuario.php';
require_once __DIR__.'/includes/Evento.php';

if(!(empty($_GET['id']))){
		$id = $_GET['id'];
	}

$evento = new \es\ucm\fdi\aw\Evento();
$evento->cargarEventoById($id);
if(isset($_SESSION['nombre'])){
	$user = new \es\ucm\fdi\aw\Usuario();
	$usuario123 = $user->dameUsuario($_SESSION['nombre']);
}else{
	$usuario123['rol']="registrado";
}
//echo $usuario['rol'];
?>
<!DOCTYPE HTML>
<hmtl>
	<head>
		<title> Evento </title>
		<link rel = "stylesheet" type = "text/css" href = "css/reset.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/header.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/evento.css"/>	
		<link rel = "stylesheet" type = "text/css" href = "css/sidebar.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/pie.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/comentarios.css"/>	
		<script defer type="text/javascript" src="js/registro.js"></script>	
		<script defer type="text/javascript" src="js/busquedaAvanzada.js"></script>
		<script src="js/jquery-1.12.2.min.js"></script>	
		<meta http-equiv="Content-Type" content="text/html; charset= utf-8"/>
		<script type="text/javascript">
			
			function participar(id, equipo, nick){
				var b=confirm('¿Deseas participar con el equipo ' + equipo + '?');
				   if (b){
						var pagina= "participar.php?id=" + id + "&nick=" + nick + "&equipo="+equipo;
						window.location.href = pagina; //página web a la que te redirecciona si confirmas la eliminación
				   }else{
				  //Y aquí pon cualquier cosa que quieras que salga si le diste al boton de cancelar
				   return false;}
			}
		
		
			function expulsarUsuario(nick, id){
				var b=confirm('¿Deseas expulsar a '+ nick+'?');
				   if (b){
						var pagina= "eliminarParticipante.php?id="+id+"&nick=" + nick;
						window.location.href = pagina; //página web a la que te redirecciona si confirmas la eliminación
				   }else{
				  //Y aquí pon cualquier cosa que quieras que salga si le diste al boton de cancelar
				   return false;}
			}
			
			function eliminarEvento(id){
				var eliminar=confirm('¿Deseas eliminar este contenido?');
				   if (eliminar){
					   var pagina= "borrarcontenido.php?id=" + id;
					 window.location.href = pagina; //página web a la que te redirecciona si confirmas la eliminación
				   }else{
				  //Y aquí pon cualquier cosa que quieras que salga si le diste al boton de cancelar
				   return false;}
			}

			
			
		
		</script>
	</head>
	
<body>
	<?php
		$login = isset($_SESSION['nombre']) ? $_SESSION['nombre'] : false;
		if($login){
			$nombre=$_SESSION['nombre'];
		}else{
			$nombre="";
		}
		require ('views/header.php');
	?>
		
		<!-- === CONTENIDO === -->
		<div id="contenedor">
		
			<?php require ('views/menu-derecha.php'); ?>

			<div id="divClear"></div>
		
			<div id="contenido">
				<div id="evento">
				
				<?php 
				
				if(!$evento->isPublicado() AND $nombre!==$evento->returnAutor() && ($usuario123['rol']!="administrador")&& ($usuario123['rol']!="editor")){?>
					<h1>Este contenido no es accesible</h1>
					
				<?php
				}else {
					$evento->aumentaVisita($id)?>
				
					<div id="nombreEvento">
						<img id="logo-evento" src="<?php $evento->getImagen() ?>">
						<h1><?php $evento->getTitulo() ?></h1>
					</div>
					<div id="participantes">
						<table>
							<tr>
								<th>Equipo 1</th>
								<th>Equipo 2</th>
							</tr>
							<?php 
							for($c=0;$c<$evento->numParticipantes/2; $c++){ ?>
								<tr>
									<?php 
									
									if($c<$evento->getContador1()){ ?>
										<td>
											<a href="usuario.php?nombre=<?php echo $evento->getParticipante1($c); ?>"><?php $evento->getParticipante1($c) ?></a>
											<?php 
											if($nombre==$evento->returnAutor()){ ?>
												<form name='botones' action='' method='post'>
												<button id="buttonEliminar" type='button' name="eliminar" onclick="expulsarUsuario('<?php $evento->getParticipante1($c) ?>', '<?php $evento->getId() ?>')">Expulsar</button>
												</form>
										<?php
											}?>
										</td>
									<?php 
									} else if(!$evento->estaRegistrado($nombre) && $login) {?> 
										<td><button id="buttonParticipar" onclick="participar('<?php $evento->getId() ?>', '1' , '<?php echo $nombre ?>')">Participar</button></td>
									<?php 
									}else {?>
										<td></td>
									<?php 
									}
									if($c<$evento->getContador2()){ ?>
										<td>
											<a href="usuario.php?nombre=<?php $evento->getParticipante2($c); ?>"><?php $evento->getParticipante2($c) ?></a>
											<?php 
											if($nombre==$evento->returnAutor()){ ?>
												<form name='botones' action='' method='post'>
												<button id="buttonEliminar" type='button' name="eliminar" onclick="expulsarUsuario('<?php $evento->getParticipante2($c) ?>', '<?php $evento->getId() ?>')">Expulsar</button>
											</form>
										<?php
											}?>
										</td>
									<?php 
									} else if(!$evento->estaRegistrado($nombre) && $login) {?>
										<td><button id="buttonParticipar" onclick="participar('<?php $evento->getId() ?>', '2' , '<?php echo $nombre ?>')">Participar</button></td>
									<?php 
									}else {?>
										<td></td>
									<?php 
									}?>
								</tr>
							<?php  
							}
							?>
							<tr>
								<td colspan=2><?php $evento->getFechaEvento() ?> / <?php $evento->getFechaEventoFin() ?></td>
							</tr>
						</table>
					</div>
					<div id="descripcion">
					<p><?php $evento->getTexto() ?></p>
					</div>
				<?php require ('views/comentarios.php'); ?>
				</div>
				<?php 
				}?>
				
			</div><!-- FIN Contenido -->		
		
			
		</div> <!-- FIN Contenedor -->
	<?php require ('views/pie.html'); ?>
	</body>
</html>