<?php
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    require_once 'Api/SimpleRestPHP/App.php';

    $api = New SimpleRestPHP\App();
    $api->use('asistencia', 'Routes/AsistenciaRoute.php');
    $api->run();
?>