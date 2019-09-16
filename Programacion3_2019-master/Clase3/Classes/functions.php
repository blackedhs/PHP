<?php

    /*
        function Escribir(){

            $archivo = fopen("archivo.txt","a");

            $rta = fwrite($archivo, $_POST["nombre"].";".$_POST["apellido"].";".$_POST["legajo"].PHP_EOL);

            fclose($archivo);
            
        }
                                        */

    /*
            function Leer(){

                $archivo = fopen("archivo.txt","r");

                while(!feof($archivo))
                {
                    $str = explode(";", fgets($archivo));

                    if(count($str)==3)
                        $personas[] = new Persona($str[0], $str[1], $str[2]);
                }

                fclose($archivo);

                return $personas;
            }
                                        */
    /*
        function Borrar($borrar){
            $personas = Leer();
            $retorno = array();

            for ($i=0; $i < count($personas); $i++) { 
                if ($personas[$i]->legajo != $borrar->legajo) {
                    $retorno[]=$personas[$i];
                }
            }    

            return $retorno;
        }
                                        */

    function Escribir($dato){

        $aux = Leer();

        $archivo = fopen("jayson.json", "a");
        array_push($aux, $dato);
        $rta = fwrite($archivo, json_encode($aux));
        fclose($archivo);

    }

    function Leer(){

        $archivo = fopen("jayson.json", "a");
        fclose($archivo);

        $archivo = fopen("jayson.json", "r");

        if (filesize($archivo)>0)
            $aux = fread($archivo, filesize($archivo));
        else{
            fclose($archivo);
            return array();
        }

        return json_decode($aux);
    }

    function Borrar($borrar){
        $aux = Leer();
        $retorno = array();

        for ($i=0; $i < count($aux); $i++) { 
            if ($aux[$i][0] != $borrar[0]) {
                $retorno[] = $aux[$i];
            }
        }    

        return json_encode($retorno);
    }

?>