<?php
    namespace SimpleRestPHP;

    class FuncionesGet{
        public function GetRoute(){
            return $_SERVER['REQUEST_URI'];
        }
        public static function GetId(){
            $ruta = $_SERVER['REQUEST_URI'];
            if(substr($ruta, -1) == '/'){
                $ruta = false;
            }else{
                $ruta = explode("/", $ruta);
                $ruta = $ruta[count($ruta)-1];
                $ruta = explode("?", $ruta);
                $ruta = $ruta[0];
            }
            return $ruta;
        }
        public function GetParametros(){
            return $_REQUEST;
        }
        public static function GetBody(){
            //leer el body enviado en formato raw-json
            return file_get_contents('php://input');
        }
        public function GetAuthBasica(){
            //autprization basica
            $rsl = array(
                'user' => $_SERVER['PHP_AUTH_USER'],
                'pass' => $_SERVER['PHP_AUTH_PW']
            );
            return $rsl;
        }
        public function GetHeader($tipo){
            $tipo = "HTTP_".strtoupper($tipo);
            if(defined($tipo)){
                return $_SERVER[$tipo];
            }
            Utils::Respuesta("False", "Header ".$tipo." no encontrado");
        }
        public function GetHeaders(){
            return getallheaders();
        }
        public function GetServer(){
            return $_SERVER;//info del server
        }
    }
?>