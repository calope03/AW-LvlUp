<?php
require_once __DIR__.'/includes/config.php';
require_once 'includes/Ficha.php';
$ficha= new \es\ucm\fdi\aw\Ficha();
?>

<!DOCTYPE HTML>
<hmtl>
	<head>
		<title> Crear guía </title>
		<link rel = "stylesheet" type = "text/css" href = "css/reset.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/header.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/editar-crear-guia.css"/>
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

					

					<div id="cuerpo-guia">

						

						<?php 
							if (isset($_SESSION['nombre'])){ ?>
								<!--<img id="portada-juego-crear" src="img/crear-guia/inserta-caratula.jpg">

								<div id="separador"></div>-->

								<form action="crearEditarGuia.php" enctype="multipart/form-data" method="post">
								<div id="header-titulo-crearguia">
									<h1 id = "txt-cabecera"> Crear nueva guía </h1>
								</div>
								<hr></hr>

									<label>Juego Asociado</label>

									<div id="divClear"></div>

									<select name="juego">
										<option value='ninguno'> --Selecciona Juego--</option> 
										<?php $ficha->comboJuegos();?>
									</select>
									<div id="divClear"></div>									
									
									<p>	Portada para tu guía:<br><input type="file" name="file" size="40" required="required"></p>
												
									<strong>*Título del juego:</strong><br>
									<input type="text" name="título" placeholder="Título para el juego de tu guía" required="required"><br>
															
									<div id="separador"></div>
														
									<p> <strong> Contenido de la guía: </strong> </p>
									
									<textarea id="cuadro-texto-guia" name="text" cols="100" rows="20"></textarea>
									<script type="text/javascript">
									CKEDITOR.replace ("cuadro-texto-guia",{extraPlugins: 'imageuploader'});
									</script>

									<div id="separador"></div>

									<strong>Tags:</strong><br>
									<input type="text" name="tags" id="input-tags" placeholder="Otras etiquetas con las que quieras clasificar esta guía" required="required"><br/><br/>
									
									<button id= "enviar" type="submit" > Enviar </button>
									<button id= "cancelar" type="button" onclick= "location.href = 'sobremi.php';">Cancelar</button>
									<input type="hidden" name="opcion" id="opcion" value = "crear"/>

								</form>
							<?php }else{?>
									<p><h1>No tienes permiso para estar aquí</h1></p>
							<?php } ?>	

					</div> <!-- cuerpo guia-->

				</div> <!-- panel contenido-->

			</div> <!--FIN Contenido -->
		</div> <!-- FIN Contenedor -->
	<?php require ('views/pie.html'); ?>
	</body>
</html>