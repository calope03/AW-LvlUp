<?php require_once ('/includes/comentario.php'); ?>

<?php 
	$id = 77;
	$lista = new \es\ucm\fdi\aw\Lista($id);
	$numComentario=2;
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
		<h1>Comentarios</h1>
	</div>
	<?php 

	if (!is_null($lista->lista)){
		
		for($c=($page*$numComentario); $c<($page+1)*$numComentario AND $c<$lista->contador; $c++){ 
	
		if($c<$lista->contador){
		?>
			
			<div class = "comentario" id="<?php $lista->lista[$c]->getId() ?>">
				<div class="usercomment">
					<div class="avatar">
						<a href="">
							<img src="<?php $lista->lista[$c]->getAvatar() ?>">
							<div id="divClear"></div>
						</a>
					</div>
					<div class="userinfo">
						#<?php $lista->lista[$c]->getId() ?> por 
						<a href=""><?php $lista->lista[$c]->getAutor() ?></a>
						</br>
						<?php $lista->lista[$c]->getFecha() ?>
					</div>
				</div>
				<p>
					<?php $lista->lista[$c]->getTexto(); ?>
				</p>
				<div class="valoracion">
					<a href title="A favor de este mensaje" class="voto positivo">A favor</a>
					<a href title="A favor de este mensaje" class="voto negativo">En contra</a>
				</div>
			</div>
		</div>
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
		<h1>Deja tu comentario</h1>
	</div>
	<?php $_SESSION['nombre']="jesus";
	$login = isset($_SESSION['login']) ? $_SESSION['login'] : false;
	if(!$login){
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
				<input type="submit" name="submit" class="submit left" value="Enviar comentario" id="submitbutton">
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
					echo "<li><a href='noticiaX.php?page=".$i."'>".$c."</a></li>";
				}
			?>
			<!-- <li><a href='noticiaX.php?pag=<?php echo $max; ?>'>Ultima</a></li> -->
		</ul>
	</div>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	