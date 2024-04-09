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



    // D'abord, vérifier dans la table des élèves
    $sqlEleve = "SELECT eleve_id, username, password, nom, prenom, age, classe FROM eleves WHERE username = :username";
    $sqlParent = "SELECT parent_id, username, password, nom, prenom FROM parents WHERE username = :username";

    $isEleve = true; // Flag pour indiquer si l'utilisateur est un élève

    $stmt = $pdo->prepare($sqlEleve);
    $stmt->bindParam(":username", $username, PDO::PARAM_STR);
    if (!$stmt->execute() || $stmt->rowCount() == 0) {
        // Si aucun élève n'est trouvé, vérifier dans la table des parents
        $stmt = $pdo->prepare($sqlParent);
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $stmt->execute();
        $isEleve = false; // Ce n'est pas un élève
    }

    if ($stmt->rowCount() == 1) {
        if ($row = $stmt->fetch()) {
            if (password_verify($password, $row['password'])) { // Utilisation de password_verify pour vérifier le hachage de mot de passe
                // Enregistrer les données en session, y compris les informations supplémentaires
                $_SESSION["loggedin"] = true;
                $_SESSION["id"] = $isEleve ? $row['eleve_id'] : $row['parent_id'];
                $_SESSION["username"] = $username;
                $_SESSION["nom"] = $row['nom'];
                $_SESSION["prenom"] = $row['prenom'];
                $_SESSION["profile"] = $isEleve ? "eleve" : "parent"; // Ajouter le type de profil à la session

                // Si c'est un élève, enregistrer également son âge et sa classe
                if ($isEleve) {
                    $_SESSION["age"] = $row['age'];
                    $_SESSION["classe"] = $row['classe'];
                }

                header("location: index.php");
                exit;
            } else {
                $loginError = "Le mot de passe que vous avez entré n'était pas valide.";
            }
        }
    } else {
        $loginError = "Aucun compte trouvé avec ce nom d'utilisateur.";
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="../css/connexion.css">
    <link rel="icon" href="../images/favicon.ico" type="image/x-icon">

</head>
<body>

<div class="login-container">
    <div class="logo">
        <img src="../images/logo.png" alt="The Safe Place" style="height: 200px;">
    </div>

    <a class="back-button" href="index.php"> ← Retour</a>
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
