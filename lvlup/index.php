<?php
require_once 'includes/config.php';
require_once __DIR__.'/includes/Contenido.php';
$cont= new \es\ucm\fdi\aw\Contenido();
if(isset($_POST['plataforma']))
{
	$plataforma = $_POST['plataforma'];
	//$noticias= $comn -> cargaNoticiasRecientes($plataforma);
}
else 
{
	$plataforma = array();
	
}
?>
<!DOCTYPE HTML>
<hmtl>
	<head>
		<title>LVLuP</title>
		<link rel = "stylesheet" type = "text/css" href = "css/reset.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/header.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/portada.css"/>	
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
	
		<!-- === CONTENIDO === -->
		<div id="contenedor">

			<?php require ('views/menu-derecha.php'); ?>
			
			<div id="divClear"></div>
			<div id="contenido">

				<div class="homeContents">
					<ul class="listContents">
						<li><!--top noticias-->
							<div class="headerRow">
								<img class="destacIcon" src="img/index/noticias.png">
								<p class="destacTitle">Nuevas Noticias</p>
								<div id="verMas" onclick=location.href="noticias_novedades.php" style="cursor:pointer"><p>Ver Más</p></div>
								<div id="divClear"></div>
							</div>

							<ul class="contentRow">
							<?php $contenidos= $cont -> cargaContenidoRecientes($plataforma,"noticia");
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
								<p class="destacTitle">Nuevas Reviews</p>
								<div id="verMas" onclick=location.href="reviews-novedades.php" style="cursor:pointer"><p>Ver Más</p></div>
								<div id="divClear"></div>
							</div>

							<ul class="contentRow">
								<?php $contenidos= $cont -> cargaContenidoRecientes($plataforma,"review");
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
								<p class="destacTitle">Nuevos Quizs</p>
								<div id="verMas" onclick=location.href="quizs-novedades.php" style="cursor:pointer"><p>Ver Más</p></div>
								<div id="divClear"></div>
							</div>

							<ul class="contentRow">
								<?php $contenidos= $cont -> cargaContenidoRecientes($plataforma,"quiz");
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
								<p class="destacTitle">Nuevos Eventos</p>
								<div id="verMas" onclick=location.href="eventos.php?tipo=1" style="cursor:pointer"><p>Ver Más</p></div>
								<div id="divClear"></div>
							</div>

							<ul class="contentRow">
								<?php $contenidos= $cont -> cargaContenidoRecientes($plataforma,"evento");
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
								<p class="destacTitle">Nuevas Guias</p>
								<div id="verMas" onclick=location.href="novedades-guiastrucos.php" style="cursor:pointer"><p>Ver Más</p></div>
								<div id="divClear"></div>
							</div>

							<ul class="contentRow">
								<?php $contenidos= $cont -> cargaContenidoRecientes($plataforma,"guia");
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
								<div style="clear: both"></div>
							</ul>
						</li><!---- fin top guias y trucos-->
						
					</ul>
				</div>

			</div><!-- FIN Contenido -->		
		
		</div> <!-- FIN Contenedor -->

		<?php require ('views/pie.html'); ?>
	</body>
</html>