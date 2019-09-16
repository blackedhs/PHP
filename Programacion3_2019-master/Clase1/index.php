<?php
    #include 'functions.php';//WARNING
    require_once 'Clases/Persona.php';//FATAL ERROR
    require_once 'Clases/Alumno.php';
    # el ONCE es para que no de error
    // echo "Hola mundo<br/>";

    $persona= new Persona("Carlitos",1234);
    $alumno= new Alumno("Carlitos",1234,1111,3);

    $alumno->saludar();
?>