<?php

    
    function Escribir($dato,$path){
        if ($dato == null) {
            $aux = Leer($path); 
        }       
        $archivo = fopen($path, "w");
        array_push($aux, $dato);
        $rta = fwrite($archivo, json_encode($aux));
        fclose($archivo);
    }

    function Leer($path){
        $archivo = fopen($path, "a");
        fclose($archivo);
        $archivo = fopen($path, "r");
         $size= filesize($path);
        if ($size>0)
            $aux = fread($archivo, filesize($path));
        else{
            fclose($archivo);
            return array();
        }

        return json_decode($aux,true);
    }

    function Borrar($borrar,$path){
        $aux = Leer($path);
        $retorno = array();

        for ($i=0; $i < count($aux); $i++) { 
            if ($aux[$i][0] != $borrar[0]) {
                $retorno[] = $aux[$i];
            }
        }    

        return json_encode($retorno);
    }

    function Modificar($obj,$path){
        $aux = Leer($path);       
        foreach ($aux as $value) {
            if($obj["legajo"]==$value["legajo"]){
                $value=$obj;
            }
        }
        Escribir(null,$path); 
    }
    function Backup($legajo,$path){
        $aux = Leer($path);
        $ruta = 0;
        $rta=false;
        
        foreach ($aux as $key =>$persona) {
            var_dump($persona);
            if ($persona->legajo==$legajo) {
                $ruta = $persona->imagen;
                $rta=true;
            }
        }
        $extencion= explode(".",$ruta);
        if ($rta) {
            rename($ruta,"./BackupImages/bk.".$legajo.$extencion[count($extencion)-1]);
        }
        return $rta;
    }

?>