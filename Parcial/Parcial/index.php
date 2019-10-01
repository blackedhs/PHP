<?php  
include_once './Clases/Usuario.php';
include_once './Clases/Funciones.php';
include_once './Clases/Log.php';
$pathUsuarios= './usuarios.json';
$pathBackup= './img/backup/';
$pathLog= './log.json';
$pathImagenes= './img/fotos/';
$metodo = $_SERVER["REQUEST_METHOD"];
$log = new Log($metodo, date("d-m-Y (H:i:s)", time()),$_SERVER['SERVER_ADDR']);
Guardar($log,$pathLog);
switch ($metodo) {
    case 'GET':
        switch ($_GET['caso']) {
            case 'login':
                if(UsuarioBuscar($_GET['legajo'],$_GET['clave'],$pathUsuarios,$usuario,$error ))
                    echo json_encode($usuario);
                else
                    echo json_encode($error);
                break;
            case 'sacarTurno':

                break;
            default:
                # code...
                break;
        }
        break;
    case 'POST':
        switch ($_POST["caso"]) {
            case 'cargarUsuario':
                    if (tratarImagen1($foto1,$pathImagenes)&&tratarImagen2($foto2,$pathImagenes)){
                        $usuario= new Usuario($_POST["legajo"],$_POST["nombre"],$_POST["clave"],$_POST["email"],
                                                $foto1,$foto2);
                        if(AltaUsuario($usuario,$pathUsuarios,$error))
                            echo json_encode('usuario guardado correctamente');
                        else
                            echo json_encode($error);
                    }else{
                        echo json_encode('Erorr al guardar las fotos');
                    }
                break;
            case 'modificarUsuario':
                if(UsuarioBuscarLegajo($_POST["legajo"],$pathUsuarios,$usuario,$error)){
                    if(BackupImagen1($foto1,$pathImagenes,$pathBackup,$usuario->foto1)){
                        if(BackupImagen2($foto2,$pathImagenes,$pathBackup,$usuario->foto2)){
                            $usu= new Usuario($_POST["legajo"],$_POST["nombre"],$_POST["clave"],$_POST["email"],
                            $foto1,$foto2);
                        }else
                            $usu= new Usuario($_POST["legajo"],$_POST["nombre"],$_POST["clave"],$_POST["email"],
                            $foto1,$usuario->foto2);
                    }else
                    {
                        if(BackupImagen2($foto2,$pathImagenes,$pathBackup,$usuario->foto2)){
                            $usu= new Usuario($_POST["legajo"],$_POST["nombre"],$_POST["clave"],$_POST["email"],
                            $usuario->foto1,$foto2);
                        }else
                            $usu= new Usuario($_POST["legajo"],$_POST["nombre"],$_POST["clave"],$_POST["email"],
                            $usuario->foto1,$usuario->foto2);
                    }
                    Modificar($usu,$pathUsuarios);
                    echo json_encode('Modificacion correcta');
                }else
                    echo json_encode($error);
            default:
                # code...
                break;
        }
        break;
}