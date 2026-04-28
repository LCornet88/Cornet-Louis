<?php
    $titre = "CineSIO - Ajouter un utilisateur";
    include __DIR__.'/../src/includes/header.php';
    require_once __DIR__.'/../src/lib/function.php';
    require_once __DIR__.'/../src/repositories/utilisateurRepository.php';

    $email = findUtilisateurByEmail($_POST['email'] ?? '');
    $pseudo = findUtilisateurByPseudo($_POST['pseudo'] ?? '');
    $mot_de_passe = $_POST['mot_de_passe'] ?? '';
    $confirmation = $_POST['confirmation'] ?? '';
    $message = '';
    $errors = [];
    $success = false;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = trim($_POST['email'] ?? '');
        $pseudo = trim($_POST['pseudo'] ?? '');
        $mot_de_passe = trim($_POST['mot_de_passe'] ?? '');
        $confirmation = trim($_POST['confirmation'] ?? '');
        }

        // Validation
        if (empty($email)) {
            $errors[] = "L'email est obligatoire.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "L'email n'est pas valide.";
        }

        if (empty($pseudo)) {
            $errors[] = "Le pseudo est obligatoire.";
        }
        elseif (strlen($pseudo) < 3) {
            $errors[] = "Le pseudo doit contenir au moins 3 caractères.";
        }

        if (empty($mot_de_passe)) {
            $errors[] = "Le mot de passe est obligatoire.";
        }elseif (strlen($mot_de_passe) < 8) {
            $errors[] = "Le mot de passe doit contenir au moins 8 caractères.";
        }

         if (empty($confirmation)) {
            $errors[] = "La confirmation du mot de passe est obligatoire.";
        } elseif ($mot_de_passe !== $confirmation) {
            $errors[] = "Les mots de passe ne correspondent pas.";
        }
        ?>

 <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Inscription CINESIO</title>
    </head>
    <body>
        
    </body>
    </html>

    <h2>Créer un compte</h2>
    <p>Rejoignez la communauté CinéSIO pour accéder à toutes les fonctionnalités !</p>
    

   
    <?php if ($success): ?>
        <div class="alert alert-success">
            <p class="alert-title"><?= $message ?></p>
            <p class="alert-link"><a href="index.php">Retourner au catalogue</a></p>
        </div>
    <?php endif; ?>
    
    <?php if (!empty($errors)): ?>
        <div class="alert alert-error">
            <p class="alert-title">Erreurs de validation :</p>
            <ul class="alert-list">
                <?php foreach ($errors as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    
    <div class="card card-form">
        <form method="POST" style="max-width: 600px;">
            <div class="form-group">
                <label class="form-label">Email <span class="form-required">*</span></label>
                <input type="email" name="email" placeholder="Ex: john.doe@example.com" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" class="form-input">
            </div>

            <div class="form-group">
                <label class="form-label">Pseudo <span class="form-required">*</span></label>
                <input type="text" name="pseudo" placeholder="Ex: JohnDoe" value="<?= htmlspecialchars($_POST['pseudo'] ?? '') ?>" class="form-input">
            </div>

            <div class="form-group">
                <label class="form-label">Mot de passe <span class="form-required">*</span></label>
                <input type="password" name="mot_de_passe" placeholder="Ex: MonMotDePasse123" class="form-input">
            </div>

            <div class="form-group">
                <label class="form-label">Confirmation du mot de passe <span class="form-required">*</span></label>
                <input type="password" name="confirmation" placeholder="Ex: MonMotDePasse123" class="form-input">
            </div>

            <button type="submit" class="form-button">
                ⊕ Ajouter cet utilisateur
            </button>
        </form>
    </div>

<?php
    include __DIR__.'/../src/includes/footer.php';
?>
