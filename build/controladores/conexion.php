<?php
    $servidor ="mysql:dbname=financial_software;host=127.0.0.1";
    $usuario ="root";
    $password="";

    try {
        $pdo = new PDO($servidor,$usuario,$password);
        //echo "conectado";
    } catch (PDOException $e) {
        echo "Conexion Fallida : ".$e->getMessage(); 
    }
?>