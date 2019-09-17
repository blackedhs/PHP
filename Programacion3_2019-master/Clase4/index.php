<?php
/*
var_dump($_POST);
var_dump($_FILES);

$archivoTmp = $_FILES["image"]["tmp_name"];
//transforma un string en un string de array, pasando como primer parametro el separador de mismo
$extencion = explode("/",$_FILES["image"]["type"]);


echo "</br> $archivoTmp";


$rta = move_uploaded_file($archivoTmp,"./images/foto.".$extencion[1]);
*/
include_once "./clases/functions.php";
include_once "./clases/Persona.php";
var_dump($_POST);
var_dump($_FILES);

$archivoTmp=$_FILES["image"]["tmp_name"];
$extencionTmp = explode("/",$_FILES["image"]["type"]);
$imagen= "./images/".$_POST["legajo"].".".$extencionTmp[1];

switch ($_POST["opcion"]) {
    case 'alta':
        $rta=move_uploaded_file($archivoTmp,$imagen);
        if($rta)
         {
            $persona = new persona($_POST["legajo"],$_POST["nombre"],$_POST["apellido"],$imagen);
            Escribir($persona,"./jason.json");
        }
        break;
    case 'modicacion':
            $persona = new persona($_POST["legajo"],$_POST["nombre"],$_POST["apellido"],$imagen);
            Modificar($persona,"./jason.json");
        break;
    case 'backup':
        $rta=Backup($_POST["legajo"],"./jason.json");
        if($rta && move_uploaded_file($archivoTmp,$imagen)){
            $persona = new persona($_POST["legajo"],$_POST["nombre"],$_POST["apellido"],$imagen);
            Modificar($persona,"./jason.json");
        }
        
    break;
    default:
        # code...
        break;
}



