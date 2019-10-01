<?php
class Incripciones{
    public $nombreAlum;
    public $apellidoAlum;
    public $emailAlum;
    public $materia;
    public $codigoMat;
    
    function __construct($nomb,$apell,$email,$materia,$codMateria)
    {
        $this->nombreAlum=$nomb;
        $this->apellidoAlum=$apell;
        $this->emailAlum=$email;
        $this->materia=$materia;
        $this->codigoMat=$codMateria;

    }
}
function inscribirAlumno($alum,$materia,$pathAlumno,$pathMateria,$pathInscrip,&$Error){
    if (!AlumnoNoExiste($alum,$pathAlumno) && !MateriaNoExiste($materia,$pathMateria)
        && !AlumnoInscrito($alum,$materia, $pathInscrip)){
        $inscripcion = new Incripciones($alum->nombre,$alum->apellido,$alum->email,$materia->nombre,$materia->codigo);
        Guardar($inscripcion,$pathInscrip);
        return true;
    }
    else
    {
        if(AlumnoNoExiste($alum,$pathAlumno))
            $Error = 'El alumno no esiste';
        if(MateriaNoExiste($materia,$pathMateria))
            $Error = $Error.'-La materia no existe no esiste';
        if(AlumnoInscrito($alum,$materia, $pathInscrip))
            $Error = $Error.'-El Alumno esta inscripto';
        return false;
        
    }    
}
function AlumnoInscrito($alum,$materia, $path)
{
    $lectura = Leer($path, $arraylectura);
    if ($lectura) {
        for ($i = 0; $i < count($arraylectura); $i++) {
            if ($alum->email == $arraylectura[$i]["emailAlum"]&& 
            $materia->codigo == $arraylectura[$i]["codigoMat"])
                return true;
        }
    }
    return false;
}