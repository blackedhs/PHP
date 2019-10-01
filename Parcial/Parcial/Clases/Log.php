<?php
class Log
{
    public $caso;
    public $hora;
    public $ip;
    function __construct($caso,$hora,$ip)
    {
        $this->caso = $caso;
        $this->hora = $hora;
        $this->ip = $ip;
    }
}