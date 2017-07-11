<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/Busqueda.php';

if($_POST['busqueda']) {

	$palabra  = $_POST['busqueda'];
	$palabra = htmlspecialchars(trim(strip_tags($palabra)));
	$busqueda = new \es\ucm\fdi\aw\Busqueda();
	$arraycont= $busqueda->busqueda($palabra);
	//echo var_dump($resultado);
}


?>
<!DOCTYPE HTML>
<hmtl>
	<head>
		<title>LVLuP</title>
		<link rel = "stylesheet" type = "text/css" href = "css/reset.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/header.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/busqueda.css"/>	
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
			<?php
					
			$count =count($arraycont);
			for($i =1; $i <= $count; $i++) {
				$img = $arraycont[$i]['imagen_portada'];
				$id = $arraycont[$i]['id'];
				$titulo = $arraycont[$i]['titulo'];
				$autor = $arraycont[$i]['autor'];
				$fecha = $arraycont[$i]['fecha'];
				$visitas = $arraycont[$i]['visitas'];
				$valoracion = $arraycont[$i]['valoracion'];
				$categoria = $arraycont[$i]['categoria'];
				$publicado= $arraycont[$i]['publicado'];
				list($year, $month, $day_time) = explode("-", $fecha);
				list($day) = explode(" ", $day_time);
				echo "	<div class = 'articulo'>	
				
				<img id = 'imagen' src='".$img."'>
				
				<div id = 'contenido-articulo'>					
					";
					if($categoria=="noticia"){
						echo "<h1><a href='noticiaX.php?id=".$id."'>".$titulo."</a></h1>";
					}else if($categoria=="review"){
						echo "<h1><a href='review.php?id=".$id."'>".$titulo."</a></h1>";
					}else if($categoria=="quiz"){
						echo "<h1><a href='quizX.php?id=".$id."'>".$titulo."</a></h1>";
					}else if($categoria=="evento"){
						echo "<h1><a href='eventoX.php?id=".$id."'>".$titulo."</a></h1>";
					}else if($categoria=="guia"){
						echo "<h1><a href='guia.php?id=".$id."'>".$titulo."</a></h1>";
					}
					echo"<div id = 'datos-articulo'>	
					<a id= 'usuario' href='usuario.php?nombre=".$autor."'>".$autor."</a>
						<p id ='fecha'>Tipo: ".$categoria."</p>
						<p id ='fecha'>".$day."/".$month."/".$year."</p>
						<div id='divClear'></div>
					</div>
						<div id='divClear'></div>
					</div>
					<div id='divClear'></div>
					</div><div id='divClear'></div>";}
					if($count==0){
						echo "<div id='contenido'><div class = 'articulo'><h1>No se han encontrado coincidencias</h1></div></div>";
					}
					?>
					
				<div style="clear: both"></div>
				</div>
				
			</div><!-- FIN Contenido -->		
		
		</div> <!-- FIN Contenedor -->

		<?php require ('views/pie.html'); ?>
	</body>
</html>