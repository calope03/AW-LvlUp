<?php
require_once 'includes/config.php';
require_once 'includes/Review.php';
$id = $_GET["id"];
$review = new \es\ucm\fdi\aw\Review();
?>
<!DOCTYPE HTML>
<hmtl>
	<head>
		<title> Editar review </title>
		<link rel = "stylesheet" type = "text/css" href = "css/reset.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/header.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/editar-crear-review-guia.css"/>
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
					echo $review -> cargaFormReview($id);
				?>
				<script type='text/javascript'>
					CKEDITOR.replace ("cuerpo-review",{extraPlugins: 'imageuploader'});
				</script>
				
				<div id="divClear"></div>
			</div> <!--FIN Contenido -->
		</div> <!-- FIN Contenedor -->
<?php require ('views/pie.html'); ?>
	</body>
</html>