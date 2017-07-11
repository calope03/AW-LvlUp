<?php
	
	require_once 'includes/config.php';
	require_once __DIR__.'/includes/Evento.php';

	$numEventos=5;
	if(!(empty($_GET['page']))){
		$page = $_GET['page'];
	}
	else{
		$page = 0;
	}
	if(!(empty($_GET['tipo']))){
		$tipo = $_GET['tipo'];
	}
	else{
		$tipo = 0;  		//tipos: 1=fecha, 2=visiatados
	}
	$lista = new \es\ucm\fdi\aw\ListaEventos($tipo);
	
?>



<!DOCTYPE HTML>
<hmtl>
	<head>
		<title> Eventos </title>
		<link rel = "stylesheet" type = "text/css" href = "css/reset.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/header.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/menucheck.css"/>
		<link rel = "stylesheet" type = "text/css" href = "css/eventos.css"/>	
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
				
				
				
				<div id="eventos">

				<?php $login = isset($_SESSION['nombre']) ? $_SESSION['nombre'] : false;
				if (!is_null($lista->lista)){	
					for($c=($page*$numEventos); $c<($page+1)*$numEventos AND $c<$lista->contador; $c++){ 
						if($c<$lista->contador){ 
						//var_dump($lista->lista[$c]);
						?>
						
							<div class="evento" id="<?php $lista->lista[$c]->getId(); ?>">
								<div id=datos_evento_izquierda>
									<img id="logo-evento" src="<?php $lista->lista[$c]->getImagen() ?>">
									<ul>
										<li><a href="eventoX.php?id=<?php $lista->lista[$c]->getId() ?>"><?php $lista->lista[$c]->getTitulo() ?></a></li>
										<li><a href="usuario.php?nombre=<?php $lista->lista[$c]->getAutor() ?>"><?php $lista->lista[$c]->getAutor() ?></a></li>
										<li><p><?php $lista->lista[$c]->getPlataformas() ?></p></li>
									</ul>
								</div>
								<div id="descripcion">
									<p><?php $lista->lista[$c]->getTexto() ?></p>
								</div>
								<div id=datos_evento_derecha>
									<p><?php $lista->lista[$c]->getParticipantesAct() ?></p>
									<p><?php $lista->lista[$c]->getMaxParticipantes() ?></p>
								</div>
							</div>
						<?php 
						}
					}
					
				} else{
					echo "<div class='evento'>No hay mas eventos</div>";
				}
				?>
					
				</div>
				<div id="paginacion">
					<ul>
						<?php
							if (!is_null($lista->lista)){
								$max=($lista->contador)/$numEventos;
								for($i=0; $i<$max; $i++){
									$c=$i+1;
									echo "<li><a href='eventos.php?page=".$i."'>".$c."</a></li>";
								}
							}
						?>
					</ul>
				</div>
			</div><!-- FIN Contenido -->		
		
			
		
		</div> <!-- FIN Contenedor -->
	<?php require ('views/pie.html'); ?>
	</body>
</html>