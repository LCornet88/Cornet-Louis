<?php

//definir une fonction qui retourne une cpnnexion avec le serveur de base de donnee
require_once __DIR__ . "/../config/database.php";

function getConnexion(){
    
    try {
        $dsn = "pgsql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME;
        $connexion = new PDO($dsn, DB_USER, DB_PASSWORD);
        return $connexion;
    } catch (PDOException $erreur) {
        echo "Erreur :" . $erreur ->getMessage();
        exit;
    }

}