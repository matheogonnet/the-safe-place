<?php
global $pdo;
session_start(); // Démarrer la session pour accéder aux variables de session

// Vérifier si l'utilisateur est connecté, sinon rediriger vers la page de connexion
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["profile"] !== "eleve") {
    echo "<script>
            alert('Vous n\'êtes pas autorisé à accéder à cette page. Veuillez vous connecter comme élève.');
            window.location.href = 'connexion.php';
          </script>";
    exit;
}

require_once "../php/db.php"; // Inclure le fichier de connexion à la base de données

// Récupérer les informations de l'élève depuis la session
$nom = isset($_SESSION["nom"]) ? htmlspecialchars($_SESSION["nom"]) : 'Non spécifié';
$prenom = isset($_SESSION["prenom"]) ? htmlspecialchars($_SESSION["prenom"]) : 'Non spécifié';
$age = isset($_SESSION["age"]) ? htmlspecialchars($_SESSION["age"]) : 'Non spécifié';
$classe = isset($_SESSION["classe"]) ? htmlspecialchars($_SESSION["classe"]) : 'Non spécifié';
// Récupérer l'ID de l'élève
$eleveId = $_SESSION['id'];
$notes =[];

// Préparation de la requête pour obtenir les notes de l'élève
try {
    $stmt = $pdo->prepare("SELECT note, try, timestamp FROM notes WHERE eleve_id = :eleve_id ORDER BY timestamp DESC");
    $stmt->bindParam(':eleve_id', $eleveId, PDO::PARAM_INT);
    $stmt->execute();
    $notes = $stmt->fetchAll();
} catch (Exception $e) {
    // Gérer l'erreur ici, par exemple en affichant un message d'erreur
    $errorMsg = "Erreur lors de la récupération des notes : " . $e->getMessage();
}


// Préparation de la requête pour obtenir les vidéos correspondant à la classe de l'élève
$videos = [];
$stmt = $pdo->prepare("SELECT name FROM videos WHERE classe = :classe OR classe = 'ALL'");
$stmt->bindParam(':classe', $classe, PDO::PARAM_STR);
if ($stmt->execute()) {
    // Récupération des noms des vidéos
    $videos = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
}

// Récupérer les quizz de la classe de l'élève
$quizzData = [];
$correctOptions = [];

try {
    $stmt = $pdo->prepare("SELECT * FROM quizz WHERE classe = :classe");
    $stmt->bindParam(':classe', $classe, PDO::PARAM_STR);
    $stmt->execute();
    $quizzData = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Préparer les bonnes réponses pour le JavaScript
    foreach ($quizzData as $quiz) {
        $correctOptions['q' . $quiz['id']] = $quiz['correct_option'];
    }
} catch (Exception $e) {
    $errorMsg = "Erreur lors de la récupération des quizz : " . $e->getMessage();
    // Gérer l'erreur ici, par exemple, en affichant un message d'erreur
}

// Envoyer les bonnes réponses au JavaScript
echo "<script>var correctOptions = " . json_encode($correctOptions) . ";</script>";


?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Safe Place</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/eleves.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="icon" href="../images/favicon.ico" type="image/x-icon">

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

<div class="sub-navbar">
    <a href="#mes-videos">Vidéos</a>
    <a href="#mes-quizz">Quizz</a>
    <a href="#evaluations">Évaluation</a>
    <a href="#mes-notes">Notes</a>
</div>

<main>
    <div class="student-info-bubble">
        <h3>Mes Infos</h3>
        <p><strong>Nom :</strong> <?php echo $nom; ?></p>
        <p><strong>Prénom :</strong> <?php echo $prenom; ?></p>
        <p><strong>Âge :</strong> <?php echo $age; ?> ans</p>
        <p><strong>Classe :</strong> <?php echo $classe; ?></p>
        <div class="student-profile-pic">
            <img src="../images/PP.jpg" alt="Photo de Profil">
        </div>
    </div>


    <div id="eleves-content" class="content-section">
        <section id="mes-videos" class="eleve-section">
            <h2>Mes cours vidéos</h2>
            <?php foreach ($videos as $videoName): ?>
                <div class="video-container">
                    <video controls>
                        <source src="../videos/<?php echo htmlspecialchars($videoName); ?>" type="video/mp4">
                        Votre navigateur ne supporte pas la balise vidéo.
                    </video>
                </div>
            <?php endforeach; ?>
            <?php if (empty($videos)): ?>
                <p>Aucune vidéo disponible pour votre classe.</p>
            <?php endif; ?>
        </section>

        <section id="mes-quizz" class="eleve-section">
            <h2>Mes Quizz</h2>
            <div id="quiz-selection">
                <!-- Boutons pour sélectionner le quizz -->
                <button onclick="showQuiz(1)">Quizz 1</button>
                <button onclick="showQuiz(2)">Quizz 2</button>
                <button onclick="showQuiz(3)">Quizz 3</button>
                <button onclick="showQuiz(4)">Quizz 4</button>
            </div>

            <div id="quizzes-container">
                <!-- Boucle sur chaque quizz unique et ses questions -->
                <?php
                $quizzesByNumber = [];
                foreach ($quizzData as $quiz) {
                    $quizzesByNumber[$quiz['numero']][] = $quiz;
                }

                foreach ($quizzesByNumber as $quizNumber => $questions): ?>
                    <div class="quiz-content" id="quiz<?= $quizNumber; ?>" style="<?= $quizNumber == 1 ? "display:block;" : "display:none;"; ?>">
                        <form id="quiz<?= $quizNumber; ?>-form">
                            <?php foreach ($questions as $question): ?>
                                <div class="quiz-question">
                                    <p><?= htmlspecialchars($question['question']); ?></p>
                                    <label><input type="radio" name="q<?= $question['id']; ?>" value="1"><?= htmlspecialchars($question['option_1']); ?></label><br>
                                    <label><input type="radio" name="q<?= $question['id']; ?>" value="2"><?= htmlspecialchars($question['option_2']); ?></label><br>
                                    <label><input type="radio" name="q<?= $question['id']; ?>" value="3"><?= htmlspecialchars($question['option_3']); ?></label><br>
                                    <label><input type="radio" name="q<?= $question['id']; ?>" value="4"><?= htmlspecialchars($question['option_4']); ?></label>
                                </div>
                            <?php endforeach; ?>
                            <button type="button" onclick="checkQuiz(<?= $quizNumber; ?>)">Soumettre</button>
                        </form>
                        <div id="quiz<?= $quizNumber; ?>-results"></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>




        <section id="evaluations" class="eleve-section">
            <h2>Évaluation finale</h2>
            <p>Vous pouvez commencer votre evaluation en cliquant sur le bouton ci-dessous.</p>
            <button id="openEvaluationForm" type="button">> Commencer</button>
        </section>

        <section id="mes-notes" class="eleve-section">
            <h2>Mes Notes</h2>
            <ul>
                <?php foreach ($notes as $note): ?>
                    <li>
                        <?php
                        echo htmlspecialchars($note['note']) . "/10 : Evaluation finale";
                        echo "<span>Essai numero : " . htmlspecialchars($note['try']) . "</span>";
                        $date = new DateTime($note['timestamp']);
                        echo "<span class='date-time'>Date/Heure : " . $date->format('d/m/Y H:i') . "</span>";
                        ?>
                    </li>
                <?php endforeach; ?>
            </ul>
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

<script src="../js/eleves.js"></script>
</body>
</html>
