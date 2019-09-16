<?php

class Persona{

    public $legajo;
    public $nombre;
    public $apellido;

    function __construct($legajo, $nombre, $apellido){
    
        $this->nombre=$nombre;
        $this->apellido=$apellido;
        $this->legajo=$legajo;
    }
}

?>