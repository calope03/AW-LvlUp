<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/Noticia.php';
$id = $_GET["id"];
$noticia= new \es\ucm\fdi\aw\Noticia();
?>
<!DOCTYPE HTML>
<hmtl>
	<head>
		<title> Editar noticia </title>
		<link rel = "stylesheet" type = "text/css" href = "css/reset.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/header.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/crear_noticia.css"/>	
		<link rel = "stylesheet" type = "text/css" href = "css/sidebar.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/pie.css" />
		<script defer type="text/javascript" src="js/registro.js"></script>	
		<script defer type="text/javascript" src="js/busquedaAvanzada.js"></script>
		<script src="js/jquery-1.12.2.min.js"></script>	
		<meta http-equiv="Content-Type" content="text/html; charset= utf-8"/>
		<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
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
					echo $noticia -> cargaFormNoticia($id);
					
				?>
				<script type='text/javascript'>
					CKEDITOR.replace ("cuerpo-noticia",{extraPlugins: 'imageuploader'});
				</script>
				<div id="divClear"></div>
				
			</div><!-- FIN Contenido -->		
		
		
		</div> <!-- FIN Contenedor -->
	<?php require ('views/pie.html'); ?>
	</body>
</html>