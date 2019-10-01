<?php
class Usuario
{
    public $legajo;
    public $email;
    public $nombre;
    public $clave;
    public $foto1;
    public $foto2;

    function __construct($legajo,$nom, $clave, $mail, $foto1,$foto2)
    {
        $this->legajo = $legajo;
        $this->nombre = $nom;
        $this->clave = $clave;
        $this->email = $mail;
        $this->foto1 = $foto1;
        $this->foto2 = $foto2;
    }
}
function AltaUsuario($usuario, $path, &$ErrorAlta)
{    
    $noExiste = UsuarioNoExiste($usuario, $path);
    if ($noExiste) {
        Guardar($usuario, $path);
        return true;
    } else {
            $ErrorAlta = ' Error : Usuario ya cargado en nuestra base';
        return false;
    }
}
function UsuarioNoExiste($usuario, $path)
{
    $lectura = Leer($path, $arraylectura);
    if ($lectura) {
        for ($i = 0; $i < count($arraylectura); $i++) {
            if ($usuario->legajo == $arraylectura[$i]["legajo"])
                return false;
        }
    }
    return true;
}
function UsuarioBuscar($legajo,$clave, $path, &$Usuario,&$error)
{
    $error='';
    $lectura = Leer($path, $arraylectura);
    if ($lectura) {
        for ($i = 0; $i < count($arraylectura); $i++) {
            if ($legajo == $arraylectura[$i]["legajo"] ){
                if( $clave == $arraylectura[$i]["clave"]){
                $Usuario=new Usuario($arraylectura[$i]["legajo"],$arraylectura[$i]["nombre"],
                                    $arraylectura[$i]["clave"],$arraylectura[$i]["email"],
                                    $arraylectura[$i]["foto1"],$arraylectura[$i]["foto2"]);
                return true;
                }else
                    $error= 'clave incorrecta';
            }
        }
    }
    if($error == '')
        $error='El legajo no existe';
    return false;
}
function UsuarioBuscarLegajo($legajo, $path, &$Usuario,&$error)
{
    $error='';
    $lectura = Leer($path, $arraylectura);
    if ($lectura) {
        for ($i = 0; $i < count($arraylectura); $i++) {
            if ($legajo == $arraylectura[$i]["legajo"] ){
                $Usuario=new Usuario($arraylectura[$i]["legajo"],$arraylectura[$i]["nombre"],
                                    $arraylectura[$i]["clave"],$arraylectura[$i]["email"],
                                    $arraylectura[$i]["foto1"],$arraylectura[$i]["foto2"]);
                return true;
            }
        }
    }
    $error='El legajo no existe';
    return false;
}