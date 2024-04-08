<?php
// Initialiser la connexion à la base de données
$pdo = null;
$inscriptionSuccess = false;
$errorMessage = '';

// Tenter de se connecter à la base de données
try {
    require '../php/db.php'; // Assurez-vous que ce fichier contient la bonne connexion PDO à votre base de données
} catch (PDOException $e) {
    $errorMessage = "Erreur de connexion à la base de données : " . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $pdo !== null) {
    // Récupérer les données du formulaire
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $age = $_POST['age'];
    $schoolLevel = $_POST['school-level'];
    $institutionCode = $_POST['institution-code-1'] . $_POST['institution-code-2'] . $_POST['institution-code-3'] . $_POST['institution-code-4'];
    $password = $_POST['password'];

    try {
        // Préparer la requête SQL pour insérer les données
        $stmt = $pdo->prepare("INSERT INTO eleves (classe, nom, prenom, code_etablissement, password, username,age) VALUES (?, ?, ?, ?, ?, ?,?)");
        // Exécuter la requête avec les données du formulaire
        $stmt->execute([$schoolLevel, $lastname, $firstname, $institutionCode, $password, $username, $age]);

        $inscriptionSuccess = true;
    } catch(PDOException $e) {
        $errorMessage = "Erreur lors de l'inscription : " . $e->getMessage();
    }
}

if ($inscriptionSuccess) {
    header('Location: ../html/index.php'); // Rediriger vers une autre page après l'inscription réussie
    exit;
} else {
    // Afficher le formulaire d'inscription
    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Inscription</title>
        <link rel="stylesheet" href="../css/inscription.css">
    </head>
    <body>
    <div class="signup-container">
        <a class="back-button" href="connexion.php"> ← Retour</a>
        <?php if ($errorMessage): ?>
            <p class="error"><?php echo $errorMessage; ?></p>
        <?php endif; ?>
        <form class="signup-form" action="inscription.php" method="post">
            <h2>Inscription</h2>
            <div class="form-group">
                <label for="firstname">Prenom</label>
                <input type="text" id="firstname" name="firstname" required>
            </div>

            <div class="form-group">
                <label for="lastname">Nom</label>
                <input type="text" id="lastname" name="lastname" required>
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="age">Age</label>
                <input type="number" id="age" name="age" required>
            </div>
            <div class="form-group">
                <label for="school-level">Niveau Scolaire</label>
                <select id="school-level" name="school-level" required>
                    <option value="CE2">CE2</option>
                    <option value="CM2">CM2</option>
                    <option value="5eme">5ème</option>
                    <option value="3eme">3ème</option>
                </select>
            </div>
            <div class="form-group institution-code-group">
                <label for="institution-code-1">Code etablissement</label>
                <div class="institution-code-inputs">
                    <!-- Assurez-vous que ces champs sont correctement traités dans votre script PHP -->
                    <input type="text" id="institution-code-1" name="institution-code-1" maxlength="1" pattern="[A-Za-z0-9]{1}" required title="Lettre ou chiffre" oninput="moveToNext(this, 1)">
                    <input type="text" id="institution-code-2" name="institution-code-2" maxlength="1" pattern="[A-Za-z0-9]{1}" required title="Lettre ou chiffre" oninput="moveToNext(this, 2)">
                    <input type="text" id="institution-code-3" name="institution-code-3" maxlength="1" pattern="[A-Za-z0-9]{1}" required title="Lettre ou chiffre" oninput="moveToNext(this, 3)">
                    <input type="text" id="institution-code-4" name="institution-code-4" maxlength="1" pattern="[A-Za-z0-9]{1}" required title="Lettre ou chiffre" oninput="moveToNext(this, 4)">
                </div>
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">S'inscrire</button>
        </form>
    </div>
    <script src="../js/inscription.js"></script>
    </body>
    </html>
    <?php
} // Fin du bloc else
?>
