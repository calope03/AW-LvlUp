<?php
require_once 'includes/config.php';
require_once __DIR__.'/includes/Contenido.php';
$cont= new \es\ucm\fdi\aw\Contenido();
if(isset($_POST['plataforma']))
{
	$plataforma = $_POST['plataforma'];
	$quizs= $cont -> cargaContenidoVisitadas($plataforma,"quiz");
}
else 
{
	$plataforma = array();
	$quizs= $cont -> cargaContenidoVisitadas($plataforma,"quiz");
}
$count =count($quizs);
$nomas=true;
?>
<!DOCTYPE HTML>
<hmtl>
	<head>
		<title> Quizs</title>
		<link rel = "stylesheet" type = "text/css" href = "css/reset.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/header.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/menucheck.css"/>
		<link rel = "stylesheet" type = "text/css" href = "css/quizs.css"/>		
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

			

			<div id="divClear"></div>
			<?php
				$cant=3;
				if(isset($_GET['pag'])){					
					$pag=$_GET['pag']-1;
					
					//$cantNoticias=$cantNoticias;
					if($count>0){
						for($i =($pag*$cant)+1; $i <= $count && $i <=$cant*($pag+1)   ; $i++) {
							$img = $quizs[$i]['imagen_portada'];
							$id = $quizs[$i]['id'];
							$titulo = $quizs[$i]['titulo'];
							$autor = $quizs[$i]['autor'];
							$fecha = $quizs[$i]['fecha'];
							$visitas = $quizs[$i]['visitas'];
							$valoracion = $quizs[$i]['valoracion'];
							list($year, $month, $day_time) = explode("-", $fecha);
							list($day) = explode(" ", $day_time);
							echo "	<div class = 'quiz'>
									<img id = 'imagen' src='".$img."'>
									<div id = 'contenido-quiz'>
										<h1><a href='quizX.php?id=".$id."'>".$titulo."</a></h1>
										<div id = 'datos-quiz'>
											<a id= 'usuario' href='usuario.php?nombre=$autor'>".$autor."</a>
											<p id ='fecha'>".$day."/".$month."/".$year."</p>
											<p id ='visitas'>".$visitas." veces vista</p>
											<p id ='visitas'>".$valoracion." puntos</p>
											
										</div>
									</div>
									</div>";
									$nomas=false;
									
						}/*<img id='ranking' src='img/Noticias/eval/5.png'>*/
						if($i > $count){echo "	<div class = 'quiz'>
									No hay mas quizs
							</div>";
							$nomas=true;}
					}else{
						echo "<div class = 'quiz'><p>Aun no hay quizs :( </p></div>";
					}
				}else{
					if($count>0){
						for($i = 1 ; $i <= $count && $i <=$cant; $i++) {
							$img = $quizs[$i]['imagen_portada'];
							$id = $quizs[$i]['id'];
							$titulo = $quizs[$i]['titulo'];
							$autor = $quizs[$i]['autor'];
							$fecha = $quizs[$i]['fecha'];
							$visitas = $quizs[$i]['visitas'];
							$valoracion = $quizs[$i]['valoracion'];
							list($year, $month, $day_time) = explode("-", $fecha);
							list($day) = explode(" ", $day_time);
							echo "	<div class = 'quiz'>
									<img id = 'imagen' src='".$img."'>
									<div id = 'contenido-quiz'>
										<h1><a href='quizX.php?id=".$id."'>".$titulo."</a></h1>
										<div id = 'datos-quiz'>
											<a id= 'usuario' href='usuario.php?nombre=$autor'>".$autor."</a>
											<p id ='fecha'>".$day."/".$month."/".$year."</p>
											<p id ='visitas'>".$visitas." veces vista</p>
											<p id ='visitas'>".$valoracion." puntos</p>
											
										</div>
									</div>
									</div>";
									$nomas=false;
						}/*<img id='ranking' src='img/Noticias/eval/5.png'>*/
						if($i > $count){echo "	<div class = 'quiz'>
									No hay mas quizs
							</div>";
							$nomas=true;}
					}else{
						echo "<div class = 'quiz'><p>Aun no hay quizs :( </p></div>";
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
						<li><a href='quizs-visitados.php?pag=2'>2</a></li>
						<li><a href='quizs-visitados.php?pag=3'>3</a></li>
						<li><a href='quizs-visitados.php?pag=4'>4</a></li>
						<li><a href='quizs-visitados.php?pag=5'>5</a></li>
						<li><a href='quizs-visitados.php?pag=2'>Siguiente</a></li>";
					}else{
						echo "<li><a href='quizs-visitados.php?pag=".$pag0."'>Anterior</a></li>
						<li><a href='' class='active'>".$pag."</a></li>
						<li><a href='quizs-visitados.php?pag=".$pag1."'>".$pag1."</a></li>
						<li><a href='quizs-visitados.php?pag=".$pag2."'>".$pag2."</a></li>
						<li><a href='quizs-visitados.php?pag=".$pag3."'>".$pag3."</a></li>
						<li><a href='quizs-visitados.php?pag=".$pag4."'>".$pag4."</a></li>
						<li><a href='quizs-visitados.php?pag=".$pag1."'>Siguiente</a></li>";
					}
				}else{
					echo "<li><a href=''>Anterior</a></li>
					<li><a href='' class='active'>1</a></li>
					<li><a href='quizs-visitados.php?pag=2'>2</a></li>
					<li><a href='quizs-visitados.php?pag=3'>3</a></li>
					<li><a href='quizs-visitados.php?pag=4'>4</a></li>
					<li><a href='quizs-visitados.php?pag=5'>5</a></li>
					<li><a href='quizs-visitados.php?pag=2'>Siguiente</a></li>";
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
						echo "<li><a href='quizs-visitados.php?pag=".$pag0."'>Anterior</a></li>
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