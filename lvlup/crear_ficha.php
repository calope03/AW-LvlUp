<?php
require_once __DIR__.'/includes/config.php';
?>
<!DOCTYPE HTML>
<hmtl>
<head>
	<title> Crear ficha </title>
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
							if (isset($_SESSION['nombre'])){ ?>
				<form action="crearjuego.php" method="post" enctype="multipart/form-data">
					<fieldset>
					    <legend>Crea la ficha de un juego:</legend>

					    <label>Nombre del juego:</label>

					    <div id="divClear"></div>

						<input type="text" name="nombre" placeholder="Sin título" id="titulo" maxlength="100" required="required"/>

						<label>Año del juego:</label>

					    <div id="divClear"></div>

						<input type="text" name="año" placeholder="Año de creacion"  maxlength="4" required="required"/>
						
						<div id="divClear"></div>
						
						<label>Desarrolladora:</label>

					    <div id="divClear"></div>

						<input type="text" name="desarrolladora" placeholder="Desarrolladora"  maxlength="50" required="required"/>
						
						<div id="divClear"></div>
						<label>Caratula del juego:</label>

						<div id="divClear"></div>

						<input type="file" name="file" size="40" required="required">

						<div id="divClear"></div>

						<label>Plataformas:</label>

					    <div id="divClear"></div>

						<input type="text" name="plataformas" placeholder="Separadas por comas" id="titulo" maxlength="100" required="required"/>
						
						<label>Edad minima:</label>
						
						<div id="divClear"></div>

						  <input type="radio" name="edad" value="3" checked> 3
						  <input type="radio" name="edad" value="7"> 7
						  <input type="radio" name="edad" value="12"> 12 
						  <input type="radio" name="edad" value="16"> 16 
						  <input type="radio" name="edad" value="18"> 18  

					    <div id="divClear"></div>

						<div id="bloque_botones">
							<!--<input type="button" name="ver" value="Vista Previa"/> -->
							<input id="enviar" type="submit" value="Enviar"/>
							<input type="button" name="cancelar" value="Cancelar" onClick="location.href='sobremi.php'"/>
						</div>
					
				  	</fieldset>
				</form>
				
							<?php }else{?>
									<p><h1>No tienes permiso para estar aquí</h1></p>
							<?php } ?>	
				<div id="divClear"></div>
				
			</div><!-- FIN Contenido -->		
		</div> <!-- FIN Contenedor -->
	<?php require ('views/pie.html'); ?>
</body>
</html>