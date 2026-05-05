<?php
session_start();

session_unset();
session_destroy();

$titre = "CineSIO - Déconnexion";
include __DIR__.'/../src/includes/header.php';
?>

<main class="logout-page">
    <div class="logout-container">
        <h2>DÉCONNEXION</h2>
        <p>Vous avez été déconnecté avec succès.</p>
        <p>Redirection vers la page d'accueil dans quelques secondes...</p>
        <a href="index.php" class="btn">Retour à l'accueil</a>
    </div>
</main>

<script>
    setTimeout(function() {
        window.location.href = 'index.php';
    }, 3000); // Redirect after 3 seconds
</script>

<?php
include __DIR__.'/../src/includes/footer.php';
?>
