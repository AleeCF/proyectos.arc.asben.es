<?php

    try{
        $base = new PDO("mysql:host=localhost; dbname=pruebas", "root", "ubuntu");
        $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $base->exec("SET CHARACTER SET utf8");

    }catch(Exception $e){
        
        die("Error : " . $e->getMessage());
    
    }


?>
