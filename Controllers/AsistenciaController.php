<?php
    use SimpleRestPHP\Utils;

    class AsistenciaController{
        function Principal(){
            Utils::Respuesta(200, True, "corriendo principal ".Utils::ObtenerCodigo());
        }
        function MarcarAsistencia(){
            Utils::Respuesta(200, True, "corriendo marcar ".Utils::ObtenerCodigo());
        }
        
        function ObtenerEspecifico(){
            Utils::Respuesta(200, True, "corriendo obtener todos".rest\FuncionesGet::GetBody());
        }
        function ObtenerTodos(){
            Utils::Respuesta(200, True, "corriendo obtener todos");
        }
        
        function EliminarLog(){
            Utils::Respuesta(200, True, "corriendo eliminacion log");
        }
    }
?>