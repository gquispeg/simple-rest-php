<?php
$srv = new server;
$rsl['metodo']=$srv->getMethod();







class server{
	private $status	= 200;
	private $header	= array('Content-Type');
	private $body	= '';	

	//Propiedades SET
	//header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS');
	//Crear function para Metodos permitidos

	public function setStatus($codigo){
		$this->status = $codigo;
	}
	
	public function setBody($body){
		$this->body = $body;
	}
		
	public function setHeader($header){
		$this->header = $header;
	}

	//Propiedades GET
	public function getMethod(){
		return $_SERVER['REQUEST_METHOD'];
	}

	public function getPage(){
		return $_SERVER['REQUEST_URI'];
	}

	public function getHeader(){
		//obtener solo la cadena sin página web
		$divi	=$_SERVER['REQUEST_URI'];
		return substr($divi, strpos($divi,'/',1)+1);
	}
	
	public function getBody(){
		//leer el body enviado en formato raw-json
		return file_get_contents('php://input');
	}

	public function getParametros(){
		//enviado como parametro en la barra de direcciones despues del ?
		return json_encode($_REQUEST);
	}
	
	public function getAuthBasica(){
		//autprization basica
		$rsl['user']		=$_SERVER['PHP_AUTH_USER'];
		$rsl['password']	$_SERVER['PHP_AUTH_PW'];
		
		return $rsl;
	}

	//Ejecutar
	public function run(){
		foreach($this->header as $cadena){
			header($cadena);
		}
		
		http_response_code($this->status);
		echo $this->body;
	}
}
?>