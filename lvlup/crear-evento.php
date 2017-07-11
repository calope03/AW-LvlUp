<?php
require_once __DIR__.'/includes/config.php';
require_once 'includes/Ficha.php';
$ficha= new \es\ucm\fdi\aw\Ficha();
?>
<!DOCTYPE HTML>
<hmtl>
	<head>
		<title> Crear evento </title>
		<link rel = "stylesheet" type = "text/css" href = "css/reset.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/header.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/crear-evento.css"/>	
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
				<form id="formulario" action="crearEditarEvento.php" method="post" enctype="multipart/form-data">
					<fieldset>
					    <legend>Crea tu Evento:</legend>

					    <label>Título</label>

					    <div id="divClear"></div>

						<input type="text" name="titulo" placeholder="Sin título" id="titulo" maxlength="100" required="required"/>

						<div id="divClear"></div>
						
						<label>Juego Asociado</label>

						<div id="divClear"></div>

						<select name="juego">
							<option value='ninguno'> --Selecciona Juego--</option> 
							<?php $ficha->comboJuegos();?>
						</select>
						<div id="divClear"></div>	
									
						<label>Foto para la portada:</label>

						<div id="divClear"></div>

						<input type="file" name="file" size="40" required="required">

						<div id="divClear"></div>

						<label>Descripcion del evento:</label>
						<textarea id="cuerpo-evento" maxlength="200" name="cuerpo-evento" cols="90" rows="15"s></textarea>
						<script type="text/javascript">
							CKEDITOR.replace ("cuerpo-evento",{extraPlugins: 'imageuploader'});
						</script>
		
					    <div id="divClear"></div>
						
						<label>Plataforma</label>

						<div id="divClear"></div>

						<input type="radio" name="plataforma" id="plataforma" value="PS4">PS4</input>
						<input type="radio" name="plataforma" id="plataforma" value="XBO">XBO</input>
						<input type="radio" name="plataforma" id="plataforma" value="PS3">PS3</input>
						<input type="radio" name="plataforma" id="plataforma" value="360">360</input>
						<input type="radio" name="plataforma" id="plataforma" value="WIIU">WIIU</input>
						<input type="radio" name="plataforma" id="plataforma" value="VITA">VITA </input>
						<input type="radio" name="plataforma" id="plataforma" value="3DS">3DS</input>
						<input type="radio" name="plataforma" id="plataforma" value="PC">PC</input>
						<input type="radio" name="plataforma" id="plataforma" value="ANDROID">ANDROID</input>
						<input type="radio" name="plataforma"  id="plataforma" value="OTROS">OTROS</input>
						
						<div id="divClear"></div>
						
						<label>Fecha Inicio</label>
						
						<input type="date" name="fechaInicio" step="1" value="">
							
						<label>Fecha Fin</label>
						
						<input type="date" name="fechaFin" step="1" value="">
						
						<div id="divClear"></div>
					
						<label>Numero Participantes</label>
						
						<input type="number" name="participantes" value="">
						
						<div id="divClear"></div>
						
						<div id="bloque_botones">
							<!--<input type="button" name="ver" value="Vista Previa"/> -->
							<input id="enviar" type="submit" value="Enviar"/>
							<input type="button" name="cancelar" value="Cancelar" onClick="location.href='sobremi.php'"/>
						</div>
						<input type="hidden" name="opcion" id="opcion" value = "crear"/>
				  	</fieldset>
				</form>
				<?php }else{?>
									<p><h1>No tienes permiso para estar aquí</h1></p>
							<?php } ?>	
				<div id="divClear"></div>
				
			</div><!-- FIN Contenido -->		
		</div> 
		</div> 
		</div> <!-- FIN Contenedor -->
	<?php require ('views/pie.html'); ?>
	</body>
</html>