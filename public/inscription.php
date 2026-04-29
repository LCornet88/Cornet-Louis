<?php
    $titre = "CineSIO - Inscription";
    include __DIR__.'/../src/includes/header.php';
    require_once __DIR__.'/../src/lib/function.php';
    require_once __DIR__.'/../src/repositories/utilisateurRepository.php';

    $message = '';
    $errors = [];
    $success = false;
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = trim($_POST['email'] ?? '');
        $pseudonyme = trim($_POST['pseudonyme'] ?? '');
        $password = trim($_POST['password'] ?? '');
        $confirm_password = trim($_POST['confirm_password'] ?? '');

        
        // Validation
        if (empty($email)) {
            $errors[] = "L'email est obligatoire.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "L'email n'est pas valide.";
        }

        if (empty($pseudonyme)) {
            $errors[] = "Le pseudonyme est obligatoire.";
        } elseif (strlen($pseudonyme) < 3) {
            $errors[] = "Le pseudonyme doit contenir au moins 3 caractères.";
        }

        if (empty($password)) {
            $errors[] = "Le mot de passe est obligatoire.";
        } elseif (strlen($password) < 8) {
            $errors[] = "Le mot de passe doit contenir au moins 8 caractères.";
        }

        if (empty($confirm_password)) {
            $errors[] = "La confirmation du mot de passe est obligatoire.";
        } elseif ($password !== $confirm_password) {
            $errors[] = "Les mots de passe ne correspondent pas.";
        }

        if (empty($errors)) {
            // Vérifier si l'utilisateur existe déjà
            $existingUser = findUtilisateurByEmail($email);
            if ($existingUser) {
                $errors[] = "Un compte avec cet email existe déjà.";
            } else {
                $existingPseudo = findUtilisateurByPseudo($pseudonyme);
                if ($existingPseudo) {
                    $errors[] = "Ce pseudonyme est déjà utilisé.";
                } else {
                    // Insérer l'utilisateur
                    $userData = [
                        'pseudo' => $pseudonyme,
                        'email' => $email,
                        'mot_de_passe' => password_hash($password, PASSWORD_DEFAULT)
                    ];
                    if (createUtilisateur($userData)) {
                        $success = true;
                        $message = "Votre compte a été créé avec succès !";
                    } else {
                        $errors[] = "Erreur lors de la création du compte.";
                    }
                }
            }
        }
    }
?>

<main>
    <h2>Créer un compte</h2>
    <p>Rejoignez la communauté CinéSIO pour acceder à toutes les fonctionnalités.</p>
    

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
<main>

    
    <div class="card card-form">
        <form method="POST" style="max-width: 600px;">
            <div class="form-group">
                <label class="form-label">Adresse Email <span class="form-required">*</span></label>
                <input type="email" name="email" placeholder="Ex: john.doe@example.com" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" class="form-input">
            </div>

            
            <div class="form-group-row">
                <div>
                    <label class="form-label">Pseudonyme<span class="form-required">*</span></label>
                    <input type="text" name="pseudonyme" placeholder="Ex: JohnDoe" value="<?= htmlspecialchars($_POST['pseudonyme'] ?? '') ?>" class="form-input">
                </div>


                <div>
                    <label class="form-label">Mot de passe <span class="form-required">*</span></label>
                    <input type="password" name="password" placeholder="Votre mot de passe" class="form-input">
                    
                </div>
            </div>
            
            <div class="form-group">
                <label class="form-label">Confirmation du mot de passe <span class="form-required">*</span></label>
                <input type="password" name="confirm_password" placeholder="Confirmez votre mot de passe" class="form-input">
            </div>
            
    
            
            
            
            <button type="submit" class="form-button">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-add" viewBox="0 0 16 16">
  <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4"/>
  <path d="M8.256 14a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z"/>
</svg> M'inscrire maintenant
            </button>
            <p> Déja un compte ? <a href="connexion.php">Connectez-vous</a></p>
        </form>
    </div>
</main>
<?php
    include __DIR__.'/../src/includes/footer.php';
?>
