<?php
include 'persona.php';
class Alumno extends persona{
    public $legajo;
    public $cuatrimestre;
    function __construct($nom,$apell,$leg,$cuatri)
    {
        parent::__construct($nom,$apell);
        $this->legajo=$leg;
        $this->cuatrimestre=$cuatri;

    }
}