<?php
function Leer($path, &$array)
{
    if (file_exists($path) && filesize($path) > 0) {
        $archivo = fopen($path, 'r');
        $array = fread($archivo, filesize($path));
        fclose($archivo);
        $array=json_decode($array,true);        
        return true;
    }
    $array=array();
    return false;
}
function Guardar($dato, $path)
{
    if (Leer($path, $array)) {
        array_push($array,$dato);
        $aux = json_encode($array, true);
    }else{
        array_push($array,$dato);
        $aux=json_encode($array,true);
    }
    $archivo = fopen($path, 'w');
    fwrite($archivo, $aux);
    fclose($archivo);
}
function Baja($dato, $path)
{ }
function Modificar($dato, $path)
{ }
function tratarImagen(&$pathimagen)
{
    $extencionTmp = explode("/", $_FILES["foto"]["type"]);
    if ($extencionTmp[0] != "image") {
        $pathimagen = '';
        return false;
    }
    $archivoTmp = $_FILES["foto"]["tmp_name"];
    $pathimagen = "./imagenes/" . $_POST["email"] . "." . $extencionTmp[1];
    return move_uploaded_file($archivoTmp, $pathimagen);
}
