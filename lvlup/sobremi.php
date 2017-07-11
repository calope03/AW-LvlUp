<?php require_once 'includes/config.php';?>
<!DOCTYPE HTML>
<hmtl>
	<head>
		<title> LVLuP </title>
		<link rel = "stylesheet" type = "text/css" href = "css/reset.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/miPerfil.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/sobremi.css"/>	
		<link rel = "stylesheet" type = "text/css" href = "css/sidebar.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/pie.css" />
		<script defer type="text/javascript" src="js/registro.js"></script>	
		<script defer type="text/javascript" src="js/busquedaAvanzada.js"></script>	
		<script src="js/jquery-1.12.2.min.js"></script>	
		<meta http-equiv="Content-Type" content="text/html; charset= utf-8"/>
	<script>	
$(document).ready(function() {
	//variables
	var pass1 = $('[name=passwordNuevo]');
	var pass2 = $('[name=passwordNuevoR]');
	var correo= $('[name=correo]');
	var confirmacion = "Las contraseñas si coinciden";
	var longitud = "La contraseña debe estar formada entre 6-10 carácteres (ambos inclusive)";
	var negacion = "No coinciden las contraseñas";
	var vacio = "La contraseña no puede estar vacía";
	var correono= "No es un correo valido";
	var correosi="Correo valido";
	holi="holi";
	//oculto por defecto el elemento span
	var span = $('<span></span>').insertAfter(pass2);
	var spancorreo  = $('<span></span>').insertAfter(correo);
	span.hide();
	spancorreo.hide();
	//función que comprueba las dos contraseñas
	function coincidePassword(){
		var valor1 = pass1.val();
		var valor2 = pass2.val();
		//muestro el span
		span.show().removeClass();
		//condiciones dentro de la función
		if(valor1 != valor2){
			span.text(negacion).addClass('negacion');			
		}
		if(valor1.length==0 || valor1==""){
			span.text(vacio).addClass('negacion');	
		}
		if(valor1.length<6 || valor1.length>10){
			span.text(longitud).addClass('negacion');
		}
		if(valor1.length!=0 && valor1==valor2){
			span.text(confirmacion).removeClass("negacion").addClass('confirmacion');
		}
	}
	function validaCorreo()	{
		var correoV=correo.val();
		var compr =correoV.split("@");
		spancorreo.show().removeClass();
		if(!compr[1]){
			//alert("No es un correo valido");
			spancorreo.text(correono).addClass('negacion');
		}else{
			compr = compr[1].split(".");
			if(!compr[1]){
				//alert("No es un correo valido");
				spancorreo.text(correono).addClass('negacion');
			}else{
				//alert(" es un correo valido");
				spancorreo.text(correosi).removeClass("negacion").addClass('confirmacion');
			}
		}
		
	}
	//ejecuto la función al soltar la tecla
	pass1.keyup(function(){
	coincidePassword();
	});
	pass2.keyup(function(){
	coincidePassword();
	});
	correo.keyup(function(){
	validaCorreo();
	});
});

function checkMe(){
	
	var correoFinal = document.editarUsuario.correo.value;
	var enviar = /\.(gif|jpg|png)$/i.test(editarUsuario.avatar.value);
	var enviarForm= true;
	if(document.editarUsuario.passwordNuevo.value == "" && document.editarUsuario.passwordNuevoR.value=="" && document.editarUsuario.correo.value==""&& document.editarUsuario.descripcion.value=="" && !enviar ){	
		enviarForm=false;
	}else{
	
		if(correoFinal == "" || correoValido(correoFinal)){
			enviarForm= enviarForm && true;
		}else{
			enviarForm= enviarForm && false;
		}
		
		if((document.editarUsuario.passwordNuevo.value == document.editarUsuario.passwordNuevoR.value)){
			document.editarUsuario.password.value=document.editarUsuario.passwordNuevo.value;
			enviarForm= enviarForm && true;
		}else{
			enviarForm= enviarForm && false;
		}
	}
	if(enviarForm){
		document.editarUsuario.submit();
	}else{
		alert("Revisa que todos los campos sean correctos");
	}
}
function correoValido(correoJ)	{
		var correoH=correoJ;
		var comprJ =correoH.split("@");
		if(!comprJ[1]){
			return false;
		}else{
			comprJ = comprJ[1].split(".");
			if(!comprJ[1]){
				return false;
			}else{
				return true;
			}
		}
}
</script>
	</head>
	
<body>
	<?php require ('views/miPerfil.php'); ?>
	<div id="divClear"></div>
		<!-- === CONTENIDO === -->

			<div id="contenido">
				
				<form enctype="multipart/form-data" method="post" name="editarUsuario" action="editarUsuario.php">
					<div id="editar">
					<p><strong>Correo:</strong><br>
					<?php echo "<input type='text' name='correo' value ='' placeholder='".$user['correo']."'></p>";?>
					<p><strong>Contraseña nueva:</strong><br>
					<input type='password' name='passwordNuevo' value=""></p>
					<p><strong>Confirmar contraseña nueva:</strong><br>
					<input type='password' name='passwordNuevoR' value="" ></p>
					<p><strong>¿Que nos cuentas?:</strong><br>
					<?php echo "<textarea name = 'descripcion' rows='4' cols='50' maxlength='300' value = '' placeholder='Pequeña descripcion sobre ti, tus gustos en videojuegos, etc.'></textarea></p>"; ?>
					<input type="hidden" name="password" value="">
					</div>
					<div id = "avatar">
						<?php echo "<img id='cambiarImagen' src='".$user['ruta_avatar']."' />"; ?>
							<p>
								Cambiar avatar:<br>
								<input type="file" name="avatar" size="40">
							</p>
						
					</div>
					
					<input type="button" id="enviar" name = "enviar" value="Enviar" onClick="checkMe()"/>
				</form>
				<div id="divClear"></div>
			</div>
		<?php require ('views/pie.html'); ?>
	</body>
</html>