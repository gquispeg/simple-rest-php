<?php
require_once('server.php');
    $srv = new server;
    $rsl['metodo']=$srv->getMethod();

    $srv->setStatus(200);
    $srv->setHeader(array('Content-Type: application/json'));
    $srv->setBody(json_encode($rsl));
    $srv->run();


?>