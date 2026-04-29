

<?php
    $titre = "CineSIO - Connexion";
    include __DIR__.'/../src/includes/header.php';
    require_once __DIR__.'/../src/lib/function.php';
    require_once __DIR__.'/../src/repositories/utilisateurRepository.php';

    $message = '';
    $errors = [];
    $success = false;
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');
        
        // Validation
        if (empty($email)) {
            $errors[] = "L'email est obligatoire.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "L'email n'est pas valide.";
        }
        
        if (empty($password)) {
            $errors[] = "Le mot de passe est obligatoire.";
        }
        
        if (empty($errors)) {
            $user = findUtilisateurByEmail($email);
            if ($user && password_verify($password, $user['mot_de_passe'])) {
                // Connexion réussie
                $_SESSION['utilisateur'] = [
                'id' => $user['id'],
                'pseudo' => $user['pseudo']
                ];
                $success = true;
                $message = "Connexion réussie !";
                // Optionnel : rediriger vers index.php
                // header('Location: index.php');
                // exit;
            } else {
                $errors[] = "Email ou mot de passe incorrect.";
            }
        }
    }
?>

<main>
    <h2>CONNEXION</h2>
    <p>Accedez à votre espace membre CinéSIO.</p>
    
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
                <label class="form-label">Adresse Email <span class="form-required">*</span></label>
                <input type="email" name="email" placeholder="Ex: votre@email.com" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" class="form-input">
            </div>
            
            <div class="form-group-row">
                <div>
                    <label class="form-label">Mot de passe <span class="form-required">*</span></label>
                    <input type="password" name="password" class="form-input">
                </div>
    
            
            <button type="submit" class="form-button">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0z"/>
  <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
</svg> Se connecter
        </form>
      
    </div>
     <p> Pas encore de compte ? <a href="inscription.php">Créer un compte</a></p>
</main>

<?php
    include __DIR__.'/../src/includes/footer.php';
?>