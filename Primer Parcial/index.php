<?php
include_once './Clases/Alumno.php';
include_once './Clases/Funciones.php';
include_once './Clases/Materia.php';
$metodo = $_SERVER["REQUEST_METHOD"];
//var_dump('"5"');
var_dump($metodo);
//var_dump($_SERVER);
$integer="hola";
if($integer== 5){
    echo 'jer';
}
switch ($metodo) {
    case 'GET':
        
        break;
    case 'POST':
        switch ($_POST["caso"]) {
            case 'cargarAlumno':
                echo 'Ingresaste cargar alumno';
                break;
            
            default:
                # code...
                break;
        }
        break;
    
    default:
        
        break;
}