<?php 
require_once 'includes/config.php';
require_once 'includes/Usuario.php';
$usuario= new \es\ucm\fdi\aw\Usuario();
if(isset($_GET['nombre'])){
	$user=$usuario->dameUsuario($_GET['nombre']);
	$rol=$user['rol'];
	$nombre=$user['nick'];
	$imagen_avatar=$user['ruta_avatar'];
	$nivel=$user['nivel'];
	$experiencia=$user['experiencia'];
	$descripcion=$user['descripcion'];
	$correo_usu=$user['correo'];
	//echo var_dump($user);
}else{
	//echo ("No has saleccionado ningun usuario");
}
?>
<!DOCTYPE HTML>
<hmtl>
	<head>
		<title> Usuario </title>
		<link rel = "stylesheet" type = "text/css" href = "css/reset.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/header.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/usuario.css"/>	
		<link rel = "stylesheet" type = "text/css" href = "css/sidebar.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/pie.css" />
		<script defer type="text/javascript" src="js/registro.js"></script>	
		<script defer type="text/javascript" src="js/busquedaAvanzada.js"></script>	
		<script src="js/jquery-1.12.2.min.js"></script>	
		<meta http-equiv="Content-Type" content="text/html; charset= utf-8"/>
	</head>
	
<body>
	<?php
		require ('views/header.php');
	?>
	<div id="divClear"></div>
		<!-- === CONTENIDO === -->
		<div id="contenedor">
			
				<?php require ('views/menu-derecha.php'); ?>
			
<?php if(isset($_GET['nombre'])){?>
			<div id="contenido">
			<div id="informacion">
				<?php	
		echo "<img id='imagenPerfil' src='".$imagen_avatar."' />
				<div id='descripcion'>
					<p> <em>Nick:</em> ".$nombre."</p>
					<p> <em>Rol:</em> ".$rol." ".$nivel."</p>
					<p>	<em>Correo:</em> ".$correo_usu." </p>
					<p> <em>Valoraciones positivas:</em> ".$experiencia."</p>
					<p> <em>Descripcion:</br></br></em> ".$descripcion."</p>
					<div id='divClear'></div>
				</div>";?>		
			</div>
			<div id="divClear"></div>
				<div class="homeContents">
					<ul class="listContents">
						<li><!--top noticias-->
							<div class="headerRow">
								<img class="destacIcon" src="img/index/noticias.png">
								<p class="destacTitle">@<?php echo $nombre;?> > Noticias</p>
								
								<div id="divClear"></div>
							</div>

							<ul class="contentRow">
							<?php $contenidos= $usuario -> cargaAutorRecientes($nombre,"noticia");
							$count =count($contenidos);
							if($count>0){
								for($i = 1; $i <= $count && $i <=4   ; $i++) {
									$id = $contenidos[$i]['id'];
									echo "<li>
										<div onclick=location.href='noticiaX.php?id=".$id."' style='cursor:pointer' >";
									$img = $contenidos[$i]['imagen_portada'];
									echo "<img class='destacBg md-whiteframe-2' src = ".$img.">";
									$titulo = $contenidos[$i]['titulo'];
									echo "<p>".$titulo."</p>";
									echo "</div></li>";
								}
							}else{
								echo "<li><div><p>Aun no hay noticias :( </p></div></li>";
							}
							?>	
								<div style="clear: both"></div>
							</ul>
						</li><!---- fin top noticias-->
						<li><!---- top reviews-->
							<div class="headerRow">
								<img class="destacIcon" src="img/index/reviews.png">
								<p class="destacTitle">@<?php echo $nombre;?> > Reviews</p>
								<div id="divClear"></div>
							</div>

							<ul class="contentRow">
								<?php $contenidos= $usuario -> cargaAutorRecientes($nombre,"review");
									$count =count($contenidos);
									if($count>0){
										for($i = 1; $i <= $count && $i <=4   ; $i++) {
											$id = $contenidos[$i]['id'];
											echo "<li>
												<div onclick=location.href='review.php?id=".$id."' style='cursor:pointer' >";
											$img = $contenidos[$i]['imagen_portada'];
											echo "<img class='destacBg md-whiteframe-2' src = ".$img.">";
											$titulo = $contenidos[$i]['titulo'];
											echo "<p>".$titulo."</p>";
											echo "</div></li>";
										}
									}else{
										echo "<li><div><p>Aun no hay reviews :( </p></div></li>";
									}
								?>	
								<div style="clear: both"></div>
							</ul>
						</li><!---- fin top reviews-->
						<li><!--top quizs-->
							<div class="headerRow">
								<img class="destacIcon" src="img/index/quizs.png">
								<p class="destacTitle">@<?php echo $nombre;?> > Quizs</p>
								<div id="divClear"></div>
							</div>

							<ul class="contentRow">
								<?php $contenidos= $usuario -> cargaAutorRecientes($nombre,"quiz");
									$count =count($contenidos);
									if($count>0){
										for($i = 1; $i <= $count && $i <=4   ; $i++) {
											$id = $contenidos[$i]['id'];
											echo "<li>
												<div onclick=location.href='quizX.php?id=".$id."' style='cursor:pointer' >";
											$img = $contenidos[$i]['imagen_portada'];
											echo "<img class='destacBg md-whiteframe-2' src = ".$img.">";
											$titulo = $contenidos[$i]['titulo'];
											echo "<p>".$titulo."</p>";
											echo "</div></li>";
										}
									}else{
										echo "<li><div><p>Aun no hay Quizs :( </p></div></li>";
									}
								?>	
								<div style="clear: both"></div>
							</ul>
						</li><!---- fin top quizs-->
						<li><!----top eventos-->
							<div class="headerRow">
								<img class="destacIcon" src="img/index/eventos.png">
								<p class="destacTitle">@<?php echo $nombre;?> > Eventos</p>
								<div id="divClear"></div>
							</div>

							<ul class="contentRow">
								<?php $contenidos= $usuario -> cargaAutorRecientes($nombre,"evento");
									$count =count($contenidos);
									if($count>0){
										for($i = 1; $i <= $count && $i <=4   ; $i++) {
											$id = $contenidos[$i]['id'];
											echo "<li>
												<div onclick=location.href='eventoX.php?id=".$id."' style='cursor:pointer' >";
											$img = $contenidos[$i]['imagen_portada'];
											echo "<img class='destacBg md-whiteframe-2' src = ".$img.">";
											$titulo = $contenidos[$i]['titulo'];
											echo "<p>".$titulo."</p>";
											echo "</div></li>";
										}
									}else{
										echo "<li><div><p>Aun no hay eventos :( </p></div></li>";
									}
								?>	
								<div style="clear: both"></div>
							</ul>
						</li><!---- fin top eventos-->
						<li><!----top guias y trucos-->
							<div class="headerRow">
								<img class="destacIcon" src="img/index/guias.png">
								<p class="destacTitle">@<?php echo $nombre;?> > Guias</p>
								<div id="divClear"></div>
							</div>

							<ul class="contentRow">
									<?php $contenidos= $usuario -> cargaAutorRecientes($nombre,"guia");
									$count =count($contenidos);
									if($count>0){
										for($i = 1; $i <= $count && $i <=4   ; $i++) {
											$id = $contenidos[$i]['id'];
											echo "<li>
												<div onclick=location.href='guia.php?id=".$id."' style='cursor:pointer' >";
											$img = $contenidos[$i]['imagen_portada'];
											echo "<img class='destacBg md-whiteframe-2' src = ".$img.">";
											$titulo = $contenidos[$i]['titulo'];
											echo "<p>".$titulo."</p>";
											echo "</div></li>";
										}
									}else{
										echo "<li><div><p>Aun no hay guias :( </p></div></li>";
									}
								?>	
								<div id = "divClear" ></div>
							</ul>
						</li><!---- fin top guias y trucos-->
						
					</ul>
				</div>

			</div><!-- FIN Contenido -->		
<?php
}else{
	echo "<div id='contenido'><div id='informacion'> No has seleccionado usuario </div> </div>";
}?>
		</div> <!-- FIN Contenedor -->
			
		<?php require ('views/pie.html'); ?>
	</body>
</html>