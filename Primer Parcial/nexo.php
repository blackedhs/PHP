<?php
include_once './Clases/Alumno.php';
include_once './Clases/Funciones.php';
include_once './Clases/Materia.php';
include_once './Clases/Inscripciones.php';
$metodo = $_SERVER["REQUEST_METHOD"];
$pathAlumnos = './alumnos.txt';
$pathMateria = './materia.txt';
$pathInscrip = './inscripciones.txt';
$pathimagen;
var_dump($metodo);
//var_dump($_SERVER);
switch ($metodo) {
    case 'GET':
        switch ($_GET['caso']) {
            case 'consultarAlumno':
                $listaAlumnos='';
                if(ConsultarAlumno($_GET['apellido'],$pathAlumnos,$listaAlumnos))
                    var_dump(json_encode($listaAlumnos,true));
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
            case 'cargarMateria':
                $materia= new Materia($_POST["nombre"],$_POST["cod"],$_POST["cupo"],$_POST["aula"]);
                if(AltaMateria($materia,$pathMateria,$errorAlta))
                    echo 'La materia se cargo correctamente';
                else
                    echo 'Error :'.$errorAlta;
                break;
            case 'inscribirAlumno':
                $alum= new Alumno($_POST["nombreAlum"], $_POST["apellidoAlum"], $_POST["email"], '');
                $materia=new Materia($_POST["nombreMateria"],$_POST["codigoMateria"],'','');
                if(inscribirAlumno($alum,$materia,$pathAlumnos,$pathMateria,$pathInscrip,$Error))
                    echo 'La incripcion fue un exito';
                else
                    echo 'Error: '.$Error;
                break;
            case 'modificarAlumno':
                if(AlumnoBuscar($_POST["email"], $pathAlumnos, $alumno)){
                    if(BackupImagen($pathimagen,$alumno)){
                        $alumno->nombre= $_POST["nombre"];
                        $alumno->apellido= $_POST["apellido"];
                        $alumno->foto=$pathimagen;
                        if(Modificar($alumno,$pathAlumnos)){
                            echo 'Alumno Modificado';
                        }
                    }else{
                        $alumno->nombre= $_POST["nombre"];
                        $alumno->apellido= $_POST["apellido"];
                        if(Modificar($alumno,$pathAlumnos)){
                            echo 'Alumno Modificado - Imagen no modificada';
                        }
                    }
                }else
                    echo ' El alumno a modificar no existe';
                break;
            default:
                # code...
                break;
        }
        break;
}
