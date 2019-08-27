<?php
class persona{
    public $nombre;
    public $apellido;

    function __construct($nom,$apell)
    {
        $this->nombre=$nom;
        $this->apellido=$apell;
    } 
    public function saludar(){
        echo 'hola'.$this->nombre.' '.$this->apellido;
    }
}
