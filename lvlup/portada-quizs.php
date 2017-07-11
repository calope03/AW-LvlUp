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
		<title>Quizs</title>
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
						<li><!--novedades-->
							<div class="headerRow">
								<img class="destacIcon" src="img/index/quizs.png">
								<p class="destacTitle">Quizs > Mas nuevos</p>
								<div id="verMas" onclick=location.href="quizs-novedades.php" style="cursor:pointer"><p>Ver Más</p></div>
								<div id="divClear"></div>
							</div>

							<ul class="contentRow">
								<?php  $noticias= $cont -> cargaContenidoRecientes($plataforma,"quiz");
									$count =count($noticias);
									if($count>0){
										for($i = 1; $i <= $count && $i <=4   ; $i++) {
											$id = $noticias[$i]['id'];
											echo "<li>
												<div onclick=location.href='quizX.php?id=".$id."' style='cursor:pointer' >";
											$img = $noticias[$i]['imagen_portada'];
											echo "<img class='destacBg md-whiteframe-2' src = ".$img.">";
											$titulo = $noticias[$i]['titulo'];
											echo "<p>".$titulo."</p>";
											echo "</div></li>";
										}
									}else{
										echo "<li><div><p>Aun no hay quizs :( </p></div></li>";
									}
								?>
								<div style="clear: both"></div>
							</ul>
						</li><!---- fin novedades-->
						<li><!---- visitadas-->
							<div class="headerRow">
								<img class="destacIcon" src="img/index/quizs.png">
								<p class="destacTitle">Quizs > Mas visitados</p>
								<div id="verMas" onclick=location.href="quizs-visitados.php" style="cursor:pointer"><p>Ver Más</p></div>
								<div id="divClear"></div>
							</div>

							<ul class="contentRow">
								<?php  $noticias= $cont -> cargaContenidoVisitadas($plataforma,"quiz");
									$count =count($noticias);
									if($count>0){
										for($i = 1; $i <= $count && $i <=4   ; $i++) {
											$id = $noticias[$i]['id'];
											echo "<li>
												<div onclick=location.href='quizX.php?id=".$id."' style='cursor:pointer' >";
											$img = $noticias[$i]['imagen_portada'];
											echo "<img class='destacBg md-whiteframe-2' src = ".$img.">";
											$titulo = $noticias[$i]['titulo'];
											echo "<p>".$titulo."</p>";
											echo "</div></li>";
										}
									}else{
										echo "<li><div><p>Aun no hay quizs :( </p></div></li>";
									}
								?>
								<div style="clear: both"></div>
							</ul>
						</li><!---- visitadas-->
					</ul>
				</div>

			</div><!-- FIN Contenido -->		
		
		</div> <!-- FIN Contenedor -->

		<?php require ('views/pie.html'); ?>
	</body>
</html>