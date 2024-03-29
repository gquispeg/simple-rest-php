<?php
    namespace SimpleRestPHP;
    require_once __DIR__ . '/Config.php';
    require_once __DIR__ . '/Utils.php';
    require_once __DIR__ . '/FuncionesGet.php';

    Class App{
        public $status = STATUS;
        public $body = '';

        private $permitidos = METODOS_PERMITIDOS;
        private $listaRutas = array();
        public function Use($ruta, $importar){
            if(array_key_exists($ruta, $this->listaRutas)){
                Utils::Respuesta(500, False, "Ruta principal ".$ruta." se encuentra repetida");
            }
            $this->listaRutas[$ruta] = $importar;
        }

        //Funciones HTTP
        private $funcionesAPI=[];
        //private $claseActual;
        private function LimpiarMetodo($funcion){
            $funcion = explode(":", $funcion);
            if(count($funcion) == 1){
                return $funcion[0];
            }
            
            return $funcion[0].":";
        }
        public function GET($ruta, $funcion){
            $ruta = $this->LimpiarMetodo($ruta);
            $this->funcionesAPI["GET"][$ruta] = $funcion;
        }
        public function POST($ruta, $funcion){
            $ruta = $this->LimpiarMetodo($ruta);
            $this->funcionesAPI["POST"][$ruta] = $funcion;
        }
        public function PATCH($ruta, $funcion){
            $ruta = $this->LimpiarMetodo($ruta);
            $this->funcionesAPI["PATCH"][$ruta] = $funcion;
        }
        public function DELETE($ruta, $funcion){
            $ruta = $this->LimpiarMetodo($ruta);
            $this->funcionesAPI["DELETE"][$ruta] = $funcion;
        }
        
        //Ejecución del API
        public Function run(){
            Utils::ValidarToken();
            $clase = $this->ImportarArchivoRuta();
            $clase = $this->EjecutarClase($clase);
            $this->EjecutarFuncion($clase);
        }
       
        private function ImportarArchivoRuta(){
            $clase = Utils::ObtenerClase();
            if(array_key_exists($clase, $this->listaRutas)){
                foreach (METODOS_PERMITIDOS as $metodo) {
                    $this->funcionesAPI[$metodo] = array();
                }
                return $clase;
            }
            Utils::Respuesta(500, False, 'Ruta no existe');
        }

        private function EjecutarClase($clase){
            require_once $this->listaRutas[$clase];
            $clase = ucwords($clase)."Controller";
            if(class_exists($clase)){
                return new $clase;
            }else{
                Utils::Respuesta(500, False, 'Clase no existe');
            }
        }
        private function EjecutarFuncion($clase){
            $metodo = $_SERVER['REQUEST_METHOD'];
            $funcion = Utils::ObtenerRutaActual();
            
            if(array_key_exists($funcion, $this->funcionesAPI[$metodo])){
                $funcion = $this->funcionesAPI[$metodo][$funcion];
            }else{
                Utils::Respuesta(500, False, 'Ruta no existe');
            }

            if(function_exists($clase->$funcion())){
                call_user_func($clase->$funcion);
                die();
            }else{
                Utils::Respuesta(500, False, 'Función o método no existe');
            }
        }
    }
?>