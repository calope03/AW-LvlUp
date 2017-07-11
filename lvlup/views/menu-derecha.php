<div id="menu-derecha">		
<?php
require_once ('includes/Valoracion.php');
$tag = new \es\ucm\fdi\aw\Tag();
$user = new \es\ucm\fdi\aw\Usuario();
require_once 'includes/Contenido.php';
$contenido= new \es\ucm\fdi\aw\Contenido();
require_once 'includes/Ficha.php';
$ficha= new \es\ucm\fdi\aw\Ficha();
if(isset($_GET['id'])){
	$cont=$contenido->dameContenido($_GET['id']);
	//echo var_dump($cont);
	if($cont['ficha_juego']!=NULL){
		$juego=$ficha->dameFicha($cont['ficha_juego']);
		//echo var_dump($juego);
		echo "<div id='ficha'>
			<div id='headerFicha'>
				<div id='tituloFicha'>Ficha del juego</div>
			</div>	
			<img id='caratula' src='".$juego['ruta_caratula']."'>	
				
			<div id='datos'>
				<strong><p id='juego'>".$juego['nombre']."</p></strong>
				<p>Año de salida: ".$juego['año']."</p>
				<p>Desarrolladora: ".$juego['desarrolladora']."</p>
				<p>Plataformas: ".$juego['plataforma']."</p>	
				<img id='edad' src='img/edad/".$juego['edad_minima'].".jpg'>
			</div>
			<div id='divClear'></div>
		</div>";
	}
}
?>


	
	
	
	<div id="nubeTags">
		<div id="headerTags">
			<div id="tituloTags">Nube de tags</div>
		</div>
		<div id="tags">
			<?php
				$arrayTags = $tag->dameTagsPopulares();
				echo "<ul>";
				for($i = 0; $i < count($arrayTags); $i++)
				{
					if($i < 3){
						$clase = 'descatados';
					}
					else if($i >= 3 && $i < 7){
						$clase = 'normal';
					}
					else{
						$clase = 'nodestacados';
					}
					echo "<li><a class='$clase' href='tags.php?palabra=".$arrayTags[$i]."'>".$arrayTags[$i]."</a></li>";
				}
				echo "</ul><div id='divClear'></div>";
			?>
			<div id='divClear'></div>
		</div>
		<div id='divClear'></div>
	</div>
	
	<div id="topUsuarios">
		<div id="headerUsuarios">
			<div id="tituloUsuarios">Top usuarios</div>
		</div>					
		<div id="usuarios">
			<?php
				$arrayUsers = $user->usuariosMasActivos();
				//echo var_dump($arrayUsers);
				echo "<ol>";
				for($i = 0; $i < count($arrayUsers); $i++)
				{
					$puesto = $i + 1;
					echo "<li><a href='usuario.php?nombre=".$arrayUsers[$puesto]['autor']."''><p>".$puesto.". ".$arrayUsers[$puesto]['autor']."</p></a></li>";
				}
				echo "</ol>";
			?>
			<div id='divClear'></div>
		</div>
		<div id='divClear'></div>
	</div>
	

</div>

<div id="divClear"></div>