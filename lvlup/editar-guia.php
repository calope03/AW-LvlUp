<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/GuiasTrucos.php';
require_once __DIR__.'/includes/Usuario.php';

$guia = new \es\ucm\fdi\aw\GuiasTrucos();
$usuario = new \es\ucm\fdi\aw\Usuario();

$id = $_GET["id"];

$url = $_SERVER['REQUEST_URI'];
?>

<!DOCTYPE HTML>
<hmtl>
	<head>
		<title> Editar guía </title>
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

				<div id = "panelContenido">

					<div id="header-titulo-crearguia">
						<h1 id = "txt-cabecera"> Editar guía </h1>
					</div>

					<hr></hr>

					<div id="cuerpo-guia">
						<?php $guia->cargaGuia($id); 
						$rol = "";
						$nick = "";
						if (isset($_SESSION['nombre']))
						{
							$nick = $_SESSION['nombre'];
							$rol = $usuario->compruebaRol($nick);
							
						}

						if($rol == "administrador" || $rol == "editor" || ( ($rol == "escritor") && ($nick == $guia->getAutor()) )){ ?>
							<form action="crearEditarGuia.php" enctype="multipart/form-data" method="post">
								
								

								<img id="portada-juego-crear" src="<?php echo $guia->getImagen()?>">

								<div id="separador"></div>

								<strong>*Título del juego:</strong><br>
								<input type="text" name="título" value="<?php echo $guia->getTitulo() ?>" required="required"><br>
														
								<div id="separador"></div>
													
								<p> <strong> Contenido de la guía: </strong> </p>
								<?php  $texto = $guia->getTexto(); 
								$aparseado =str_replace("\"", "'", $texto); ?>

								<textarea id="cuadro-texto-guia" name="text" cols="100" rows="20"><?php echo $aparseado; ?></textarea>

								<script type="text/javascript">
								CKEDITOR.replace ("cuadro-texto-guia",{extraPlugins: 'imageuploader'});
								</script>

								<div id="separador"></div>

								<strong>Tags:</strong><br>
								<input type="text" name="tags" id="input-tags" placeholder="Otras etiquetas con las que quieras clasificar esta guía" required="required"><br /><br />
								
								<button id= "enviar" type="submit" > Guardar </button>
								<button id= "cancelar" type="button" onclick= "location.href = 'tusguias.php';">Cancelar</button>
								<input type='hidden' name='opcion' id='opcion' value = 'editar'/>
								<input type='hidden' name='id' id='id' value = "<?php echo $id; ?>" />
								
							</form>
						<?php }else{?>
								<p><h1>No tienes permiso para estar aquí</h1></p>
						<?php }?>

					</div> <!-- cuerpo guia-->

				</div> <!-- panel contenido-->

			</div> <!--FIN Contenido -->






		</div> <!-- FIN Contenedor -->
	<?php require ('views/pie.html'); ?>
	</body>
</html>