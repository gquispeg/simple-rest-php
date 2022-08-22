<?php
    require_once('Controllers/AsistenciaController.php');

    $this->GET('/', 'Principal');
    $this->GET('asistencia/', 'ObtenerTodos');
    $this->GET('asistencia/#', 'ObtenerEspecifico');
    $this->POST('asistencia/#', 'MarcarAsistencia');
    $this->DELETE('asistencia/', 'EliminarLog');
?>