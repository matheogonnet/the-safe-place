<?php
// Inclure le fichier de configuration de la base de données
global $pdo;
require_once '../php/db.php'; // Assurez-vous que ce chemin est correct

// Initialiser la session
session_start();

$loginError = '';

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données soumises
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Préparer une déclaration sélectionnant l'utilisateur
    $sql = "SELECT eleve_id, username, password, nom, prenom, age, classe FROM eleves WHERE username = :username";
    if ($stmt = $pdo->prepare($sql)) {
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        if ($stmt->execute()) {
            if ($stmt->rowCount() == 1) {
                if ($row = $stmt->fetch()) {
                    if ($password === $row['password']) { // Utilisez password_verify si vous utilisez le hachage de mot de passe
                        // Enregistrer les données en session, y compris les informations supplémentaires
                        $_SESSION["loggedin"] = true;
                        $_SESSION["id"] = $row['eleve_id'];
                        $_SESSION["username"] = $username;
                        $_SESSION["nom"] = $row['nom'];
                        $_SESSION["prenom"] = $row['prenom'];
                        $_SESSION["age"] = $row['age'];
                        $_SESSION["classe"] = $row['classe'];

                        header("location: index.html"); // Notez que vous pourriez vouloir rediriger vers un fichier .php si vous voulez utiliser les sessions
                        exit;
                    } else {
                        $loginError = "Le mot de passe que vous avez entré n'était pas valide.";
                    }
                }
            } else {
                $loginError = "Aucun compte trouvé avec ce nom d'utilisateur.";
            }
        } else {
            $loginError = "Oops! Quelque chose s'est mal passé. Veuillez réessayer plus tard.";
        }
        unset($stmt);
    }
    unset($pdo);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="../css/connexion.css">
</head>
<body>
<div class="login-container">
    <a class="back-button" href="index.html"> ← Retour</a>
    <?php if ($loginError): ?>
    <p class="error"><?php echo $loginError; ?></p>
    <?php endif; ?>
    <form class="login-form" action="connexion.php" method="post">
        <h2>Connexion</h2>
        <div class="form-group">
            <label for="username">Nom d'utilisateur</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit">Se connecter</button>
        <p class="signup-text">Pas inscrit? <a href="inscription.php">S'inscrire</a></p>
    </form>
</div>
</body>
</html>
