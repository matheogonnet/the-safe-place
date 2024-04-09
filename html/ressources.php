<?php
session_start(); // Démarrer la session pour accéder aux variables de session

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Safe Place - Ressources</title>
    <link rel="stylesheet" href="../css/ressources.css">
    <link rel="stylesheet" href="../css/styles.css">
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
            <li><a href="ressources.php">Ressources</a></li>
            <?php if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true): ?>
                <li><a href="deconnexion.php" class="connexion-btn">Deconnexion</a></li>
            <?php else: ?>
                <li><a href="connexion.php" class="connexion-btn">Connexion</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>

<main>
    <div id="resources-content">
        <h1 class="resources-title">Ressources sur le Cyberharcelement</h1>
        <div class="emergency-callout">
            <a href="tel:3018" class="emergency-number">3018</a>
            <p class="callout-text">Numéro d'urgence national contre le cyberharcèlement</p>
        </div>

        <div class="search-container">
            <input type="text" id="search-input" placeholder="Rechercher une ressource..." onkeyup="filterResources()">
        </div>

        <p class="intro-text">Si vous ou quelqu'un que vous connaissez êtes victime de cyberharcèlement, voici des ressources qui peuvent vous aider :</p>
        <ul class="resources-list">
            <li><strong>Numéro d'urgence national</strong>: 3018 - Ligne d'aide pour les enfants et adolescents confrontés au cyberharcèlement.</li>
            <li><strong>Net Écoute</strong>: <a href="https://www.netecoute.fr/" target="_blank">www.netecoute.fr</a> - Conseils et assistance pour les jeunes confrontés aux risques sur Internet.</li>
            <li><strong>e-Enfance</strong>: <a href="https://www.e-enfance.org/" target="_blank">www.e-enfance.org</a> - Association dédiée à la protection des mineurs sur Internet.</li>
            <li><strong>Pharos</strong>: <a href="https://www.internet-signalement.gouv.fr/" target="_blank">Signalement des contenus illicites</a> - Plateforme de signalement des contenus et comportements illicites sur Internet.</li>
            <li><strong>Stop Harcèlement</strong>: <a href="https://www.nonauharcelement.education.gouv.fr/" target="_blank">www.nonauharcelement.education.gouv.fr</a> - Informations et ressources pour lutter contre le harcèlement en milieu scolaire.</li>
            <li><strong>Jeunes Violences Écoute</strong>: <a href="https://www.jeunesviolencesecoute.fr/" target="_blank">www.jeunesviolencesecoute.fr</a> - Soutien et aide en cas de violence, y compris le cyberharcèlement.</li>
            <li><strong>Info Familles Cyberharcèlement</strong>: <a href="https://www.infofamilles.netecoute.fr/" target="_blank">www.infofamilles.netecoute.fr</a> - Ressources et conseils pour les familles concernant le cyberharcèlement.</li>
            <li><strong>Cybermalveillance.gouv.fr</strong>: <a href="https://www.cybermalveillance.gouv.fr/" target="_blank">www.cybermalveillance.gouv.fr</a> - Aide et conseils en cas de cybermenaces ou de cyberharcèlement.</li>
            <li><strong>Respect Zone</strong>: <a href="https://www.respectzone.org/" target="_blank">www.respectzone.org</a> - Initiative pour promouvoir le respect en ligne et lutter contre le cyberharcèlement.</li>
            <li><strong>Safer Internet Centre France</strong>: <a href="https://www.saferinternet.fr/" target="_blank">www.saferinternet.fr</a> - Ressources pour un internet plus sûr pour les enfants et les jeunes.</li>
            <li><strong>Aide aux Victimes de Cyberharcèlement</strong>: <a href="https://aide-aux-victimes.cybermalveillance.gouv.fr/" target="_blank">aide-aux-victimes.cybermalveillance.gouv.fr</a> - Plateforme gouvernementale offrant de l'aide et des ressources aux victimes de cyberharcèlement.</li>
            <li><strong>Association Marion La Main Tendue</strong>: <a href="https://www.marionlamaintendue.com/" target="_blank">www.marionlamaintendue.com</a> - Association luttant contre le harcèlement scolaire et le cyberharcèlement, en mémoire de Marion, une jeune fille victime de harcèlement.</li>
            <li><strong>Internet Sans Crainte</strong>: <a href="https://www.internetsanscrainte.fr/" target="_blank">www.internetsanscrainte.fr</a> - Programme national pour l’éducation au numérique responsable, proposant des conseils, des outils et des ressources pour naviguer sur internet en sécurité.</li>
            <li><strong>La Ligue Contre le Cyberharcèlement</strong>: <a href="https://www.contrelecyberharcelement.com/" target="_blank">www.contrelecyberharcelement.com</a> - Organisation proposant soutien et ressources pour les victimes de cyberharcèlement.</li>
            <li><strong>Childnet International</strong>: <a href="https://www.childnet.com/" target="_blank">www.childnet.com</a> - Organisation travaillant à rendre internet un endroit sûr pour les enfants, proposant des ressources pour les jeunes, les parents et les écoles.</li>
            <li><strong>Think U Know</strong>: <a href="https://www.thinkuknow.co.uk/" target="_blank">www.thinkuknow.co.uk</a> - Site d'éducation à la sécurité en ligne offrant des conseils pour les enfants de tous âges, leurs parents et les professionnels de l'éducation.</li>
            <li><strong>ConnectSafely</strong>: <a href="https://www.connectsafely.org/" target="_blank">www.connectsafely.org</a> - Ressources pour les parents, les ados et les éducateurs sur la façon de rester en sécurité en ligne.</li>

        </ul>

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

<script src="../js/ressources.js"></script>
</body>
</html>
