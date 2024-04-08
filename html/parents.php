<?php
global $pdo;
session_start(); // Démarrer la session pour accéder aux variables de session

require_once "../php/db.php"; // Inclure le fichier de connexion à la base de données

// Initialisation des variables pour stocker les informations de l'élève
$nom = $prenom = $age = $classe = '';

if(isset($_SESSION["id"]) && $_SESSION["profile"] === "parent") {
    // Récupérer l'identifiant du parent connecté
    $parentId = $_SESSION["id"];

    try {
        // Récupérer l'eleve_id associé à ce parent
        $stmt = $pdo->prepare("SELECT enfant_id FROM parents WHERE parent_id = ?");
        $stmt->execute([$parentId]);
        $result = $stmt->fetch();

        if ($result) {
            $eleveId = $result['enfant_id'];

            // Utiliser l'eleve_id pour récupérer les informations de l'élève
            $stmt = $pdo->prepare("SELECT nom, prenom, age, classe FROM eleves WHERE eleve_id = ?");
            $stmt->execute([$eleveId]);
            $eleveInfo = $stmt->fetch();

            if ($eleveInfo) {
                // Stocker les informations récupérées dans des variables
                $nom = $eleveInfo['nom'];
                $prenom = $eleveInfo['prenom'];
                $age = $eleveInfo['age'];
                $classe = $eleveInfo['classe'];
            } else {
                echo "<p>Informations sur l'élève non trouvées.</p>";
            }
        } else {
            echo "<p>Aucun élève associé trouvé pour ce parent.</p>";
        }
    } catch(PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
} else {
    // Redirection si l'utilisateur n'est pas connecté ou n'est pas un parent
    echo "<script>
            alert('Vous n\'êtes pas autorisé à accéder à cette page. Veuillez vous connecter comme parent.');
            window.location.href = 'connexion.php';
          </script>";
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Safe Place - Parents</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/parents.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

</head>
<body>
<header>
    <nav class="navbar">
        <div class="logo">
            <a href="index.php">
                <img src="../images/logo.png" alt="The Safe Place" style="height: 100px;">
            </a>
        </div>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="eleves.php">Espace eleves</a></li>
            <li><a href="parents.php">Espace Parents</a></li>
            <li><a href="ressources.html">Ressources</a></li>
            <?php if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true): ?>
                <li><a href="deconnexion.php" class="connexion-btn">Deconnexion</a></li>
            <?php else: ?>
                <li><a href="connexion.php" class="connexion-btn">Connexion</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>

    <main>
        <div id="parents-content" class="content-section">
            <div class="student-info-bubble">
                <h3>Infos de mon enfant</h3>
                <p><strong>Nom :</strong> <?php echo $nom; ?></p>
                <p><strong>Prénom :</strong> <?php echo $prenom; ?></p>
                <p><strong>Âge :</strong> <?php echo $age; ?> ans</p>
                <p><strong>Classe :</strong> <?php echo $classe; ?></p>
            </div>

        </div>
    </main>



<footer>
    <a href="mailto:thesafeplace.contacts@gmail.com">
        <i class="fas fa-envelope"></i>
        thesafeplace.contacts@gmail.com
    </a>
    <a href="https://www.instagram.com" target="_blank">
        <i class="fab fa-instagram"></i>
    </a>
    <a href="https://www.facebook.com" target="_blank">
        <i class="fab fa-facebook-f"></i>
    </a>
</footer>
    
    <script src="../js/index.js"></script>
</body>
</html>
