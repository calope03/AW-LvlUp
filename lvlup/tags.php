<?php
//session_start();
require_once __DIR__.'/includes/config.php';
//require_once __DIR__.'/includes/Review.php';
$palabra = $_GET["palabra"];
$tag = new \es\ucm\fdi\aw\Tag();
//$review = new \es\ucm\fdi\aw\Review();
//$url = $_SERVER['REQUEST_URI'];
?>
<!DOCTYPE HTML>
<hmtl>
	<head>
		<title>LVLuP - Tags</title>
		<link rel = "stylesheet" type = "text/css" href = "css/reset.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/header.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/home.css"/>	
		<link rel = "stylesheet" type = "text/css" href = "css/sidebar.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/usuario.css" />
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

			<div id="contenido">

				<div class="homeContents">
					<ul class="listContents">
						<li><!--top noticias-->
							<div class="headerRow">
								<img class="destacIcon" src="img/index/noticias.png">
								<p class="destacTitle">Últimas noticias > <?php echo $palabra ?></p>
								<div id="divClear"></div>
							</div>

							<ul class="contentRow">
								
								<?php $noticias = $tag -> dameContenidoSegunTag($palabra, 'noticia');
									$count =count($noticias);
									if($count>0){
										for($i = 0; $i < $count && $i <4   ; $i++) {
											$id = $noticias[$i]['id'];
											echo "<li>
												<div onclick=location.href='noticiaX.php?id=".$id."' style='cursor:pointer' >";
											$img = $noticias[$i]['imagen_portada'];
											echo "<img class='destacBg md-whiteframe-2' src = ".$img.">";
											$titulo = $noticias[$i]['titulo'];
											echo "<p>".$titulo."</p>";
											echo "</div></li>";
										}
									}else{
										echo "<li><div><p>¡Vaya! Todavía no hay noticias etiquetadas con ".$palabra."</p></div></li>";
									}
								?>
								
							</ul>
						</li><!---- fin top noticias-->
						<li><!---- top reviews-->
							<div class="headerRow">
								<img class="destacIcon" src="img/index/reviews.png">
								<p class="destacTitle">Últimas reviews > <?php echo $palabra ?></p>
								<div id="divClear"></div>
							</div>

							<ul class="contentRow">
								
								<?php $reviews = $tag -> dameContenidoSegunTag($palabra, 'review');
									$count =count($reviews);
									if($count>0){
										for($i = 0; $i < $count && $i <4   ; $i++) {
											$id = $reviews[$i]['id'];
											echo "<li>
												<div onclick=location.href='review.php?id=".$id."' style='cursor:pointer' >";
											$img = $reviews[$i]['imagen_portada'];
											echo "<img class='destacBg md-whiteframe-2' src = ".$img.">";
											$titulo = $reviews[$i]['titulo'];
											echo "<p>".$titulo."</p>";
											echo "</div></li>";
										}
									}else{
										echo "<li><div><p>¡Vaya! Todavía no hay reviews etiquetadas con ".$palabra."</p></div></li>";
									}
								?>
								
							</ul>
						</li><!---- fin top reviews-->
						
						<li><!----top guias y trucos-->
							<div class="headerRow">
								<img class="destacIcon" src="img/index/guias.png">
								<p class="destacTitle">Últimas guías > <?php echo $palabra ?></p>
								<div id="divClear"></div>
							</div>

							<ul class="contentRow">
								
								<?php $guias = $tag -> dameContenidoSegunTag($palabra, 'guia');
									$count =count($guias);
									if($count>0){
										for($i = 0; $i < $count && $i <4   ; $i++) {
											$id = $guias[$i]['id'];
											echo "<li>
												<div onclick=location.href='guia.php?id=".$id."' style='cursor:pointer' >";
											$img = $guias[$i]['imagen_portada'];
											echo "<img class='destacBg md-whiteframe-2' src = ".$img.">";
											$titulo = $guias[$i]['titulo'];
											echo "<p>".$titulo."</p>";
											echo "</div></li>";
										}
									}else{
										echo "<li><div><p>¡Vaya! Todavía no hay guías etiquetadas con ".$palabra."</p></div></li>";
									}
								?>
								
							</ul>
						</li><!---- fin top guias y trucos-->
						
					</ul>
				</div>

			</div><!-- FIN Contenido -->		
		
		</div> <!-- FIN Contenedor -->
		<?php require ('views/pie.html'); ?>
	</body>
</html>