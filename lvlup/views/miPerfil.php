<?php
require_once 'includes/config.php';
require_once 'includes/Usuario.php';
$usuario= new \es\ucm\fdi\aw\Usuario();
if(isset($_SESSION['nombre'])){
	$user=$usuario->dameUsuario($_SESSION['nombre']);
	$rol=$user['rol'];
	$imagen=$user['ruta_avatar'];
	
	//echo var_dump($rol);
}
?>
<!-- Cabecera -->
<header>
	<div id="caja-logo" onclick = location.href="index.php" style="cursor:pointer" >
		<img id="logo" src="img/logo.png">
		<img id="titulo" src="img/titulo.png">
	</div>
	
	<div id="caja-avatar">	
		<div id="botones">
			<a href = "index.php"><button id="buttonPerfil">Pagina Principal</button></a>
			<a href = "cerrarSesion.php"><button id="buttonSesion">Cerrar Sesión</button></a>
		</div>	
		<?php echo "<a href = ''><img id='default-avatar' src='".$imagen."' /></a>"; ?>
				
	</div>
	
	<!-- === Buscador Avanzado === -->
		<div id="buscadorAvanzado">
		<div id="buscadorAvanzadoHeader" onclick="abrirBuscadorAvanzado()">
			<div id="tituloBuscadorAvanzado">
				<p>Busqueda Avanzada</p>
			</div>
			<div id="abrirBuscadorAvanzado">></div>
		</div>
		<div id="buscadorAvanzadoContent">
			<form>
				<section id="buscadorBotones">
					<p>
						<input type="text" name="usuario" value="" placeholder="Introduce Categoria" />
					</p>
					<p>
						<input type="text" name="email" value="" placeholder="Introduce Consola" />
					</p>
					<p>
						<input type="text" name="contrasena" value="" placeholder="Introduce Juego" />
					</p>
				</section>

				<section id="opcionesBuscador">
					<fieldset>
						<legend> Filtrar por: </legend>
						<p>
							<input type="radio" name="opciones" value="ps4"/>Más populares
						</p>
						<p>
							<input type="radio" name="opciones" value="xbox"/>Más valoradas
						</p>
					</fieldset>		
					<input type="button" id="btnBuscadorAvanzado" onclick="busquedaAvanzada()" value="Buscar" />		
				</section>
			</form>
		</div>
	</div>

	<div id="tuPerfil"> <p>Informacion de tu perfil</p></div>
	<div id="divClear"></div>
	<div id="informacion">
<?php	
		echo "<img id='imagenPerfil' src='".$user['ruta_avatar']."' />
		<div id='descripcion'>
			<p> <em>Nick:</em> ".$user['nick']."</p>
			<p> <em>Rol:</em> ".$user['rol']." ".$user['nivel']."</p>
			<p>	<em>Correo:</em> ".$user['correo']." </p>
			<p> <em>Valoraciones positivas:</em> ".$user['experiencia']."</p>
			<div id='divClear'></div>
		</div>";
		
		

if($rol=="registrado"){
 echo "<div id='menu-navegacion'>
			<div id='navegacion'>
				<ul>
					<li>
						<a id='menu-sobremi' href='sobremi.php'>Sobre mi</a>
					</li>
				</ul>
			</div>			
		</div>";
}elseif($rol=="escritor"){
	echo "<div id='menu-navegacion'>
			<div id='navegacion'>
				<ul>
					<li>
						<a id='menu-sobremi' href='sobremi.php'>Sobre mi</a>
					</li>
					<li>
						<a href='moderado.php'>Moderado</a>
						<ul>
							<li><a href='moderado.php?categoria=noticia'>Noticias</a></li>
							<li><a href='moderado.php?categoria=review'>Reviews</a></li>
							<li><a href='moderado.php?categoria=quiz'>Quizs</a></li>
							<li><a href='moderado.php?categoria=evento'>Eventos</a></li>
							<li><a href='moderado.php?categoria=guia'>Guias</a></li>
						</ul>
					</li>
					<li>
						<a href='sinmoderar.php'>Sin moderar</a>
						<ul>
							<li><a href='sinmoderar.php?categoria=noticia'>Noticias</a></li>
							<li><a href='sinmoderar.php?categoria=review'>Reviews</a></li>
							<li><a href='sinmoderar.php?categoria=quiz'>Quizs</a></li>
							<li><a href='sinmoderar.php?categoria=evento'>Eventos</a></li>
							<li><a href='sinmoderar.php?categoria=guia'>Guias</a></li>
						</ul>
					</li>
					<li>
						<a href=''>Crear</a>
						<ul>
							<li><a href='crear_noticia.php'>Noticias</a></li>
							<li><a href='crear-review.php'>Reviews</a></li>
							<li><a href='crear-quiz.php'>Quizs</a></li>
							<li><a href='crear-evento.php'>Eventos</a></li>
							<li><a href='crear-guia.php'>Guias</a></li>
						</ul>
					</li>
				</ul>
			</div>
			
		</div>";
}elseif($rol=="editor"){
	echo "<div id='menu-navegacion'>
			<div id='navegacion'>
				<ul>
					<li>
						<a id='menu-sobremi' href='sobremi.php'>Sobre mi</a>
					</li>
					<li>
						<a href='moderado.php'>Moderado</a>
						<ul>
							<li><a href='moderado.php?categoria=noticia'>Noticias</a></li>
							<li><a href='moderado.php?categoria=review'>Reviews</a></li>
							<li><a href='moderado.php?categoria=quiz'>Quizs</a></li>
							<li><a href='moderado.php?categoria=evento'>Eventos</a></li>
							<li><a href='moderado.php?categoria=guia'>Guias</a></li>
						</ul>
					</li>
					<li>
						<a href='sinmoderar.php'>Sin moderar</a>
						<ul>
							<li><a href='sinmoderar.php?categoria=noticia'>Noticias</a></li>
							<li><a href='sinmoderar.php?categoria=review'>Reviews</a></li>
							<li><a href='sinmoderar.php?categoria=quiz'>Quizs</a></li>
							<li><a href='sinmoderar.php?categoria=evento'>Eventos</a></li>
							<li><a href='sinmoderar.php?categoria=guia'>Guias</a></li>
						</ul>
					</li>
					<li>
						<a href='moderar.php'>Moderar</a>
						<ul>
							<li><a href='moderar.php?categoria=noticia'>Noticias</a></li>
							<li><a href='moderar.php?categoria=review'>Reviews</a></li>
							<li><a href='moderar.php?categoria=quiz'>Quizs</a></li>
							<li><a href='moderar.php?categoria=evento'>Eventos</a></li>
							<li><a href='moderar.php?categoria=guia'>Guias</a></li>
						</ul>
					</li>
					<li>
						<a href=''>Crear</a>
						<ul>
							<li><a href='crear_noticia.php'>Noticias</a></li>
							<li><a href='crear-review.php'>Reviews</a></li>
							<li><a href='crear-quiz.php'>Quizs</a></li>
							<li><a href='crear-evento.php'>Eventos</a></li>
							<li><a href='crear-guia.php'>Guias</a></li>
						</ul>
					</li>
				</ul>
			</div>
			
		</div>";
}elseif($rol =="administrador"){
	echo "<div id='menu-navegacion'>
			<div id='navegacion'>
				<ul>
					<li>
						<a id='menu-sobremi' href='sobremi.php'>Sobre mi</a>
					</li>
					<li>
						<a href='moderado.php'>Moderado</a>
						<ul>
							<li><a href='moderado.php?categoria=noticia'>Noticias</a></li>
							<li><a href='moderado.php?categoria=review'>Reviews</a></li>
							<li><a href='moderado.php?categoria=quiz'>Quizs</a></li>
							<li><a href='moderado.php?categoria=evento'>Eventos</a></li>
							<li><a href='moderado.php?categoria=guia'>Guias</a></li>
						</ul>
					</li>
					<li>
						<a href='sinmoderar.php'>Sin moderar</a>
						<ul>
							<li><a href='sinmoderar.php?categoria=noticia'>Noticias</a></li>
							<li><a href='sinmoderar.php?categoria=review'>Reviews</a></li>
							<li><a href='sinmoderar.php?categoria=quiz'>Quizs</a></li>
							<li><a href='sinmoderar.php?categoria=evento'>Eventos</a></li>
							<li><a href='sinmoderar.php?categoria=guia'>Guias</a></li>
						</ul>
					</li>
					<li>
						<a href='moderar.php'>Moderar</a>
						<ul>
							<li><a href='moderar.php?categoria=noticia'>Noticias</a></li>
							<li><a href='moderar.php?categoria=review'>Reviews</a></li>
							<li><a href='moderar.php?categoria=quiz'>Quizs</a></li>
							<li><a href='moderar.php?categoria=evento'>Eventos</a></li>
							<li><a href='moderar.php?categoria=guia'>Guias</a></li>
						</ul>
					</li>
					<li>
						<a href=''>Crear</a>
						<ul>
							<li><a href='crear_noticia.php'>Noticias</a></li>
							<li><a href='crear-review.php'>Reviews</a></li>
							<li><a href='crear-quiz.php'>Quizs</a></li>
							<li><a href='crear-evento.php'>Eventos</a></li>
							<li><a href='crear-guia.php'>Guias</a></li>
							<li><a href='crear_ficha.php'>Ficha</a></li>
						</ul>
					</li>
				</ul>
			</div>
			
		</div>";
}
?>
</div>
	
	
	
	<!-- <div id="divClear"></div> -->
</header>