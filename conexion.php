<?php

    $host = 'localhost';
    $user = 'root';
    $password = '';
    $db = 'shoppy_plazy';

    $conection = @mysqli_connect($host,$user,$password,$db);

    

    // mysqli_close($conection);

    if(!$conection){
        echo "Error en la conexión";
    }else{
        
    }

 



?>