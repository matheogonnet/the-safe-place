<?php
global $pdo;
session_start(); // Démarrer la session pour accéder aux variables de session

require_once "../php/db.php"; // Inclure le fichier de connexion à la base de données

// Initialisation des variables pour stocker les informations de l'élève
$nom = $prenom = $age = $classe = '';

// Initialiser un tableau pour stocker les notes de l'élève
$notes = [];

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

            // Récupérer les notes de l'élève en fonction de son identifiant
            $stmt = $pdo->prepare("SELECT note, try, timestamp FROM notes WHERE eleve_id = ?");
            $stmt->execute([$eleveId]);
            $notes = $stmt->fetchAll();
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

        <div class="student-notes-bubble">
            <h3>Les notes de mon enfant</h3>
            <ul>
                <?php
                // Vérifier si des notes ont été récupérées
                if (!empty($notes)) {
                    foreach ($notes as $note) {
                        echo "<li>";
                        echo htmlspecialchars($note['note']) . "/10 : Evaluation finale";
                        echo "<span>Essai numéro : " . htmlspecialchars($note['try']) . "</span>";
                        $date = new DateTime($note['timestamp']);
                        echo "<span class='date-time'>Date/Heure : " . $date->format('d/m/Y H:i') . "</span>";
                        echo "</li>";
                    }
                } else {
                    echo "<p>Aucune note disponible.</p>";
                }
                ?>
            </ul>
        </div>

        <div class="cyber-harassment-tips-bubble">
            <h3>Comment detecter les signes de cyberharcelement chez mon enfant</h3>
            <ul>
                <li>Changement soudain dans l'utilisation des appareils électroniques</li>
                <li>Retrait ou évitement des activités sociales précédemment appréciées</li>
                <li>Changements d'humeur, d'attitude ou de comportement</li>
                <li>Difficultés à dormir ou cauchemars fréquents</li>
                <li>Baisse des performances scolaires ou refus d'aller à l'école</li>
                <li>Secret ou nervosité autour de leur vie en ligne</li>
                <li>Expressions de désespoir ou de dépression, paroles sur l'isolement</li>
                <li>Signes de violence auto-infligée ou de mention de suicide</li>
                <li>Problèmes inexpliqués avec des amis et des camarades de classe</li>
                <li>Questions ou commentaires sur le changement d'identité ou de profil en ligne</li>
            </ul>
        </div>
        <div class="communication-tips-bubble">
            <h3>Communication efficace avec votre enfant sur le cyberharcelement</h3>
            <ul>
                <li>Créez un environnement où votre enfant se sent en sécurité pour parler.</li>
                <li>Montrez de l'empathie et de l'écoute active sans jugement.</li>
                <li>Informez-vous sur les plateformes en ligne que votre enfant utilise.</li>
                <li>Établissez des règles de base pour l'utilisation d'internet à la maison.</li>
                <li>Encouragez votre enfant à vous parler s'ils sont témoins ou victimes de harcèlement.</li>
                <li>Discutez des stratégies pour gérer et bloquer les harceleurs en ligne.</li>
                <li>Réassurez votre enfant sur le fait que vous êtes là pour l'aider et le soutenir.</li>
                <li>Encouragez les activités hors ligne pour développer d'autres centres d'intérêt.</li>
                <li>Considérez l'aide d'un professionnel si votre enfant montre des signes de détresse.</li>
                <li>Restez informé sur les lois et les ressources disponibles pour lutter contre le cyberharcèlement.</li>
            </ul>
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
