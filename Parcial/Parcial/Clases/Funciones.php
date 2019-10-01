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
{ 
    Leer($path,$array);
    for ($i=0; $i < count($array) ; $i++) { 
        if($dato->legajo== $array[$i]['legajo']){
            $array[$i]['nombre']=$dato->nombre;
            $array[$i]['clave']=$dato->clave ;
            $array[$i]['email']=$dato->email ;
            $array[$i]['foto1']=$dato->foto1 ;
            $array[$i]['foto2']=$dato->foto2 ;
        }
    }
    $aux=json_encode($array,true);
    $archivo = fopen($path, 'w');
    fwrite($archivo, $aux);
    fclose($archivo);
}
function tratarImagen1(&$foto1,$pathimagen)
{
    $extencionTmp = explode("/", $_FILES["foto1"]["type"]);
    if ($extencionTmp[0] != "image") {
        $pathimagen = '';
        return false;
    }
    $archivoTmp = $_FILES["foto1"]["tmp_name"];
    $foto1 = $pathimagen. $_POST["legajo"] . "foto1." . $extencionTmp[1];
    return move_uploaded_file($archivoTmp, $foto1);
}
function tratarImagen2(&$foto2,$pathimagen)
{
    $extencionTmp = explode("/", $_FILES["foto2"]["type"]);
    if ($extencionTmp[0] != "image") {
        $pathimagen = '';
        return false;
    }
    $archivoTmp = $_FILES["foto2"]["tmp_name"];
    $foto2 = $pathimagen. $_POST["legajo"] . "foto2." . $extencionTmp[1];
    return move_uploaded_file($archivoTmp, $foto2);
}

function BackupImagen2(&$foto2,$pathimagen,$pathBackup,$pathOld)
{
    $extencionTmp = explode("/", $_FILES["foto2"]["type"]);
    
    if ($extencionTmp[0] != "image") {
        $pathimagen = '';
        return false;
    }
    $archivoTmp = $_FILES["foto2"]["tmp_name"];
    $foto2 = $pathimagen. $_POST["legajo"] . "foto2." . $extencionTmp[1];
    $backupName = $pathBackup.$_POST["legajo"] . "foto2." . $extencionTmp[1];
    rename($foto2,$backupName);
    return move_uploaded_file($archivoTmp, $foto2);
}
function BackupImagen1(&$foto1,$pathimagen,$pathBackup,$pathOld)
{
    $extencionTmp = explode("/", $_FILES["foto1"]["type"]);
    
    if ($extencionTmp[0] != "image") {
        $pathimagen = '';
        return false;
    }
    $archivoTmp = $_FILES["foto1"]["tmp_name"];
    $foto1 = $pathimagen. $_POST["legajo"] . "foto1." . $extencionTmp[1];
    $backupName = $pathBackup.$_POST["legajo"] . "foto1." . $extencionTmp[1];
    rename($foto1,$backupName);
    return move_uploaded_file($archivoTmp, $foto1);
}