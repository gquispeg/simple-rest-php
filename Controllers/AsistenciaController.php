<?php
use SimpleRestPHP as rest;
    function Principal(){
        echo "Api corriendo OK";
    }
    function MarcarAsistencia($id){
        echo "Marcar ".$id;
    }
    
    function ObtenerEspecifico($id){
        echo rest\FuncionesGet::GetBody();
        //echo "Ejecutando especifico ".$id;
    }
    function ObtenerTodos(){
        echo "Ejecutando Todos";
    }
    
    function EliminarLog(){
        echo "Ejecutando eliminacion";
    }
?>