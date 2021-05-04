<?php
//header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS');

$rsl['metodo'] = $_SERVER['REQUEST_METHOD'];
$rsl['url'] =  $_SERVER['REQUEST_URI'];

//obtener solo la cadena sin página web
$divi	=$_SERVER['REQUEST_URI'];
echo substr($divi, strpos($divi,'/',1)+1);


$method = $_SERVER['REQUEST_METHOD'];
switch($method){
    case 'PUT':
        $this->create_contact($name);
        break;
    case 'DELETE':
        $this->delete_contact($name);
        break;
    case 'GET':
        $srv = new servicio;
		$srv->setStatus(200);
		$srv->setHeader(array('Content-Type: application/json'));
		$srv->setBody(json_encode($rsl));
		$srv->run();
        break;
    default:
        header('HTTP/1.1 405 Method not allowed');
        header('Allow: GET, PUT, DELETE');
        break;
}



class servicio{
	private $status	= 200;
	private $header	= array('Content-Type');
	private $body	= '';	
	
	public function setStatus($codigo){
		$this->status = $codigo;
	}
	
	public function setBody($body){
		$this->body = $body;
	}
		
	public function setHeader($header){
		$this->header = $header;
	}
	
	public function run(){
		foreach($this->header as $cadena){
			header($cadena);
		}
			
		/*
		--------enviado como parametro en la barra de direcciones despues del ?
		echo json_encode($_REQUEST);
		
		
		--------autprization basica
		echo "<p>Hola {$_SERVER['PHP_AUTH_USER']}.</p>";
		echo "<p>Introdujo {$_SERVER['PHP_AUTH_PW']} como su contraseña.</p>";
		
		--------leer el body enviado en formato raw-json
		echo file_get_contents('php://input');
		*/
		http_response_code($this->status);
		echo $this->body;
	}
}
?>