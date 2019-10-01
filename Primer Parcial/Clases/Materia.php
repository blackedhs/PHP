<?php
class Materia
{
    public $nombre;
    public $codigo;
    public $cupo;
    public $aula;

    function __construct($nom, $cod, $cupo, $aula)
    {
        $this->nombre = $nom;
        $this->codigo = $cod;
        $this->cupo = $cupo;
        $this->aula = $aula;
    }
}
function AltaMateria($materia, $path, &$ErrorAlta)
{
    if (MateriaNoExiste($materia,$path)){
        Guardar($materia, $path);
        return true;
    }
    else{
        $ErrorAlta='La Materia ya se encuentra en la base';
        return false;
    }
}
function MateriaNoExiste($materia, $path)
{
    $lectura = Leer($path, $arraylectura);
    if ($lectura) {
        for ($i = 0; $i < count($arraylectura); $i++) {
            if ($materia->codigo == $arraylectura[$i]["codigo"])
                return false;
        }
    }
    return true;
}