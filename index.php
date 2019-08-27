<?php
include 'funciones.php'; // continua aunq no exista
include 'clases/alumno.php';

//require 'funciones.php'; //siempre es necesario
//require_once 'funciones.php'; //si esta incluido no lo incluye
$nombre = "Federico";
$Apellido = "Andrade";
$Alumno=new Alumno("Fede","Andrade",0,0);
/*echo $nombre . ", " . $Apellido;

$num1 = "-3";
$num2 = "15";

print "\nLa suma de $num1  y $num2  es: ";
printf((int)$num1 + (int)$num2);

$acum = 0;
for ($i = 0; $acum < 1000; $i++) {
  $acum += $i;
}
print "\nLa cantidad de numeros sumados fueron $i\n";
*/
Saludar($Alumno->nombre);
echo '<br>';
Saludar($Alumno->apellido);
echo '<br>';
$Alumno->saludar();


