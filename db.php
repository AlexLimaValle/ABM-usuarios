<?php
    $server = "localhost"; //127.0.0.1
    $baseDeDatos = "app";
    $usuario = "root";
    $contrasenia = "";

    try{
        $conexion = new PDO("mysql:host=$server;dbname=$baseDeDatos",$usuario,$contrasenia);

    }catch(Exception $error){
        echo $error->getMessage();
    }

    

