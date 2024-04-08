<?php
session_start(); // Démarrer la session pour accéder aux variables de session

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Safe Place</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/index.css">
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
    <section class="site-intro">
        <h1>The Safe Place</h1>
    </section>

    <div class="welcome-text">
        <p>Bienvenue sur The Safe Place, votre refuge pour apprendre à combattre le cyberharcèlement. À travers notre MOOC interactif, explorez des cours captivants, participez à des quizz stimulants et avancez à votre rythme dans un parcours éducatif conçu pour élèves et parents. Ensemble, renforçons nos connaissances et nos compétences pour créer un environnement numérique sûr et respectueux pour tous.</p>
    </div>

    <section class="news-section">
        <h2 class="news-title">Actualités sur le Cyberharcèlement</h2>
        <div class="article-grid">
            <a href="https://www.service-public.fr/particuliers/vosdroits/F32239" target="_blank" class="article">
                <img src="../images/1.png" alt="Image 1">
            </a>
            <a href="https://www.cnil.fr/fr/cyberviolences-et-cyberharcelement-que-faire" target="_blank" class="article">
                <img src="../images/2.png" alt="Image 2">
            </a>
            <a href="https://www.lunion.fr/id568263/article/2024-02-12/les-collegiens-de-charlemagne-sensibilises-au-cyberharcelement" target="_blank" class="article">
                <img src="../images/3.png" alt="Image 3">
            </a>
            <a href="https://france3-regions.francetvinfo.fr/paris-ile-de-france/seine-saint-denis/cyberharcelement-ton-nom-est-une-insulte-a-la-france-les-sportifs-de-haut-niveau-victimes-des-reseaux-sociaux-2921391.html" target="_blank" class="article">
                <img src="../images/4.png" alt="Image 4">
            </a>
        </div>
    </section>
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
