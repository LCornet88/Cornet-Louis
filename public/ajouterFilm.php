<?php
    $titre = "CineSIO - Ajouter un film";
    include __DIR__.'/../src/includes/header.php';
    require_once __DIR__.'/../src/lib/function.php';
    require_once __DIR__.'/../src/repositories/filmRepository.php';
    $films = findAllFilms();

    
    $genres = findAllGenres();
    $pays = findAllPays();
    $message = '';
    $errors = [];
    $success = false;
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $titre_film = trim($_POST['titre'] ?? '');
        $date_sortie = trim($_POST['date_sortie'] ?? '');
        $duree = trim($_POST['duree'] ?? '');
        $synopsis = trim($_POST['synopsis'] ?? '');
        $image = trim($_POST['image'] ?? '');
        $id_genre = trim($_POST['genre'] ?? '');
        $id_pays = trim($_POST['pays'] ?? '');
        
        // Validation
        if (empty($titre_film)) {
            $errors[] = "Le titre du film est obligatoire.";
        } elseif (strlen($titre_film) < 2) {
            $errors[] = "Le titre doit contenir au moins 2 caractères.";
        }
        
        if (empty($date_sortie)) {
            $errors[] = "La date de sortie est obligatoire.";
        }
        
        if (empty($duree)) {
            $errors[] = "La durée est obligatoire.";
        } elseif (!is_numeric($duree) || (int)$duree <= 0) {
            $errors[] = "La durée doit être un nombre entier positif.";
        }
        
        if (empty($synopsis)) {
            $errors[] = "Le synopsis est obligatoire.";
        } elseif (strlen($synopsis) < 10) {
            $errors[] = "Le synopsis doit contenir au moins 10 caractères.";
        }
        
        if (empty($image)) {
            $errors[] = "L'URL de l'image est obligatoire.";
        } elseif (!filter_var($image, FILTER_VALIDATE_URL)) {
            $errors[] = "L'URL de l'image n'est pas valide.";
        }
        
        if (empty($id_genre)) {
            $errors[] = "Le genre est obligatoire.";
        } elseif (!is_numeric($id_genre)) {
            $errors[] = "Le genre sélectionné n'est pas valide.";
        }
        
        if (empty($id_pays)) {
            $errors[] = "Le pays est obligatoire.";
        } elseif (!is_numeric($id_pays)) {
            $errors[] = "Le pays sélectionné n'est pas valide.";
        }
        

        if (empty($errors)) {
            $filmData = [
                'titre' => $titre_film,
                'date_sortie' => $date_sortie,
                'duree' => (int)$duree,
                'synopsis' => $synopsis,
                'image' => $image,
                'id_genre' => (int)$id_genre,
                'id_pays' => (int)$id_pays
            ];
            
            if (insertFilm($filmData)) {
                $success = true;
                $message = "Film ajouté avec succès au catalogue!";
            } else {
                $errors[] = "Une erreur est survenue lors de l'insertion en base de données.";
            }
        }
    }
?>

<main>
    <h2>Ajouter un nouveau film</h2>
    <p>Veuillez renseigner les informations ci-dessous pour ajouter un film au catalogue CinéSIO.</p>
    
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
                <label class="form-label">Titre du film <span class="form-required">*</span></label>
                <input type="text" name="titre" placeholder="Ex: Dune: Deuxième Partie" value="<?= htmlspecialchars($_POST['titre'] ?? '') ?>" class="form-input">
            </div>
            
            <div class="form-group-row">
                <div>
                    <label class="form-label">Date de sortie <span class="form-required">*</span></label>
                    <input type="date" name="date_sortie" value="<?= htmlspecialchars($_POST['date_sortie'] ?? '') ?>" class="form-input">
                </div>
                <div>
                    <label class="form-label">Durée (en minutes) <span class="form-required">*</span></label>
                    <input type="number" name="duree" placeholder="Ex: 166" value="<?= htmlspecialchars($_POST['duree'] ?? '') ?>" class="form-input">
                </div>
            </div>
            
            <div class="form-group">
                <label class="form-label">Synopsis <span class="form-required">*</span></label>
                <textarea name="synopsis" placeholder="Le héros commence son péripple..." class="form-textarea"><?= htmlspecialchars($_POST['synopsis'] ?? '') ?></textarea>
            </div>
            
            <div class="form-group">
                <label class="form-label">Affiche web (URL de l'image) <span class="form-required">*</span></label>
                <input type="url" name="image" placeholder="https://exemple.com/image.jpg" value="<?= htmlspecialchars($_POST['image'] ?? '') ?>" class="form-input">
            </div>
            
            <div class="form-group-row">
                <div>
                    <label class="form-label">Genre <span class="form-required">*</span></label>
                    <select name="genre" class="form-select">
                        <option value="">Sélectionnez un genre...</option>
                        <?php foreach ($genres as $genre): ?>
                            <option value="<?= $genre['id'] ?>" <?= (isset($_POST['genre']) && $_POST['genre'] == $genre['id']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($genre['nom']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label class="form-label">Pays <span class="form-required">*</span></label>
                    <select name="pays" class="form-select">
                        <option value="">Sélectionnez un pays...</option>
                        <?php foreach ($pays as $p): ?>
                            <option value="<?= $p['id'] ?>" <?= (isset($_POST['pays']) && $_POST['pays'] == $p['id']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($p['nom']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            
            <button type="submit" class="form-button">
                ⊕ Ajouter ce film au catalogue
            </button>
        </form>
    </div>
</main>

<?php
    include __DIR__.'/../src/includes/footer.php';
?>
