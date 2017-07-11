<?php
require_once __DIR__.'/includes/config.php';
require_once 'includes/Ficha.php';
$ficha= new \es\ucm\fdi\aw\Ficha();
?>
<!DOCTYPE HTML>
<hmtl>
	<head>
		<title>LVLuP - Quiz</title>
		<link rel = "stylesheet" type = "text/css" href = "css/reset.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/header.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/crear-quizs.css"/>
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

			<div id="contenido">

				<div class="quizCrear">

					<div class="headerCrear">
						<span class="destacIcon" style="background-image:url(img/index/quizs.png)"></span>
						<!--<img class="destacIcon" src="img/index/quizs.png">-->
						<p class="destacTitle">Crear quiz</p>	
					</div>

					<div class="content">
					<?php 
							if (isset($_SESSION['nombre'])){ ?>
						<form action="gestiona-crear-quiz.php" method="post" enctype="multipart/form-data">
							<section id="detalles">
								<h1>Detalles</h1>
								<p>	
									<span>Título</span>
									<input type="text" name="titulo" value="" required="required" placeholder="Introduce un título" />
								</p>
								<label>Juego Asociado</label>

								<div id="divClear"></div>

								<select name="juego">
									<option value='ninguno'> --Selecciona Juego--</option> 
									<?php $ficha->comboJuegos();?>
								</select>
								<div id="divClear"></div>	
								<p>
									<span>Imagen</span>
									<input type="file" name="file" required="required"/>
								</p>
								<p>
									<span>Descripción</span>
									<textarea rows="4" cols="50" name="descripcion" required="required" placeholder="Introduce una breve descripción para presentar tu quiz"></textarea>
								</p>

							</section>

							<div class="test">
								<h1>Preguntas</h1>
			
								<?php
									
									for($i = 0; $i < 10; $i++)
									{
										echo "<p><span>Pregunta ".($i+1).":</span>";
										if($i === 0){//obligamos a que rellene al menos la primera pregunta
											echo "<input type='text' name='pregunta".$i."' value='' required='required' placeholder='Introduce la pregunta ".($i+1)."' /></p>";
										}
										else{
											echo "<input type='text' name='pregunta".$i."' value='' placeholder='Introduce la pregunta ".($i+1)."' /></p>";
										}										  
											for($j = 0; $j < 4; $j++)
											{
												echo "<p><span>Opción ".($j+1).":</span>";
												
												if($i === 0){//obligamos a que rellene las opciones de al menos la primera pregunta
													echo "<input type='text' name='p".$i."opcion".$j."' value='' required='required' placeholder='Introduce opción ".($j+1)."' /></p>";
												}
												else{
													echo "<input type='text' name='p".$i."opcion".$j."' value='' placeholder='Introduce opción ".($j+1)."' /></p>";
												}
												
											}
											
											echo "Selecciona el número de la respuesta correcta: </br>
											<input type='radio' id = 'radio' name='respuestap".$i."' value='1' checked />Opción 1</br>
											<input type='radio' id = 'radio' name='respuestap".$i."' value='2' />Opción 2</br>
											<input type='radio' id = 'radio' name='respuestap".$i."' value='3' />Opción 3</br>
											<input type='radio' id = 'radio' name='respuestap".$i."' value='4' />Opción 4";
											
											
										echo "<hr></hr>";
									}
								?>
									
								<input id="btn-quizCrear" type="submit" value="Crear"/>
								<input type="button" name="cancelar" value="Cancelar" onClick="location.href='sobremi.php'"/>
								
							</div>
						</form>	
						<?php }else{?>
									<p><h1>No tienes permiso para estar aquí</h1></p>
							<?php } ?>	
					</div>

				</div>

			</div><!-- FIN Contenido -->		
		
		</div> <!-- FIN Contenedor -->
	<?php require ('views/pie.html'); ?>
	</body>
</html>