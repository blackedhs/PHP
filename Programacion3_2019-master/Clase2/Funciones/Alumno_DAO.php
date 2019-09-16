<?php

    function Request($request_method, $array){
        switch ($request_method) {
            case 'POST':                
                Guardar($array);
                break;
            case 'GET':
                Mostrar($array);
                break;
            case 'DELETE':
                Borrar($array);
                break;
            default:
                # code...
                break;
        }
    }

    function Guardar($array){
        $array[] = new Alumno($_POST['nombre'],$_POST['apellido'],$_POST['legajo']);
        return json_encode($array);
    }
    
    function Mostrar($array){          
            var_dump($array);
    }

    function Borrar(){
        $aux = array();
        foreach ($Alumno as $key => $value) {
            if ($value->$legajo!=$_REQUEST['legajo']) {
                $aux[] = $value;
            }
        }
        $Alumno = $aux;
    }

?>