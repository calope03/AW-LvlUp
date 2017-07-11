<?php
require_once 'includes/config.php';
require_once __DIR__.'/includes/Contenido.php';
$cont= new \es\ucm\fdi\aw\Contenido();
if(isset($_POST['plataforma']))
{
	$plataforma = $_POST['plataforma'];
	$guias= $cont -> cargaContenidoPopulares($plataforma,"guia");
}
else 
{
	$plataforma = array();
	$guias= $cont -> cargaContenidoPopulares($plataforma,"guia");
}
$count =count($guias);
$nomas=true;
?>

<!DOCTYPE HTML>
<hmtl>
	<head>
		<title> Más populares - Guías y Trucos </title>
		<link rel = "stylesheet" type = "text/css" href = "css/reset.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/header.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/menucheck.css"/>
		<link rel = "stylesheet" type = "text/css" href = "css/contenido-guiastrucos.css"/>	
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
				<?php require ('views/menucheck.php'); ?>
					
				
					<div id = "panelContenido">
				
						
						<h1> Guías mejor valoradas: </h1>
						
						<hr></hr>
						<div id="guias-mejor-valoradas">
					
						<div id="fila-guia">
						
						<?php
					$cantGuias=3;
					if(isset($_GET['pag'])){					
						$pag=$_GET['pag']-1;
						
						if($count>0){
							for($i =($pag*$cantGuias)+1; $i <= $count && $i <=$cantGuias*($pag+1)   ; $i++) {
								$img = $guias[$i]['imagen_portada'];
								$id = $guias[$i]['id'];
								$titulo = $guias[$i]['titulo'];
								$autor = $guias[$i]['autor'];
								$visitas = $guias[$i]['visitas'];
								$valoraciones = $guias[$i]['valoracion'];
								
								echo "	<div id='fila-guia'>
											<a href='guia.php?id=".$id."'>
												<img id='portada-juego' src='".$img."'>
											</a>
											
											<div id = 'descripcion-guia'>
												<h1><a href='guia.php?id=".$id."'>".$titulo."</a></h1>
												<a id= 'usuario' href='usuario.php?nombre=$autor'>".$autor."</a>
												<p id ='visitas'>".$visitas." veces vista</p>
												<p id ='visitas'>".$valoraciones." puntos</p>
			
											</div>
										</div>
										<div id='separador'></div>
										<hr></hr>";
										$nomas=false;
							}
							if($i > $count){echo "	<div class = 'fila-guia'>
										No hay mas guias
								</div>";
								$nomas=true;}
						}else{
							echo "<div class = 'fila-guia'><p>Aun no hay guias :( </p></div>";
						}
					}else{
						if($count>0){
							for($i = 1 ; $i <= $count && $i <=$cantGuias   ; $i++) {
								$img = $guias[$i]['imagen_portada'];
								$id = $guias[$i]['id'];
								$titulo = $guias[$i]['titulo'];
								$autor = $guias[$i]['autor'];
								$visitas = $guias[$i]['visitas'];
								$valoraciones = $guias[$i]['valoracion'];
								
								echo "	<div id='fila-guia'>
											<a href='guia.php?id=".$id."'>
												<img id='portada-juego' src='".$img."'>
											</a>
											
											<div id = 'descripcion-guia'>
												<h1><a href='guia.php?id=".$id."'>".$titulo."</a></h1>
												<a id= 'usuario' href='usuario.php?nombre=$autor'>".$autor."</a>
												<p id ='visitas'>".$visitas." veces vista</p>
												<p id ='visitas'>".$valoraciones." puntos</p>
			
											</div>
										</div>
										<div id='separador'></div>
										<hr></hr>";
										$nomas=false;
							}
							if($i > $count){echo "	<div class = 'fila-guia'>
										No hay mas guias
								</div>";
								$nomas=true;}
						}else{
							echo "<div class = 'fila-guia'><p>Aun no hay guias :( </p></div>";
						}
					}	

				?>
				</div>
											
				</div>
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
										<li><a href='valoradas-guiastrucos.php?pag=2'>2</a></li>
										<li><a href='valoradas-guiastrucos.php?pag=3'>3</a></li>
										<li><a href='valoradas-guiastrucos.php?pag=4'>4</a></li>
										<li><a href='valoradas-guiastrucos.php?pag=5'>5</a></li>
										<li><a href='valoradas-guiastrucos.php?pag=2'>Siguiente</a></li>";
									}else{
										echo "<li><a href='novedades-guiastrucos.php?pag=".$pag0."'>Anterior</a></li>
										<li><a href='' class='active'>".$pag."</a></li>
										<li><a href='valoradas-guiastrucos.php?pag=".$pag1."'>".$pag1."</a></li>
										<li><a href='valoradas-guiastrucos.php?pag=".$pag2."'>".$pag2."</a></li>
										<li><a href='valoradas-guiastrucos.php?pag=".$pag3."'>".$pag3."</a></li>
										<li><a href='valoradas-guiastrucos.php?pag=".$pag4."'>".$pag4."</a></li>
										<li><a href='valoradas-guiastrucos.php?pag=".$pag1."'>Siguiente</a></li>";
									}
								}else{
									echo "<li><a href=''>Anterior</a></li>
									<li><a href='' class='active'>1</a></li>
									<li><a href='valoradas-guiastrucos.php?pag=2'>2</a></li>
									<li><a href='valoradas-guiastrucos.php?pag=3'>3</a></li>
									<li><a href='valoradas-guiastrucos.php?pag=4'>4</a></li>
									<li><a href='valoradas-guiastrucos.php?pag=5'>5</a></li>
									<li><a href='valoradas-guiastrucos.php?pag=2'>Siguiente</a></li>";
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
										echo "<li><a href='valoradas-guiastrucos.php?pag=".$pag0."'>Anterior</a></li>
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

				
			</div> <!--FIN Contenido -->	




			
		
		</div> <!-- FIN Contenedor -->
	<?php require ('views/pie.html'); ?>
	</body>
</html>