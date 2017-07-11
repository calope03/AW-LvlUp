<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/Noticia.php';
$id = $_GET["id"];
$noticia= new \es\ucm\fdi\aw\Noticia();
$url = $_SERVER['REQUEST_URI'];
?>
<!DOCTYPE HTML>
<hmtl>
	<head>
		<title> NoticiaX </title>
		<link rel = "stylesheet" type = "text/css" href = "css/reset.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/header.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/noticiaX.css"/>	
		<link rel = "stylesheet" type = "text/css" href = "css/sidebar.css" />		
		<link rel = "stylesheet" type = "text/css" href = "css/pie.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/comentarios.css"/>	
		<!--<link rel = "stylesheet" type = "text/css" href = "css/valoracion-estrellas.css" />*-->
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
			function eliminarNoticia(id){
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
				<div id="noticiaX">
					<?php
						$nick="";
						if (isset($_SESSION['nombre']))
						{
							$nick = $_SESSION['nombre'];
						}
						//echo $noticia::prueba();
						echo $noticia->cargaNoticia($id, $nick, $url);
					?>
				</div>
				<?php require ('views/comentarios.php'); ?>
			</div><!-- FIN Contenido -->

		
		</div> <!-- FIN Contenedor -->
	<?php require ('views/pie.html'); ?>
	</body>
</html>