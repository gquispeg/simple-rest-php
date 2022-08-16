<?php
    define("STATUS", 200);
    define("HEADERS", array('Content-Type',
                            'Content-Type: application/json;charset=utf-8'
    )
            );
    define("TOKEN","");
    define("HTTP_METODO", array(
        'GET',
        'POST',
        'PATCH',
        'DELETE'
    ));
    
    define ("HTTP_RSLT", array(
        'OK'=>200,
        'CREADO', 201,
        'ACEPTADO', 202,
        'NO EXISTE', 400,
        'NO AUTORIZADO', 401,
        'NO EXISTE', 400,
        'ERROR INTERNO', 500
    ));
?>