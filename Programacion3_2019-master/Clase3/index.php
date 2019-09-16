<?php 

    include_once "./Classes/Persona.php";
    include_once "./Classes/functions.php";

    //var_dump(Leer());

    Escribir(new Persona($_POST["legajo"], $_POST["nombre"], $_POST["apellido"]));


?>