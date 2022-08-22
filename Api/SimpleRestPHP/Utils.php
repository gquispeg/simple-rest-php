<?php
    namespace SimpleRestPHP;
    
    Class Utils{
        public $utilida;
        static function Respuesta($response, $success, $message, $data=[]){
            $rslt=array(
                "success"=>$success,
                "message"=>$message
            );
            if(count($data) > 0){
                $rslt['data'] = $data;
            }
            http_response_code($response);
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

        static function ObtenerRutaBase(){
            return "/".explode("/", $_SERVER["REQUEST_URI"])[1]."/";
        }

        static function ObtenerClase(){
            $rutaActual = $_SERVER['REQUEST_URI'];
            $rutaActual = explode("?", $rutaActual);
            $rutaActual = $rutaActual[0];
            
            //Limpiando la base
            $cLimpiar = strlen(Utils::ObtenerRutaBase());
            $rutaActual = substr($rutaActual, $cLimpiar);

            //Obteniendo la clase
            $rutaActual = explode("/", $rutaActual);
            $rutaActual = $rutaActual[0];
            return $rutaActual;
        }

        static function ObtenerCodigo(){
            $ruta = $_SERVER['REQUEST_URI'];
            $ruta = explode("?", $ruta);
            $ruta = $ruta[0];

            $ruta = explode("/", $ruta);
            $ruta = $ruta[count($ruta)-1];
            
            return $ruta;
        }

        static function ObtenerRutaActual(){
            $rutaActual = $_SERVER['REQUEST_URI'];
            $rutaActual = explode("?", $rutaActual);
            $rutaActual = $rutaActual[0];
            
            //Limpiando la base
            $cLimpiar = strlen(Utils::ObtenerRutaBase());
            $rutaActual = substr($rutaActual, $cLimpiar);
            //Verificando que no se trate de una ruta ID
            if(substr($rutaActual, -1) != '/'){
                $tmp = explode('/', $rutaActual);
                $rutaActual = substr($rutaActual,0, strlen($rutaActual) - strlen($tmp[count($tmp)-1]));
                $rutaActual = $rutaActual.'#';
            }
            return $rutaActual;
        }
   }
?>