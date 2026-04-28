<?php

require_once __DIR__ . "/../database/connection.php";


function findUtilisateurByEmail(string $email) {
    $connexion = getConnexion();
    $sql = "SELECT * FROM utilisateur WHERE email = :email";
    $requete = $connexion->prepare($sql);
    $requete->bindParam(':email', $email, PDO::PARAM_STR);
    $requete->execute();
    return $requete->fetch(PDO::FETCH_ASSOC);
}

function findUtilisateurByPseudo(string $pseudo) {
    $connexion = getConnexion();
    $sql = "SELECT * FROM utilisateur WHERE pseudo = :pseudo";
    $requete = $connexion->prepare($sql);
    $requete->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
    $requete->execute();
    return $requete->fetch(PDO::FETCH_ASSOC);
}

function createUtilisateur(array $data): bool {
    $connexion = getConnexion();
    $sql = "INSERT INTO utilisateur (pseudo, email, mot_de_passe) 
            VALUES (:pseudo, :email, :mot_de_passe)";
    $requete = $connexion->prepare($sql);
    
    $requete->bindParam(':pseudo', $data['pseudo']);
    $requete->bindParam(':email', $data['email']);
    $requete->bindParam(':mot_de_passe', $data['mot_de_passe']);
    
    return $requete->execute();
}