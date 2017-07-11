<?php

      $user = $_POST['b'];
       
      if(!empty($user)) {
            comprobar($user);
      }
       
      function comprobar($b) {
            $con = mysqli_connect('localhost','admin', 'admin');
            mysqli_select_db($con,'lvlup' );
       
            $sql = mysqli_query($con,"SELECT * FROM usuario WHERE nick = '".$b."'");
             
            $contar = mysqli_num_rows($sql);
             
            if($contar == 0){
                  echo "<span id='span' class='confirmacion'>Disponible</span>";
            }else{
                  echo "<span id='span' class='negacion'>El nombre de usuario ya existe</span>";
            }
      }     
?>