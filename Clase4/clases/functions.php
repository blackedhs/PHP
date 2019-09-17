<?php


function Guardar($dato, $path, $moficar = false)
{

    if ($moficar == false) {
        $aux = Leer($path);
        if (!$aux)
            $aux = array();
        array_push($aux, $dato);
    } else {
        $aux = $dato;
    }
    $archivo = fopen($path, "w");
    $rta = fwrite($archivo, json_encode($aux));
    fclose($archivo);
    return $rta;
}

function Leer($path)
{
    if (file_exists($path)) {
        $archivo = fopen($path, "r");
    } else {
        return false;
    }
    $size = filesize($path);
    if ($size > 0) {
        $aux = fread($archivo, filesize($path));
    } else {
        fclose($archivo);
        return false;
    }
    return  json_decode($aux, true);
}

function Eliminar($dato, $path)
{
    $aux = Leer($path);
    $retorno = array();
    $rta = false;
    for ($i = 0; $i < count($aux); $i++) {
        if ($aux[$i]["legajo"] != $dato->legajo) {
            array_push($retorno, $aux[$i]);
        } else {
            $rta = true;
        }
    }
    Guardar($retorno, $path, true);
    return $rta;
}

function Modificar($obj, $path)
{
    $aux = Leer($path);
    $retorno = false;
    for ($i=0; $i < count($aux); $i++) { 
        if ($aux[$i]["legajo"]==$obj->legajo) {
            $aux[$i] = $obj;
            $retorno = true;
        }
    }
    Guardar($aux, $path, true);
    return $retorno;
}
function Backup($legajo, $path)
{
    $aux = Leer($path);
    $ruta = 0;
    $rta = false;

    for ($i=0; $i < count($aux); $i++) { 
        if ($aux[$i]["legajo"]==$legajo) {
            $rta=true;
            $ruta=$aux[$i]["imagen"];
        }
    }
    if ($rta) {
        $extencion = explode(".", $ruta);
        rename($ruta, "./BackupImages/bk." . $legajo . "." . $extencion[count($extencion) - 1]);
    }
    return $rta;
}
function ValidarExistencia($dato, $aux)
{
    for ($i = 0; $i < count($aux); $i++) {
        if ($aux[$i]['legajo'] == $dato->legajo)
            return true;
    }
    return false;
}
function Alta($dato, $path)
{
    $aux = Leer($path);
    if ($aux == false) {
        Guardar($dato, $path, false);
    } else {
        if (ValidarExistencia($dato, $aux)) {
            echo 'ya existe no se da de alta';
            return false;
        }
    }
    Guardar($dato, $path, false);
    return true;
}
function Mostrar($path)
{
    $aux = Leer($path);
    for ($i = 0; $i < count($aux); $i++) {
        var_dump($aux[$i]);
    }
}
