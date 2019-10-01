<?php
class Alumno
{
    public $nombre;
    public $apellido;
    public $email;
    public $foto;

    function __construct($nom, $apell, $mail, $foto)
    {
        $this->nombre = $nom;
        $this->apellido = $apell;
        $this->email = $mail;
        $this->foto = $foto;
    }
}
function AltaAlumno($alum, $path, &$ErrorAlta)
{
    $alumnoValido = AlumnoValido($alum, $Error);
    $noExiste = AlumnoNoExiste($alum, $path);
    if ($alumnoValido && $noExiste) {
        Guardar($alum, $path);
        return true;
    } else {
        if ($alumnoValido == false)
            $ErrorAlta = $Error;
        if ($noExiste == false)
            $ErrorAlta = $ErrorAlta . ' Alumno ya cargado en nuestra base';
        return false;
    }
}
function ConsultarAlumno($apellido, $path, &$listaDealumnos)
{
    $listaDealumnos = array();
    if (Leer($path, $arrayAlumnos)) {
        $bandera=false;
        for ($i = 0; $i < count($arrayAlumnos); $i++) {
            if ($apellido == $arrayAlumnos[$i]["apellido"]) {
                array_push($listaDealumnos, $arrayAlumnos[$i]);
                $bandera=true;
            }
        }
        if ($bandera) {
            return true;
        }
    } else
        return false;
}
function AlumnoNoExiste($alum, $path)
{
    $lectura = Leer($path, $arraylectura);
    if ($lectura) {
        for ($i = 0; $i < count($arraylectura); $i++) {
            if ($alum->email == $arraylectura[$i]["email"])
                return false;
        }
    }
    return true;
}
function AlumnoValido($alum, &$Error)
{
    $Error = "";
    if (!preg_match("/^[a-zA-Z ]*$/", $alum->nombre)) {
        $Error = $Error . 'Nombre invalido ';
    }
    if (!preg_match("/^[a-zA-Z ]*$/", $alum->apellido)) {
        $Error = $Error . '-Apellido invalido ';
    }
    if (!filter_var($alum->email, FILTER_VALIDATE_EMAIL)) {
        $Error = $Error . '-Email invalido ';
    }
    if ($Error == "")
        return true;
    else
        return false;
}
function AlumnoBuscar($email, $path, &$alumno)
{
    $lectura = Leer($path, $arraylectura);
    if ($lectura) {
        for ($i = 0; $i < count($arraylectura); $i++) {
            if ($email == $arraylectura[$i]["email"]){
                $alumno=new Alumno($arraylectura[$i]["nombre"],$arraylectura[$i]["apellido"],
                $arraylectura[$i]["email"] ,$arraylectura[$i]["foto"]);
                return true;
            }
        }
    }
    return false;
}
function AlumnoModificar($alumno,$path)
{
    $lectura = Leer($path, $arraylectura);
    if ($lectura) {
        for ($i = 0; $i < count($arraylectura); $i++) {
            if ($alumno->email == $arraylectura[$i]["email"]){
                $arraylectura[$i]=$alumno;
                Modificar($arraylectura,$path);
                return true;
            }
        }
    }
    return false;
}