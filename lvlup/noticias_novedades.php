<?php
require_once 'includes/config.php';
require_once __DIR__.'/includes/Contenido.php';
$cont= new \es\ucm\fdi\aw\Contenido();
if(isset($_POST['plataforma']))
{
	$plataforma = $_POST['plataforma'];
	$noticias= $cont -> cargaContenidoRecientes($plataforma,"noticia");
}
else 
{
	$plataforma = array();
	$noticias= $cont -> cargaContenidoRecientes($plataforma,"noticia");
}
$count =count($noticias);
$nomas=true;
?>
<!DOCTYPE HTML>
<hmtl>
	<head>
		<title> Noticias</title>
		<link rel = "stylesheet" type = "text/css" href = "css/reset.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/header.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/menucheck.css"/>
		<link rel = "stylesheet" type = "text/css" href = "css/noticias.css"/>	
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
<div id="contenedor">
	
		<?php require ('views/menu-derecha.php'); ?>

		<div id="divClear"></div>

		<div id="contenido">

			<?php require ('views/menucheck.php'); ?>

			<div id="divClear"></div>
			<?php
				$cantNoticias=3;
				if(isset($_GET['pag'])){					
					$pag=$_GET['pag']-1;
					
					//$cantNoticias=$cantNoticias;
					if($count>0){
						for($i =($pag*$cantNoticias)+1; $i <= $count && $i <=$cantNoticias*($pag+1)   ; $i++) {
							$img = $noticias[$i]['imagen_portada'];
							$id = $noticias[$i]['id'];
							$titulo = $noticias[$i]['titulo'];
							$autor = $noticias[$i]['autor'];
							$fecha = $noticias[$i]['fecha'];
							$visitas = $noticias[$i]['visitas'];
							$valoracion = $noticias[$i]['valoracion'];
							list($year, $month, $day_time) = explode("-", $fecha);
							list($day) = explode(" ", $day_time);
							echo "	<div class = 'noticia'>
									<div class = 'imgNoticia'>
									<img src='".$img."'>
									</div>
									<div id = 'contenido-noticia'>
										<h1><a href='noticiaX.php?id=".$id."'>".$titulo."</a></h1>
										<div id = 'datos-noticia'>
											<a id= 'usuario' href='usuario.php?nombre=$autor'>".$autor."</a>
											<p id ='fecha'>".$day."/".$month."/".$year."</p>
											<p id ='visitas'>".$visitas." veces vista</p>
											<p id ='visitas'>".$valoracion." puntos</p>
											
										</div>
									</div>
									</div>";
									$nomas=false;
									
						}/*<img id='ranking' src='img/Noticias/eval/5.png'>*/
						if($i > $count){echo "	<div class = 'noticia'>
									No hay mas noticias
							</div>";
							$nomas=true;}
					}else{
						echo "<div class = 'noticia'><p>Aun no hay noticias :( </p></div>";
					}
				}else{
					if($count>0){
						for($i = 1 ; $i <= $count && $i <=$cantNoticias   ; $i++) {
							$img = $noticias[$i]['imagen_portada'];
							$id = $noticias[$i]['id'];
							$titulo = $noticias[$i]['titulo'];
							$autor = $noticias[$i]['autor'];
							$fecha = $noticias[$i]['fecha'];
							$visitas = $noticias[$i]['visitas'];
							$valoracion = $noticias[$i]['valoracion'];
							list($year, $month, $day_time) = explode("-", $fecha);
							list($day) = explode(" ", $day_time);
							echo "	<div class = 'noticia'>
									<div class = 'imgNoticia'>
									<img src='".$img."'>
									</div>
									<div id = 'contenido-noticia'>
										<h1><a href='noticiaX.php?id=".$id."'>".$titulo."</a></h1>
										<div id = 'datos-noticia'>
											<a id= 'usuario' href='usuario.php?nombre=$autor'>".$autor."</a>
											<p id ='fecha'>".$day."/".$month."/".$year."</p>
											<p id ='visitas'>".$visitas." veces vista</p>
											<p id ='visitas'>".$valoracion." puntos</p>
											
										</div>
									</div>
									</div>";
									$nomas=false;
						}/*<img id='ranking' src='img/Noticias/eval/5.png'>*/
						if($i > $count){echo "	<div class = 'noticia'>
									No hay mas noticias
							</div>";
							$nomas=true;}
					}else{
						echo "<div class = 'noticia'><p>Aun no hay noticias :( </p></div>";
					}
				}	
			?>
			<div id="paginacion">
			<ul>
			<?php
			if(!$nomas){
				if(isset($_GET['pag'])){
					$pag=$_GET['pag']+0;
					$pag0= $pag-1;$pag1=$pag +1;$pag2=$pag1 +1;$pag3=$pag2 +1;$pag4=$pag3 +1;
					if($pag==1){
						echo "<li><a href=''>Anterior</a></li>
						<li><a href='' class='active'>1</a></li>
						<li><a href='noticias_novedades.php?pag=2'>2</a></li>
						<li><a href='noticias_novedades.php?pag=3'>3</a></li>
						<li><a href='noticias_novedades.php?pag=4'>4</a></li>
						<li><a href='noticias_novedades.php?pag=5'>5</a></li>
						<li><a href='noticias_novedades.php?pag=2'>Siguiente</a></li>";
					}else{
						echo "<li><a href='noticias_novedades.php?pag=".$pag0."'>Anterior</a></li>
						<li><a href='' class='active'>".$pag."</a></li>
						<li><a href='noticias_novedades.php?pag=".$pag1."'>".$pag1."</a></li>
						<li><a href='noticias_novedades.php?pag=".$pag2."'>".$pag2."</a></li>
						<li><a href='noticias_novedades.php?pag=".$pag3."'>".$pag3."</a></li>
						<li><a href='noticias_novedades.php?pag=".$pag4."'>".$pag4."</a></li>
						<li><a href='noticias_novedades.php?pag=".$pag1."'>Siguiente</a></li>";
					}
				}else{
					echo "<li><a href=''>Anterior</a></li>
					<li><a href='' class='active'>1</a></li>
					<li><a href='noticias_novedades.php?pag=2'>2</a></li>
					<li><a href='noticias_novedades.php?pag=3'>3</a></li>
					<li><a href='noticias_novedades.php?pag=4'>4</a></li>
					<li><a href='noticias_novedades.php?pag=5'>5</a></li>
					<li><a href='noticias_novedades.php?pag=2'>Siguiente</a></li>";
				}
			}else{
				if(isset($_GET['pag'])){
					$pag=$_GET['pag']+0;
					$pag0= $pag-1;$pag1=$pag +1;$pag2=$pag1 +1;$pag3=$pag2 +1;$pag4=$pag3 +1;
					if($pag==1){
						echo "<li><a href=''>Anterior</a></li>
						<li><a href='' class='active'>1</a></li>
						<li><a href=''>2</a></li>
						<li><a href=''>3</a></li>
						<li><a href=''>4</a></li>
						<li><a href=''>5</a></li>
						<li><a href=''>Siguiente</a></li>";
					}else{
						echo "<li><a href='noticias_novedades.php?pag=".$pag0."'>Anterior</a></li>
						<li><a href='' class='active'>".$pag."</a></li>
						<li><a href=''>".$pag1."</a></li>
						<li><a href=''>".$pag2."</a></li>
						<li><a href=''>".$pag3."</a></li>
						<li><a href=''>".$pag4."</a></li>
						<li><a href=''>Siguiente</a></li>";
					}
				}else{
					echo "<li><a href=''>Anterior</a></li>
					<li><a href='' class='active'>1</a></li>
					<li><a href=''>2</a></li>
					<li><a href=''>3</a></li>
					<li><a href=''>4</a></li>
					<li><a href=''>5</a></li>
					<li><a href=''>Siguiente</a></li>";
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