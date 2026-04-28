<?php

require_once __DIR__ . "/../database/connection.php";

function findAllFilms() {
    $connexion = getConnexion();
    $sql = "SELECT film.*, pays.nom as pays_nom, pays.initiale, genre.nom 
            FROM film 
            JOIN genre ON film.id_genre = genre.id 
            JOIN pays ON film.id_pays = pays.id";
    $requete = $connexion->prepare($sql);
    $requete->execute();
    return $requete->fetchAll(PDO::FETCH_ASSOC);
}


function findFilmById($id) {
    $connexion = getConnexion();
    $sql = "SELECT film.*, pays.nom as pays_nom, pays.initiale, genre.nom 
            FROM film 
            JOIN genre ON film.id_genre = genre.id 
            JOIN pays ON film.id_pays = pays.id 
            WHERE film.id = :id";
    $requete = $connexion->prepare($sql);
    $requete->bindParam(':id', $id, PDO::PARAM_INT);
    $requete->execute();
    return $requete->fetch(PDO::FETCH_ASSOC);
}

function findAllGenres() {
    $connexion = getConnexion();
    $sql = "SELECT * FROM genre ORDER BY nom";
    $requete = $connexion->prepare($sql);
    $requete->execute();
    return $requete->fetchAll(PDO::FETCH_ASSOC);
}

function findAllPays() {
    $connexion = getConnexion();
    $sql = "SELECT * FROM pays ORDER BY nom";
    $requete = $connexion->prepare($sql);
    $requete->execute();
    return $requete->fetchAll(PDO::FETCH_ASSOC);
}

function insertFilm(array $filmData): bool {
    $connexion = getConnexion();
    $sql = "INSERT INTO film (titre, date_sortie, duree, synopsis, image, id_genre, id_pays) 
            VALUES (:titre, :date_sortie, :duree, :synopsis, :image, :id_genre, :id_pays)";
    $requete = $connexion->prepare($sql);
    
    $requete->bindParam(':titre', $filmData['titre']);
    $requete->bindParam(':date_sortie', $filmData['date_sortie']);
    $requete->bindParam(':duree', $filmData['duree'], PDO::PARAM_INT);
    $requete->bindParam(':synopsis', $filmData['synopsis']);
    $requete->bindParam(':image', $filmData['image']);
    $requete->bindParam(':id_genre', $filmData['id_genre'], PDO::PARAM_INT);
    $requete->bindParam(':id_pays', $filmData['id_pays'], PDO::PARAM_INT);
    
    return $requete->execute();
}