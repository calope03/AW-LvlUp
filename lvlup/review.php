<?php
//session_start();
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/Review.php';
$id = $_GET["id"];
$review = new \es\ucm\fdi\aw\Review();
$url = $_SERVER['REQUEST_URI'];
?>
<!DOCTYPE html>
<hmtl>
	<head>
		<title> Reviews </title>
		<link rel = "stylesheet" type = "text/css" href = "css/reset.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/header.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/review.css"/>	
		<link rel = "stylesheet" type = "text/css" href = "css/sidebar.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/pie.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/comentarios.css"/>
		<script defer type="text/javascript" src="js/registro.js"></script>	
		<script defer type="text/javascript" src="js/busquedaAvanzada.js"></script>
		<script src="js/jquery-1.12.2.min.js"></script>	
		<meta http-equiv="Content-Type" content="text/html; charset= utf-8"/>
		
		<script type="text/javascript">
			function rechazarcont(id){
				var b=confirm('¿Deseas rechazar este contenido?');
				   if (b){
					   var pagina= "rechazarcontenido.php?id=" + id;
					 window.location.href = pagina; //página web a la que te redirecciona si confirmas la eliminación
				   }else{
				  //Y aquí pon cualquier cosa que quieras que salga si le diste al boton de cancelar
				   return false;}
			}
			function eliminarReview(id){
				var eliminar=confirm('¿Deseas eliminar este contenido?');
				   if (eliminar){
					   var pagina= "borrarcontenido.php?id=" + id;
					 window.location.href = pagina; //página web a la que te redirecciona si confirmas la eliminación
				   }else{
				  //Y aquí pon cualquier cosa que quieras que salga si le diste al boton de cancelar
				   return false;}
			}
			function publicarcont(id){
				var a=confirm('¿Deseas publicar este contenido?');
				   if (a){
					   var pagina= "publicarcontenido.php?id=" + id;
					 window.location.href = pagina; //página web a la que te redirecciona si confirmas la eliminación
				   }else{
				  //Y aquí pon cualquier cosa que quieras que salga si le diste al boton de cancelar
				   return false;}
			}
			
			
		
		</script>
		
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
				<div id="review">
					
					<?php
						$nick="";
						if (isset($_SESSION['nombre']))
						{
							$nick = $_SESSION['nombre'];
						}
						echo $review->cargaReview($id, $nick, $url);
					?>
					
				
				<?php require ('views/comentarios.php'); ?>
			</div>
		</div> <!-- FIN Contenedor -->
	<?php require ('views/pie.html'); ?>
	</body>
</html>