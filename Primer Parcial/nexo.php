<?php
include_once './Clases/Alumno.php';
include_once './Clases/Funciones.php';
include_once './Clases/Materia.php';
$metodo = $_SERVER["REQUEST_METHOD"];
$pathAlumnos = './alumnos.txt';
$pathMateria = './materia.txt';
$pathimagen;
var_dump($metodo);
//var_dump($_SERVER);
switch ($metodo) {
    case 'GET':
        switch ($_GET['caso']) {
            case 'consultarAlumno':
                $listaAlumnos='';
                if(ConsultarAlumno($_GET['apellido'],$pathAlumnos,$listaAlumnos))
                    var_dump($listaAlumnos);
                else
                    echo '“No existe alumno con apellido '.$_GET['apellido'];
                break;
            
            default:
                # code...
                break;
        }
        break;
    case 'POST':
        switch ($_POST["caso"]) {
            case 'cargarAlumno':
                if (!tratarImagen($pathimagen)) {
                    echo 'No se puedo guardar la imagen';
                }
                $alumno = new Alumno($_POST["nombre"], $_POST["apellido"], $_POST["email"], '');
                $errorAlta='';
                if (AltaAlumno($alumno,$pathAlumnos,$errorAlta))
                    echo 'alumno cargado correctamete';
                else
                    echo $errorAlta;
                break;
            case 'inscripciones':
                $materia= new Materia($_POST["nombre"],$_POST["cod"],$_POST["cupo"],$_POST["aula"]);
                AltaMateria($materia,$pathMateria,$errorAlta);
            default:
                # code...
                break;
        }
        break;
}
