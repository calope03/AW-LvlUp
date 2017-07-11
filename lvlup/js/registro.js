// ====================
// ----- REGISTRO
// ====================
function registrarse() {
	$('body').css("overflow","hidden");
	$("#capa").fadeIn(200);
	$("#registro").fadeIn(200);
}

function cerrarRegistro() {
	$('body').css("overflow","visible");
	$("#registro").fadeOut(400);
	$("#capa").fadeOut(400);
}

function enviarRegistro() {
	$('body').css("overflow","visible");
	$("#registro").fadeOut(400);
	$("#capa").fadeOut(400);
}
function iniciarSesion() {
	$('body').css("overflow","hidden");
	$("#capaSesion").fadeIn(200);
	$("#inicioSesion").fadeIn(200);
}

function cerrarVentana() {
	$('body').css("overflow","visible");
	$("#inicioSesion").fadeOut(400);
	$("#capaSesion").fadeOut(400);
}

$(document).ready(function() {
	//variables
	var consulta;
	var pass1 = $('[name=contrasenaN]');
	var pass2 = $('[name=contrasenaR]');
	var correo= $('[name=email]');
	var confirmacion = "Las contraseñas si coinciden";
	var longitud = "La contraseña debe estar formada entre 6-10 carácteres (ambos inclusive)";
	var negacion = "No coinciden las contraseñas";
	var vacio = "La contraseña no puede estar vacía";
	var correono= "No es un correo valido";
	var correosi="Correo valido";
	//holi="holi";
	//oculto por defecto el elemento span
	var span = $("<span id='span'></span>").insertAfter(pass2);
	var spancorreo  = $("<span id='span'></span>").insertAfter(correo);
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
	$("#usuario").keyup(function(e){
		//alert("error dfhadfhafdh ajax");
		 //obtenemos el texto introducido en el campo
		 consulta = $("#usuario").val();
								  
		 //hace la búsqueda
		 $("#resultado").delay(100).queue(function(n) {      
			$.ajax({
				type: "POST",
				url: "comprobar.php",
				data: "b="+consulta,
				dataType: "html",
				error: function(){
					alert("error petición ajax");
				},
				success: function(data){
					if(data=="<span id='span' class='confirmacion'>Disponible</span>"){
						document.registraUsuario.enviar.disabled = false;
						$("#resultado").html(data);
						n();
					}else{
						//alert("no entro");
						document.registraUsuario.enviar.disabled = true;
						$("#resultado").html(data);
						n();
						
					}
				}
			});
									   
		 });
							
	});
});

function checkMeok(){
	
	var correoFinal = document.registraUsuario.email.value;
	//var result = /^[a-z0-9\.;,:''\s]{1,100}$/i.test(document.registraUsuario.usuario.value);
	//alert("holiiii");
	//var usu =document.registraUsuario.usuario.value;
	//var nick =patron.test(document.registraUsuario.usuario.value);
	//var enviar = /\.(gif|jpg|png)$/i.test(registraUsuario.avatar.value);
	var enviarForm= true;
	if(document.registraUsuario.contrasenaN.value != "" && document.registraUsuario.contrasenaR.value!="" && document.registraUsuario.email.value!=""){	
		
		if(correoFinal == "" || correoValido(correoFinal)){
			//alert("correo true");
			enviarForm= enviarForm && true;
		}else{
			enviarForm= enviarForm && false;
		}
		
		if((document.registraUsuario.contrasenaN.value == document.registraUsuario.contrasenaR.value)&& document.registraUsuario.contrasenaN.value.length>=6 && document.registraUsuario.contrasenaN.value.length<=10 ){
			document.registraUsuario.password.value=document.registraUsuario.contrasenaN.value;
			//alert("pass true");
			enviarForm= enviarForm && true;
		}else{
			enviarForm= enviarForm && false;
		}
		
	}else{	
		enviarForm=false;
	}
	if(enviarForm){
		document.registraUsuario.submit();
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
