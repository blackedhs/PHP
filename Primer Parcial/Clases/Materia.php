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
    if (Guardar($materia, $path))
        return true;
    else
        return false;
}
