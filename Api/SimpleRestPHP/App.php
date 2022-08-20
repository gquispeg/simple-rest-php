<?php
    namespace SimpleRestPHP;
    require_once __DIR__ . '/Config.php';
    require_once __DIR__ . '/Utils.php';
    require_once __DIR__ . '/FuncionesGet.php';

    Class App{
        public $status = STATUS;
        public $body = '';

        private $permitidos = array();
        private $headers = HEADERS;

        function __construct(){
            $this->rutaBase = "/".explode("/", $_SERVER["REQUEST_URI"])[1]."/";
        }
        //Ruta base
        private $rutaBase;
        public function Use($ruta, $importar){
            if($ruta != "/"){
                $this->rutaBase = $ruta;
            }
        }

        //Funciones SET
        public function SetPermitidos($permitidos=array('GET')){
            $this->permitidos = $permitidos;
        }
        public function SetHeaders($header){
            $this->header = $header;
        }

        //Funciones HTTP
        private $funcionesAPI=[];
        public function GET($ruta, $funcion){
            $nuevo = array(
                "tipo"=>"GET",
                "ruta"=>$ruta,
                "funcion"=>$funcion
            );
            array_push($this->funcionesAPI, $nuevo);
        }
        public function POST($ruta, $funcion){
            $nuevo = array(
                "tipo"=>"POST",
                "ruta"=>$ruta,
                "funcion"=>$funcion
            );
            array_push($this->funcionesAPI, $nuevo);
        }
        public function PATCH($ruta, $funcion){
            $nuevo = array(
                "tipo"=>"PATCH",
                "ruta"=>$ruta,
                "funcion"=>$funcion
            );
            array_push($this->funcionesAPI, $nuevo);
        }
        public function DELETE($ruta, $funcion){
            $nuevo = array(
                "tipo"=>"DELETE",
                "ruta"=>$ruta,
                "funcion"=>$funcion
            );
            array_push($this->funcionesAPI, $nuevo);
        }
        
        //Ejecución del API
        public Function run(){
            Utils::ValidarToken();
            
            $funcion = Utils::ObtenerRuta($this->rutaBase, $this->funcionesAPI);
            if(function_exists($funcion)){
                http_response_code($this->status);
                foreach($this->headers as $cadena){
                    header($cadena);
                }
                call_user_func($funcion, FuncionesGet::GetId());
                die();
            }else{
                http_response_code(500);
                Utils::Respuesta(False, 'Función o método no existe');
            }
        }
    }
?>