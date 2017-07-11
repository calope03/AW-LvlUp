<?php
require_once 'includes/config.php';
require_once __DIR__.'/includes/Evento.php';
$listaUltimos = new \es\ucm\fdi\aw\ListaEventos(1);
$listaVisitados = new \es\ucm\fdi\aw\ListaEventos(2);
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
						<li><!--novedades-->
							<div class="headerRow">
								<img class="destacIcon" src="img/index/eventos.png">
								<p class="destacTitle">Eventos > Mas nuevos</p>
								<div id="verMas" onclick=location.href="eventos.php?tipo=1" style="cursor:pointer"><p>Ver Más</p></div>
								<div id="divClear"></div>
							</div>

							<ul class="contentRow">
							<?php
							if (!is_null($listaUltimos->lista)){
								$c=0;
								while($c<4 AND $c<$listaUltimos->contador){ ?>
									<li>
										<div onclick=location.href="eventoX.php?id=<?php $listaUltimos->lista[$c]->getId() ?>"  style="cursor:pointer" >
											<img class="destacBg md-whiteframe-2" src = "<?php $listaUltimos->lista[$c]->getImagen() ?>">
											<p><?php $listaUltimos->lista[$c]->getTitulo() ?></p>
										</div>
									</li>
							<?php 
									$c++;
								}
							}else{
							?>
							<h1>No hay contenido</h1>
							<?php 
								}
							?>
								<div id="divClear"></div>
							</ul>
						</li><!---- fin novedades-->
						<li><!---- visitadas-->
							<div class="headerRow">
								<img class="destacIcon" src="img/index/eventos.png">
								<p class="destacTitle">Eventos > Mayor Asistencia</p>
								<div id="verMas" onclick=location.href="eventos.php?id=2" style="cursor:pointer"><p>Ver Más</p></div>
								<div id="divClear"></div>
							</div>

							<ul class="contentRow">
							<?php 
							if (!is_null($listaVisitados->lista)){
								$c=0;
								while($c<4 AND $c<$listaVisitados->contador){ ?>
									<li>
										<div onclick=location.href="eventoX.php?id=<?php $listaVisitados->lista[$c]->getId() ?>"  style="cursor:pointer" >
											<img class="destacBg md-whiteframe-2" src = "<?php $listaVisitados->lista[$c]->getImagen() ?>">
											<p><?php $listaVisitados->lista[$c]->getTitulo() ?></p>
										</div>
									</li>
							<?php
									$c++;
								}
							}else{
							?>
							<h1>No hay contenido</h1>
							<?php 
								}
							?>
								<div id="divClear"></div>
							</ul>
						</li><!---- visitadas-->
					</ul>
				</div>

			</div><!-- FIN Contenido -->		
		
		</div> <!-- FIN Contenedor -->

		<?php require ('views/pie.html'); ?>
	</body>
</html>