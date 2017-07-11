<?php

namespace es\ucm\fdi\aw;

use es\ucm\fdi\aw\Aplicacion as App;

class Usuario {

  public static function login($username, $password) {
	$app = App::getSingleton();
    $conn = $app->conexionBd();  
	//quiero hacer un selec para comprobar el usuario ya tengo el nick, quiero comprobar que exista
	$query = sprintf("SELECT password FROM usuario WHERE nick='$username'");
	$rs = $conn->query($query);
	//echo mysqli_errno($conn) . ": " . mysqli_error($conn) . "\n";
	//echo var_dump($rs);
	if ($rs && $rs->num_rows == 1) {
      $fila = $rs->fetch_assoc();
      $pass = $fila['password'];
	  if($password ==$pass){
		  return true;
	  }
      $rs->free();

      return false;
    }
  }

  private static function buscaUsuario($username) {
    $app = App::getSingleton();
    $conn = $app->conexionBd();
    $query = sprintf("SELECT * FROM Usuarios WHERE username='%s'", $conn->real_escape_string($username));
    $rs = $conn->query($query);
    if ($rs && $rs->num_rows == 1) {
      $fila = $rs->fetch_assoc();
      $user = new Usuario($fila['id'], $fila['username'], $fila['password']);
      $rs->free();

      return $user;
    }
    return false;
  }

  private $id;

  private $username;

  private $password;

  private $roles;

  public function __construct() {

  }

  public function addRol($role) {
    $this->roles[] = $role;
  }

  public function roles() {
    return $this->roles;
  }

  public function username() {
    return $this->username;
  }

  public function compruebaPassword($password) {
    return $this->password === $password;
  }
  public function dameUsuario($nick) {
    $app = App::getSingleton();
    $conn = $app->conexionBd();
    $query = sprintf("SELECT * FROM usuario WHERE nick='$nick'");
    $rs = $conn->query($query);
	//echo mysqli_errno($conn) . ": " . mysqli_error($conn) . "\n";
    if ($rs && $rs->num_rows == 1) {
      $fila = $rs->fetch_assoc();
      $user = $fila;
      $rs->free();

      return $user;
    }
    return false;
  }
	public function cambiarPass($nick,$pass) {
		$app = App::getSingleton();
		$conn = $app->conexionBd();
		$query = sprintf("UPDATE usuario SET password='$pass' WHERE nick='$nick'");
		$rs = $conn->query($query);
	}
	public function cambiarCorreo($nick,$correo) {
		$app = App::getSingleton();
		$conn = $app->conexionBd();
		$query = sprintf("UPDATE usuario SET correo='$correo' WHERE nick='$nick'");
		$rs = $conn->query($query);
	}
	public function cambiarDescripcion($nick,$descripcion) {
		$app = App::getSingleton();
		$conn = $app->conexionBd();
		$query = sprintf("UPDATE usuario SET descripcion='$descripcion' WHERE nick='$nick'");
		$rs = $conn->query($query);
	}
	public function cambiaAvatar($nick,$ruta) {
		$app = App::getSingleton();
		$conn = $app->conexionBd();
		$query = sprintf("UPDATE usuario SET ruta_avatar='$ruta' WHERE nick='$nick'");
		$rs = $conn->query($query);
	}
	  
	public function registraUsuario($nick,$password,$correo) {
		$ruta="img/avatar/default.jpg";
		$app = App::getSingleton();
		$conn = $app->conexionBd();
		$query = sprintf("INSERT INTO usuario (nick,correo,password,ruta_avatar) VALUES ('$nick','$correo','$password','$ruta')");
		$rs = $conn->query($query);
	}
  public function compruebaRol($nick){
    $app = App::getSingleton();
      $conn = $app->conexionBd();
      $query = sprintf("SELECT rol FROM usuario WHERE nick = '$nick'");
      $rs = $conn->query($query);
    if ($rs) {
          while($fila = $rs->fetch_assoc()) { 
              $usuario = $fila;
          }

          $rs->free();
        }
    return $usuario['rol'];
  }

  public function usuariosMasActivos(){
    $app = App::getSingleton();
    $conn = $app->conexionBd();
    $query = sprintf("SELECT autor FROM contenido c WHERE c.publicado=1 GROUP BY autor ORDER BY count(autor) DESC");
    $rs = $conn->query($query);
    if($rs){
      $i=1;
      
      while($fila = $rs->fetch_assoc()) { 
        $usuarios[$i] = $fila;
        $i++;
      } 
      
      $rs->free();
    }

    return $usuarios;
  }  
    function cargaAutorRecientes($nick,$categoria) {
	    $app = App::getSingleton();
	    $conn = $app->conexionBd();
		//print_r($array_plataformas);
		$array_resultado = array();
		$query = sprintf("SELECT * FROM contenido WHERE categoria = '$categoria' AND autor = '$nick' AND publicado = 1 ORDER BY fecha DESC");
		$rs = $conn->query($query);
		//echo print_r($rs);
		//echo mysqli_errno($conn) . ": " . mysqli_error($conn) . "\n";
		if (mysqli_num_rows($rs) !=0) {
			$i=1;
			while($fila = $rs->fetch_assoc()) {		
				
				$noticias[$i] = $fila;
				$i++;
			}

			$rs->free();

		}else{
			$noticias=array();
		}
		
		return $noticias;
		
  	}
	function noNotificar($nick){
		$app = App::getSingleton();
	    $conn = $app->conexionBd();
		$query = sprintf("UPDATE usuario SET pend_notificar=0 WHERE nick='$nick'");
		$rs = $conn->query($query);
	}
	
}