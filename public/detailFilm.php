<?php
    $titre = "CineSIO - Details";
    include __DIR__.'/../src/includes/header.php';
    require_once __DIR__.'/../src/lib/function.php';
    require_once __DIR__.'/../src/repositories/filmRepository.php';
    
?>
<?php
    $id = $_GET['id'] ?? '';
    $film = false;
    
    if ($id && is_numeric($id) && (int)$id > 0) {
        $film = findFilmById((int)$id);
    }
?>

<main>
    <?php if ($film): ?>
        <a href="index.php" class="detail-back-link">← Retour au catalogue</a>
        
        <div class="card card-detail">
            <!-- Image -->
            <div class="card-detail-image">
                <img src="<?= $film['image'] ?>" alt="<?= $film['titre'] ?>">
            </div>
            
            <!-- Infos -->
            <div class="card-detail-content">
                <div class="detail-meta">
                    <span class="badge-genre"><?= $film['initiale'] ?></span>
                    <span class="detail-genre-info"><?= $film['nom'] ?> • <?= date('Y', strtotime($film['date_sortie'])) ?></span>
                </div>
                
                <h1 class="detail-title"><?= $film['titre'] ?></h1>
                
                <p class="detail-duration">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#7c3aed" viewBox="0 0 16 16">
                        <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm0-1A7 7 0 1 1 8 1a7 7 0 0 1 0 14z"/>
                    </svg>
                    <?= convertirDuree($film['duree']) ?>
                </p>
                
                <h3 class="detail-synopsis-title">Synopsis</h3>
                <p class="detail-synopsis"><?= $film['synopsis'] ?></p>
                
                <a href="index.php" class="btn-secondary">On verra plus tard...</a>
            </div>
        </div>
    <?php else: ?>
        <a href="index.php" class="detail-back-link">← Retour au catalogue</a>
        <div class="card card-not-found">
            <h1 class="not-found-title">Film introuvable</h1>
            <p class="not-found-text">Désolé, le film que vous recherchez n'existe pas ou n'est plus disponible dans notre catalogue.</p>
            <a href="index.php" class="btn-secondary">Explorer le catalogue</a>
        </div>
    <?php endif; ?>
</main>

<?php
    include __DIR__.'/../src/includes/footer.php';
?>