<?php
global $pdo;
session_start(); // Démarrer la session pour accéder aux variables de session

// Vérifier si l'utilisateur est connecté, sinon rediriger vers la page de connexion
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["profile"] !== "parent") {
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
            <section id="profil-enfant" class="parent-section">
                <h2>Profil de l'Enfant</h2>
                <!-- Informations sur le profil de l'enfant -->
            </section>
            <section id="notes-quizz-evaluations" class="parent-section">
                <h2>Notes aux Quizz et Évaluations</h2>
                <!-- Détails des notes des quizz et évaluations -->
            </section>
            <section id="ressources-parents" class="parent-section">
                <h2>Ressources</h2>
                <!-- Ressources disponibles pour les parents -->
            </section>
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