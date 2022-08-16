<?php
    require_once('Controllers/AsistenciaController.php');

    $api->GET('/', 'Principal');
    $api->GET('/asistencia/', 'ObtenerTodos');
    $api->GET('/asistencia/:id', 'ObtenerEspecifico');
    $api->POST('/asistencia/:id', 'MarcarAsistencia');
    $api->DELETE('/asistencia/', 'EliminarLog');
?>