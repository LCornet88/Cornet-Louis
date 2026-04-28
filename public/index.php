<?php
    $titre = "CineSIO - Acceuil";
    include __DIR__.'/../src/includes/header.php';
    require_once __DIR__.'/../src/lib/function.php';
    require_once __DIR__.'/../src/repositories/filmRepository.php';
    $films = findAllFilms();


?>

<main>
    <!-- Contenu de la page -->
    <h2>Catalogue des Films</h2>
    <p>Il y a actuellement <span class="catalog-count"><?= count($films) ?></span> films dans le catalogue.</p>
    <div class="container">
        <?php foreach ($films as $film): ?>
            
            
            <div class="card">
                
                <!-- Image de fond -->
                <img src="<?= $film['image'] ?>" alt="Image du film" class="card-image">
                
                <!-- Badge -->
                 <?php
                    $pays = $film['initiale'];
                ?>
                <div class="badge"><?= $acronymes[$pays] ?? $pays ?></div>
                
                <!-- Contenu de la carte -->
                <div class="card-content">
                    <h2 class="card-title"><?= $film['titre'] ?></h2>
                    <p class="card-type"><?= $film['nom'] ?> • <?= convertirDuree($film['duree']) ?>min</p>
                    <p class="card-text"><?= substr($film['synopsis'], 0, 60) ?>...</p>
                    
                    <!-- Boutons -->
                    <div class="card-actions">
                        <a href="detail-film.php?id=<?= $film['id'] ?>" class="btn">Détails</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>

<?php

    include __DIR__.'/../src/includes/footer.php';
?>