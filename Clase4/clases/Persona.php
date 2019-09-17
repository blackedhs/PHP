<?php

class Persona{

    static $cantidad;
    public $legajo;
    public $nombre;
    public $apellido;
    public $imagen;

    function __construct($legajo, $nombre="", $apellido="",$imagen = ""){
    
        $this->nombre=$nombre;
        $this->apellido=$apellido;
        $this->legajo=$legajo;
        $this->imagen=$imagen;
    }
}

?>