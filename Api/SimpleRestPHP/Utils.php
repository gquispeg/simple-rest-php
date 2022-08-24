<?php
    namespace SimpleRestPHP;
    
    Class Utils{
        static function Respuesta($response, $success, $message, $data = null){
            $rslt=array(
                "success"=>$success,
                "message"=>$message
            );
            if($data !== null){
                $rslt['data'] = $data;
            }
            foreach(HEADERS as $header){
                header($header);
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
            $rutaActual = Utils::ObtenerRutaCompleta();
            $rutaActual = explode("/", $rutaActual);
            $rutaActual = $rutaActual[0];

            if(strlen($rutaActual) == 0){
                return "/";
            }
            return $rutaActual;
        }
        static function ObtenerCodigo(){
            $ruta = Utils::ObtenerRutaCompleta();
            if(substr($ruta, -1) == "/"){
                return "";
            }

            $ruta = explode("/", $ruta);
            return $ruta[count($ruta)-1];
        }
        static function ObtenerParametros(){ //Solo lo que va despues del '?', devuelve una matriz
            $ruta = explode("?", $_SERVER["REQUEST_URI"]);
            if(count($ruta)  > 0){
                return explode("&", $ruta[1]);
            }
            return "";
        }
        static function ObtenerRutaCompleta(){ //Ruta completa, limpiando la base, limpiando parametros
            $rutaActual = $_SERVER['REQUEST_URI'];
            $cLimpiar = strlen(Utils::ObtenerRutaBase());
            $rutaActual = substr($rutaActual, $cLimpiar);
            $rutaActual = explode("?", $rutaActual);
            return $rutaActual[0];
        }
        static function ObtenerRutaParaControllers(){
            $rutaActual = Utils::ObtenerRutaCompleta();

            //Verificando que no se trate de una ruta ID
            if(strlen($rutaActual) == 0){
                return "/";
            }

            if(substr($rutaActual, -1) != '/'){
                $tmp = explode('/', $rutaActual);
                $rutaActual = substr($rutaActual,0, strlen($rutaActual) - strlen($tmp[count($tmp)-1]));
                $rutaActual = $rutaActual.'#';
            }
            return $rutaActual;
        }
   }
?>