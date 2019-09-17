<?php
include_once "./clases/functions.php";
include_once "./clases/Persona.php";
//var_dump($_POST);
//var_dump($_FILES);

$pathJason = "./jason.json";
$archivoTmp = $_FILES["image"]["tmp_name"];
$extencionTmp = explode("/", $_FILES["image"]["type"]);
$imagen = "./images/" . $_POST["legajo"] . "." . $extencionTmp[1];

switch ($_POST["opcion"]) {
    case 'alta':
        if ($extencionTmp[0] != "image") {
            echo 'debe ingresar una imagen valida';
            break;
        }
        $rta = move_uploaded_file($archivoTmp, $imagen);
        if ($rta) {
            $persona = new persona($_POST["legajo"], $_POST["nombre"], $_POST["apellido"], $imagen);
            if (Alta($persona, $pathJason))
                echo 'Alta exitosa';
        }
        break;
    case 'modicacion':
        $persona = new persona($_POST["legajo"], $_POST["nombre"], $_POST["apellido"], $imagen);
        Modificar($persona, $pathJason);
        break;
    case 'backup':
        if ($extencionTmp[0] != "image") {
            echo 'debe ingresar una imagen valida';
            break;
        }
        $rta = Backup($_POST["legajo"], $pathJason);
        if ($rta && move_uploaded_file($archivoTmp, $imagen)) {
            $persona = new persona($_POST["legajo"], $_POST["nombre"], $_POST["apellido"], $imagen);
            Modificar($persona, $pathJason);
            echo 'Imagen modificada';
        } else {
            echo 'No se pudo modificar la imagen';
        }
        break;
    case 'mostrar':
        Mostrar($pathJason);
        break;
    case 'baja':
        $persona = new persona($_POST["legajo"], $_POST["nombre"], $_POST["apellido"], $imagen);
        if (Eliminar($persona, $pathJason))
            echo 'Persona eliminada correctamente';
        else
            echo 'No existe la persona a eliminar';
        break;
    default:
        # code...
        break;
}
