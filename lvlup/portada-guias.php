<?php
require_once 'includes/config.php';
require_once __DIR__.'/includes/GuiasTrucos.php';
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
		<title>Guias</title>
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
								<img class="destacIcon" src="img/index/guias.png">
								<p class="destacTitle">Guias > Mas nuevas</p>
								<div id="verMas" onclick=location.href="novedades-guiastrucos.php" style="cursor:pointer"><p>Ver Más</p></div>
								<div id="divClear"></div>
							</div>

							<ul class="contentRow">
								<?php $guias= $cont -> cargaContenidoRecientes($plataforma,"guia");
								$count =count($guias);
								if($count>0){
									for($i = 1; $i <= $count && $i <=4   ; $i++) {
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
									echo "<li><div><p>Aun no hay guias :( </p></div></li>";
								}
							?>	
								<div style="clear: both"></div>
							</ul>
						</li><!---- fin novedades-->
						<li><!---- visitadas-->
							<div class="headerRow">
								<img class="destacIcon" src="img/index/guias.png">
								<p class="destacTitle">Guias > Mas visitadas</p>
								<div id="verMas" onclick=location.href="masvisitadas-guiastrucos.php" style="cursor:pointer"><p>Ver Más</p></div>
								<div id="divClear"></div>
							</div>

							<ul class="contentRow">
								<?php $guias= $cont -> cargaContenidoVisitadas($plataforma,"guia");
								$count =count($guias);
								if($count>0){
									for($i = 1; $i <= $count && $i <=4   ; $i++) {
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
									echo "<li><div><p>Aun no hay guias :( </p></div></li>";
								}
								?>	
								<div style="clear: both"></div>
							</ul>
						</li><!---- visitadas-->
						<li><!--valoradas-->
							<div class="headerRow">

								<img class="destacIcon" src="img/index/guias.png">
								<p class="destacTitle">Guias > Mejor valoradas</p>
								<div id="verMas" onclick=location.href="valoradas-guiastrucos.php" style="cursor:pointer"><p>Ver Más</p></div>
								<div id="divClear"></div>
							</div>

							<ul class="contentRow">
								<?php $guias= $cont -> cargaContenidoPopulares($plataforma,"guia");
							$count =count($guias);
							if($count>0){
								for($i = 1; $i <= $count && $i <=4   ; $i++) {
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
								echo "<li><div><p>Aun no hay guias :( </p></div></li>";
							}
							?>	
								<div style="clear: both"></div>
							</ul>
						</li><!---- fin valoradas-->
					</ul>
				</div>

			</div><!-- FIN Contenido -->		
		
		</div> <!-- FIN Contenedor -->

		<?php require ('views/pie.html'); ?>
	</body>
</html>