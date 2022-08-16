<?php
    namespace SimpleRestPHP;
    
    Class Utils{
        static function Respuesta($success, $message, $data=[]){
            $rslt=array(
                "success"=>$success,
                "message"=>$message
            );
            if(count($data) > 0){
                $rslt['data'] = $data;
            }
    
            echo json_encode($rslt, JSON_UNESCAPED_UNICODE);
            die();
        }
        static function ValidarToken(){
            if(defined("TOKEN")){
                if(TOKEN != "" && $_SERVER['HTTP_TOKEN'] != TOKEN){
                    Utils::Respuesta(False, 'No autorizado');
                }
            }
        }
        static function ObtenerRuta($rutaBase, $listaFunciones){
            $metodo = $_SERVER['REQUEST_METHOD'];
            $rutaActual = $_SERVER['REQUEST_URI'];
            $rutaActual = explode("?", $rutaActual);
            $rutaActual = $rutaActual[0];
            
            if(substr($rutaActual, -1) != '/'){
                $tmp = explode('/', $rutaActual);
                $rutaActual = substr($rutaActual,0, strlen($rutaActual) - strlen($tmp[count($tmp)-1]));
                $rutaActual = $rutaActual.':';
            }
            foreach($listaFunciones as $funcion){
                if($metodo == $funcion['tipo']){
                    $rutasApi = $rutaBase.$funcion['ruta'];
                    $rutasApi = explode(':', $rutasApi);
                    if(count($rutasApi) == 1){
                        $rutasApi = $rutasApi[0];
                    }else{
                        $rutasApi = $rutasApi[0].':';
                    }
                    $rutasApi = str_replace('//','/',$rutasApi);
                    if($rutaActual == $rutasApi){
                        return $funcion['funcion'];
                    }
                }
            }
            return false;
        }
    }
?>