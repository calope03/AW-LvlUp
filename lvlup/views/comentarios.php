<?php 
require_once ('includes/comentario.php');
//require_once __DIR__.'/includes/Valoracion.php';
$valoracion= new \es\ucm\fdi\aw\Valoracion();
?>

<?php 
	//$id = 77;
	$lista = new \es\ucm\fdi\aw\Lista($id);
	$numComentario=5;
	//$page=0;
	if(!(empty($_GET['page']))){
		$page = $_GET['page'];
	}
	else{
		$page = 0;
	}
?>

<div class="comentarios">
	<div class="header_commnets">
		<h2>Comentarios</h2>
	</div>
	<?php 
	
	$login = isset($_SESSION['nombre']) ? $_SESSION['nombre'] : false;
	if (!is_null($lista->lista)){
		
		for($c=($page*$numComentario); $c<($page+1)*$numComentario AND $c<$lista->contador; $c++){ 
	
		if($c<$lista->contador){
		?>
			
			<div class = "comentario" id="<?php $lista->lista[$c]->getId() ?>">
				<div class="usercomment">
					<div class="avatar">
						<a href="usuario.php?nombre=<?php $lista->lista[$c]->getAutor() ?>">
							<img src="<?php $lista->lista[$c]->getAvatar() ?>">
						</a>
					</div>
					<div class="userinfo">
						#<?php $lista->lista[$c]->getId() ?> por 
						<a href="usuario.php?nombre=<?php $lista->lista[$c]->getAutor() ?>"><?php $lista->lista[$c]->getAutor() ?></a>
						</br>
						<?php $lista->lista[$c]->getFecha() ?>
					</div>
				</div>
				<p>
					<?php $lista->lista[$c]->getTexto(); ?>
				</p>
				<?php
				if($login){
				?>
				<div class="valoracion">
					
					<?php
						$idcom = $lista->lista[$c]->devuelveId();
						$nick_autor = $lista->lista[$c]->devuelveAutor();
						if(!$valoracion->haValoradoComentario($nick, $idcom) && $nick != $nick_autor)
						{
							echo "<form name='valoracioncomment' action='gestionaValoracionComentario.php' method='post'>
								<input type='radio' id='favor' name='rating' value='5' checked/><label for='favor' title='Favor'>A favor</label>
								<input type='radio' id='contra' name='rating' value='-5' /><label for='contra' title='Contra'>En contra</label>
								<input type='submit' id='enviar' value = 'Opina' >
								<input type='hidden' name='id' id='id' value = '".$idcom."'>
								<input type='hidden' name='nick' id='nick' value = '".$nick."'>
								<input type='hidden' name='url' id='nick' value = '".$url."'>
								<input type='hidden' name='nick_autor' id='nick_autor' value = '".$nick_autor."'>
							</form>";
						}
						else{
							echo $valoracion->muestraVotosComentario($lista->lista[$c]->devuelveId());
						}
						
					?>
					
					<!--
					<a href title="A favor de este mensaje" class="voto positivo" name="voto_pos" onclick ="prueba();"> A favor</a>
					<a href title="En contra de este mensaje" class="voto negativo" name="voto_neg" onclick = valorandoComentarioNeg()> En contra</a>
					-->
					
				</div>
				<?php
				}else{
				?>
					<div class="valoracion">
						 <p>Registrate para poder valorar el comentario</p>
					</div>
				<?php
				}
				?>
			</div>
		<!--</div>-->
	<?php 
		
		}
		}
	}else{?>
		<div class = "comentario">
			<h3>Aun no hay comentarios</h3>
		</div>
	<?php
	}
	?>
	<div class="header_comentar">
		<h2>Deja tu comentario</h2>
	</div>
	<?php
	if($login){
	?>
		<div class="comentar">
			<h3><span class="naranja">Intenta ser respetuoso, educado y no dar patadas al diccionario.</span></h3>
			<p>No cumplir con las normas puede implicar la expulsión de la página.</p>
			<p>Cuesta muy poco ser vulgar, pero algo más ser ingenioso.</p>
			<?php echo "<p>Estas logueado como <span class='naranja'>".$_SESSION['nombre']."</span>.</p>"?>
			<form action="crearComentario.php" method="post" enctype="multipart/form-data">
				<textarea id="comment" name="comment" class="comment" rows=5 required="required"></textarea>
				<input type="hidden" name="id_contenido" id="id_contenido" value="<?php echo $id; ?>"/>
				<input type="hidden" name="autor" id="autor" value="<?php echo $_SESSION['nombre']; ?>"/>
				<input type="hidden" name="url" id="url" value="<?php echo $url; ?>"/>
				<input type="submit" name="submit" class="submit left" value="Enviar comentario" id="submitbutton"/>
			</form>
		</div>
	<?php
	}else{
	?>
		<div class="comentar">
			<h3>Registrate para poder comentar</h3>
		</div>
	<?php
	}
	?>
	
	<div id="paginacion">
		<ul>
			<!-- <li><a href="noticiaX.php?pag=0">Primera</a></li> -->
			<?php
				
				$max=($lista->contador)/$numComentario;
				for($i=0; $i<$max; $i++){
					$c=$i+1;
					//echo "<li><a href='noticiaX.php?id=".$id."&page=".$i."'>".$c."</a></li>";
					echo "<li><a href='".$url."&page=".$i."'>".$c."</a></li>";
				}
			?>
			<!-- <li><a href='noticiaX.php?pag=<?php echo $max; ?>'>Ultima</a></li> -->
		</ul>
	</div>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	