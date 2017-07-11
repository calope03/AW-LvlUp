<?php
require_once 'includes/config.php';
require_once 'includes/Usuario.php';
$usuario= new \es\ucm\fdi\aw\Usuario();
	$url= $_SERVER['REQUEST_URI'];
	if(isset($_GET['error'])){
		$error=$_GET['error'];
	} else{
	$error = false;
	}
	if(isset($_GET['borrado'])){
		$borrado=$_GET['borrado'];
	} else{
	$borrado = false;
	}
	if(isset($_GET['nivel'])){
		$nivel=$_GET['nivel'];
	} else{
		$nivel = false;
	}
?>
<!-- REGISTRO -->
<div id="capa" onclick="cerrarRegistro()"></div>

<div id="registro">
	<div id="headerRegistro">
		<div id="tituloRegistro">Registrase Gratis</div>
		<div id="closeRegistro" onclick="cerrarRegistro()">x</div>
	</div>

	<form name='registraUsuario' action="registrarUsuario.php" method="post">
		<section id="inputsRegistro">
			<p>
				<input type="text" id="usuario" name="usuario" value="" placeholder="Nombre de Usuario" />
				<div id="resultado"></div>
			</p>
			<p>
				<input type="text" name="email" value="" placeholder="Email" />
			</p>
			<p>
				<input type="password" name="contrasenaN" value="" placeholder="Contraseña" />
			</p>
			<p>
				<input type="password" name="contrasenaR" value="" placeholder="Repita Contraseña" />
			</p>
			<p>
			<input type="hidden" name="password" value=""/>
			<input type="hidden" name="url" value="<?php echo $url;?>"/>
			</p>
			<input name="enviar" type="button" onClick="checkMeok()" value="Registrarse" />
		</section>

		
	</form>
</div>

<!-- LOGIN -->
<div id="capaSesion" onclick="cerrarVentana()"></div>

<div id="inicioSesion">
	<div id="headerSesion">
		<div id="tituloSesion">Inicia Sesion</div>
		<div id="closeSesion" onclick="cerrarVentana()">x</div>
	</div>

	<form action="iniciarSesion.php" method="post">
		<section id="inputsSesion">
			<p>
				<input type="text" name="usuario" value="" placeholder="Nick de Usuario" required="required"/>
			</p>
			<p>
				<input type="password" name="contrasena" value="" placeholder="Contraseña" required="required"/>
			</p>
				
				<?php echo "<input type='hidden' name='url' value='".$url."'/>"; ?>
			<input id="iniciar" type="submit" value="Iniciar Sesión"/>
					
		</section>
	</form>
</div>


<!-- HEADER -->
<header>
    <script>
	function error(){
		alert("Ha habido algun problema al iniciar sesion, intentelo de nuevo");
	}
	function borrado(){
		alert("Se ha eliminado el contenido");
	}
	function enhorabuena(){
		alert("SEnhorabuena, has subido de nivel!!!");
	}	
    </script>
	<?php
	//echo var_dump($error);
		if($error==true){
	?>	
			<script>
			error();
			</script> 	
	<?php	}
	if($nivel==true){
	?>	
			<script>
			enhorabuena();
			</script> 
	<?php }
	if($borrado==true){
	?>	
			<script>
			borrado();
			</script> 	
	<?php	}
		if(!isset($_SESSION['nombre'])){
			//echo "no hay sesion";
			echo "
			<div id='caja-logo' onclick=location.href='index.php' style='cursor:pointer' >
			<img id='logo' src='img/logo.png'>
			<img id='titulo' src='img/titulo.png'>
		</div>
		
		<div id='caja-avatar'>
			<div id='botones'>
				<button id='buttonRegistro' onclick='registrarse()'>Registrarse</button>
				<button id='buttonSesion' onclick='iniciarSesion()'>Iniciar Sesion</button>
			</div>	
			<a href=''>
				<img id='default-avatar' src='img/avatar/default.jpg' />
			</a>				
		</div>";
	}else{ 
		$nick = $_SESSION['nombre'];
		$user=$usuario->dameUsuario($nick);
		//echo " hay sesion";
		echo "
			<div id='caja-logo' onclick = location.href='index.php' style='cursor:pointer' >
			<img id='logo' src='img/logo.png'>
			<img id='titulo' src='img/titulo.png'>
		</div>
		
		<div id='caja-avatar'>	
			<div id='botones'>
				<a href = 'sobremi.php'><button id='buttonRegistro'>Mi perfil</button></a>
				<a href = 'cerrarSesion.php'><button id='buttonSesion'>Cerrar Sesión</button></a>
			</div>	
		 <a href = ''><img id='default-avatar' src='".$user['ruta_avatar']."' /></a>
					
		</div>";
	}
	?>
	<!-- Comprobar aqui las sesion iniciada!!-->
	

	<!-- == Buscador Avanzado == -->

	<div id="buscadorAvanzado">
		
			<form  method="post" action="busquedaAvanzada.php">
				<input type="text" id="busqueda" name="busqueda" value="" placeholder="Buscar...." />
			</form>
		
	</div>
	
	<!-- == Menu == -->

	<div id="menu-navegacion">
		<nav id="navegacion">
			<ul>
				<li>
					<a href="portada-noticias.php">Noticias</a>
					<ul>
						<li><a href="noticias_novedades.php">Novedades</a></li>
						<li><a href="noticias_visitadas.php">Mas Visitadas</a></li>
						<li><a href="noticias_populares.php">Mejor Valoradas</a></li>
					</ul>
				</li>				
				<li>
					<a href="portada-reviews.php">Reviews</a>
					<ul>
						<li><a href="reviews-novedades.php">Novedades</a></li>
						<li><a href="reviews-visitadas.php">Mas Visitadas</a></li>
						<li><a href="reviews-populares.php">Mejor Valoradas</a></li>
					</ul>
				</li>				
				<li>
					<a href="portada-quizs.php">Quizs</a>
					<ul>
						<li><a href="quizs-novedades.php">Novedades</a></li>
						<li><a href="quizs-visitados.php">Mas Visitados</a></li>
					</ul>
				</li>				
				<li>
					<a href="portada-eventos.php">Eventos</a>
					<ul>
						<li><a href="eventos.php?tipo=1">Novedades</a></li>
						<li><a href="eventos.php?tipo=2">Mayor asistencia</a></li>
					</ul>
				</li>
				<li>
					<a href="portada-guias.php">Guías y Trucos</a>
					<ul>
						<li><a href="novedades-guiastrucos.php">Novedades</a></li>
						<li><a href="masvisitadas-guiastrucos.php">Más visitadas</a></li>
						<li><a href="valoradas-guiastrucos.php">Mejor Valoradas</a></li>
					</ul>
				</li>
			</ul>
		</nav>
	</div>
</header>