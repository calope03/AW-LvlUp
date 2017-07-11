<?php
//session_start();
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/GuiasTrucos.php';
require_once __DIR__.'/includes/Usuario.php';
$id = $_GET["id"];
$guia = new \es\ucm\fdi\aw\GuiasTrucos();
$usuario = new \es\ucm\fdi\aw\Usuario();
$url = $_SERVER['REQUEST_URI'];
?>
<!DOCTYPE HTML>
<hmtl>
	<head>
		<title> Ejemplo guía </title>
		<link rel = "stylesheet" type = "text/css" href = "css/reset.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/header.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/contenido-ejmguia-guiastrucos.css"/>	
		<link rel = "stylesheet" type = "text/css" href = "css/sidebar.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/pie.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/comentarios.css"/>
		<script defer type="text/javascript" src="js/registro.js"></script>
		<script defer type="text/javascript" src="js/busquedaAvanzada.js"></script>
		<script src="js/jquery-1.12.2.min.js"></script>	
		<meta http-equiv="Content-Type" content="text/html; charset= utf-8"/>

		<script type="text/javascript">
			function rechazarcont(id){
				var b=confirm('¿Deseas rechazar este contenido?');
				   if (b){
					   var pagina= "rechazarcontenido.php?id=" + id;
					 window.location.href = pagina; //página web a la que te redirecciona si confirmas la eliminación
				   }else{
				  //Y aquí pon cualquier cosa que quieras que salga si le diste al boton de cancelar
				   return false;}
			}
			function eliminarGuia(id){
				var eliminar=confirm('¿Deseas eliminar este contenido?');
				   if (eliminar){
					   var pagina= "borrarcontenido.php?id=" + id;
					 window.location.href = pagina; //página web a la que te redirecciona si confirmas la eliminación
				   }else{
				  //Y aquí pon cualquier cosa que quieras que salga si le diste al boton de cancelar
				   return false;}
			}
			function publicarcont(id){
				var a=confirm('¿Deseas publicar este contenido?');
				   if (a){
					   var pagina= "publicarcontenido.php?id=" + id;
					 window.location.href = pagina; //página web a la que te redirecciona si confirmas la publicacion
				   }else{
				  //Y aquí pon cualquier cosa que quieras que salga si le diste al boton de cancelar
				   return false;}
			}
			
		</script>
	</head>
	
<body>

	<?php
		require ('views/header.php');
	?>
		
		<!-- === CONTENIDO === -->
		<div id="contenedor">
		
			<?php require ('views/menu-derecha.php'); ?>

			<div id="divClear"></div>

			
			<div id="contenido">
				<?php
					$leer = true;
					$rol = "";
					$nick="";
					if (isset($_SESSION['nombre']))
					{
						$nick = $_SESSION['nombre'];
						$rol = $usuario->compruebaRol($nick);
					}
				?>
			
				<div id = "panelContenido">
					<?php $guia->cargaGuia($id); ?>
					<div id="header-titulo-guia">
						<h1 id = "txt-cabecera"><?php echo $guia->getTitulo()?> </h1> 
					</div>
					<br />
					
					<hr></hr>
					
					<div id="cuerpo-guia">
					
						<?php if(!$guia->getPublicado()){
							if($rol != "administrador" && $rol != "editor" && !( ($rol == "escritor") && ($nick == $guia->getAutor()) )){ 
								$leer = false;
							}
						}

						if($leer){ ?>
							<div id="guia-izq">

								
								<img id="portada-juego" src="<?php echo $guia->getImagen()?>">
								
								
								<div id="separador"></div>
								<br />
								
								<a href="usuario.php?nombre=<?php echo $guia->getAutor() ?>"><p> <em>Autor:</em> <?php echo $guia->getAutor() ?> </p></a>
								<p>Valoración media: <?php echo $guia->getValoracion(); ?> puntos </p>

								<?php 
								if (isset($_SESSION['nombre'])){
						
									if(!$guia->haValorado($id, $nick)){?>

										<form class='rating' name='5estrellas' action='gestionaValoracion.php' method='post'>
											<input type='radio' id='star1' name='rating' value='1' /><label for='star1' title='Sucks'>1</label>
											<input type='radio' id='star2' name='rating' value='2' /><label for='star2' title='Kinda bad'>2</label>
											<input type='radio' id='star3' name='rating' value='3' /><label for='star3' title='Meh'>3</label>
											<input type='radio' id='star4' name='rating' value='4' /><label for='star4' title='Pretty good'>4</label>
											<input type='radio' id='star5' name='rating' value='5' /><label for='star5' title='Rocks!'>5</label>
											<input type='submit' id='enviar' value = 'Valóralo' >
											<input type='hidden' name='id' id='id' value = '<?php echo $id; ?>'>
											<input type='hidden' name='nick' id='nick' value = '<?php echo $nick; ?>'>
											<input type='hidden' name='url' id='url' value = '<?php echo $url; ?>'>
											<input type='hidden' name='nick_autor' id='nick_autor' value = '<?php echo $guia->getAutor() ?>'>
										</form>
									<?php }?>

									<?php 
									if($rol == "administrador" || $rol == "editor" || ( ($rol == "escritor") && ($nick == $guia->getAutor()) )){?>
									<form name='botones' action='editar-guia.php?id=<?php echo $id; ?>' method='post'>
							
										<input id = 'boton' type='submit' name='editar' value='Editar' />
										<?php 
										if($rol == "administrador" || ( ($rol == "escritor") && ($nick == $guia->getAutor()) )){?>
											<?php echo "<input id = 'boton' type='button' name='eliminar' value='Eliminar' onclick = 'eliminarGuia(".$id.")'/>";
										 }?>
										
									</form>
									<?php } ?>

									<?php if(($rol == "administrador") || ($rol == "editor") ){
										if((!$guia->getPublicado()) && (!$guia->getModerado()) ){?>
											<form name='botones' action='' method='post'>
												<?php echo "<input id = 'boton' type='button' name='publicar' value='Publicar' onclick = 'publicarcont(".$id.")'/>
												<input id = 'boton' type='button' name='rechazar' value='Rechazar' onclick = 'rechazarcont(".$id.")'/>";?>
											</form>

										<?php }

									}
								}?>
								
															
							</div>
							
							<div id="guia-der">
								
								<?php echo $guia->getTexto()?>

								<?php if((isset($_SESSION['nombre'])) && ($nick==$guia->getAutor())){
									if(($guia->getPublicado()) && ($guia->getModerado()) ){?>
										<p><h1 id = 'titular'>Esta guia ha sido moderada y ha sido publicada</h1></p>
							<?php }elseif((!$guia->getPublicado())&& ($guia->getModerado())){ ?>
										<p><h1 id = 'titular'>Esta guia ha sido moderada y ha sido rechazada</h1></p>
									<?php }else{ ?>
										<p><h1 id = 'titular'>Pendiente de moderacion</h1></p>
									<?php }
								}?>
								
							</div> <!--guia-der -->
						<?php }
						else{?>
							<p><h1>No tienes permiso para estar aquí</h1></p>
						<?php } ?>
					
					</div> <!--FIN cuerpo-guia -->
					<?php require ('views/comentarios.php'); ?>
				</div> <!--FIN panelContenido -->
				
			</div> <!--FIN Contenido -->	

		</div> <!-- FIN Contenedor -->
	<?php require ('views/pie.html'); ?>
	</body>
</html>