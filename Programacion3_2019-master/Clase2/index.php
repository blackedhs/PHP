<?php
    /*session_start();

    if (!isset($_SESSION['cont'])) {
        $_SESSION['cont']=0;
    }

    $_SESSION['cont']+=1;

    echo $_SESSION['cont'];*/

    require_once './Clases/Alumno.php';
    
    $Alumno = array();    

    $Alumno[] = new Alumno('Juan','lopez','1');
    $Alumno[] = new Alumno('Pepe','Perez','2');
    $Alumno[] = new Alumno('Hernan','Hernandez','3');

    
    require_once './Funciones/Alumno_DAO.php';

     echo $_SERVER['REQUEST_METHOD'];
    request($_SERVER['REQUEST_METHOD'], $Alumno );
  
   //session_destroy();
   //session_unset();
?>