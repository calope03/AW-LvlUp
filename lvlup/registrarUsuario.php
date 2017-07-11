<?php
require_once __DIR__.'/includes/config.php';
require_once __DIR__.'/includes/Usuario.php';
$user= new \es\ucm\fdi\aw\Usuario();
$nick=$_POST['usuario'];
$password=$_POST['password'];
$password = sha1($password);
$correo=$_POST['email'];
$url=$_POST['url'];
$user->registraUsuario($nick,$password,$correo);
header("Location:".$url);

?>