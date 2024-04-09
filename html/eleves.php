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

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Safe Place - Élèves</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/eleves.css">
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
                <!-- Quizz 1 -->
                <div id="quiz1" class="quiz-content" style="display:block;">
                    <form id="quiz1-form">
                        <!-- Question 1 -->
                        <div class="quiz-question">
                            <p>1. Quelle est la meilleure action à prendre en cas de cyberharcèlement ?</p>
                            <label><input type="radio" name="q1" value="0"> Ignorer les messages</label><br>
                            <label><input type="radio" name="q1" value="0"> Répondre avec colère</label><br>
                            <label><input type="radio" name="q1" value="1"> En parler à un adulte de confiance</label><br>
                            <label><input type="radio" name="q1" value="0"> Supprimer son profil sur les réseaux sociaux</label>
                        </div>

                        <!-- Question 2 -->
                        <div class="quiz-question">
                            <p>2. Qui peut être averti en cas de cyberharcèlement ?</p>
                            <label><input type="radio" name="q2" value="0"> Personne, il faut le garder pour soi</label><br>
                            <label><input type="radio" name="q2" value="1"> La police ou la gendarmerie</label><br>
                            <label><input type="radio" name="q2" value="0"> Les amis seulement</label><br>
                            <label><input type="radio" name="q2" value="0"> Les inconnus en ligne pour obtenir de l'aide</label>
                        </div>

                        <!-- Question 3 -->
                        <div class="quiz-question">
                            <p>3. Quel est le premier pas à faire quand on est témoin de cyberharcèlement ?</p>
                            <label><input type="radio" name="q3" value="1"> Signaler le contenu aux plateformes concernées</label><br>
                            <label><input type="radio" name="q3" value="0"> Ignorer la situation</label><br>
                            <label><input type="radio" name="q3" value="0"> Participer au harcèlement</label><br>
                            <label><input type="radio" name="q3" value="0"> Rire et partager le contenu</label>
                        </div>

                        <!-- Question 4 -->
                        <div class="quiz-question">
                            <p>4. Quelles informations ne faut-il jamais partager en ligne ?</p>
                            <label><input type="radio" name="q4" value="0"> Ses préférences musicales</label><br>
                            <label><input type="radio" name="q4" value="1"> Son adresse personnelle</label><br>
                            <label><input type="radio" name="q4" value="0"> Ses hobbies</label><br>
                            <label><input type="radio" name="q4" value="0"> Les noms de ses animaux de compagnie</label>
                        </div>
                        <button type="button" onclick="checkQuiz(1)">Soumettre</button>
                    </form>
                    <div id="quiz1-results"></div>
                </div>


                <div id="quiz2" class="quiz-content" style="display:none;">
                    <form id="quiz2-form">
                        <!-- Question 1 -->
                        <div class="quiz-question">
                            <p>1. Comment réagir si quelqu'un vous demande des photos inappropriées en ligne ?</p>
                            <label><input type="radio" name="q5" value="1"> Refuser et en parler à un adulte</label><br>
                            <label><input type="radio" name="q5" value="0"> Envoyer les photos pour ne pas perdre un ami</label><br>
                            <label><input type="radio" name="q5" value="0"> Ignorer la demande sans en parler</label><br>
                            <label><input type="radio" name="q5" value="0"> Rire de la demande</label>
                        </div>
                        <!-- Question 2 -->
                        <div class="quiz-question">
                            <p>2. Que faire si vous voyez un ami être cyberharcelé ?</p>
                            <label><input type="radio" name="q6" value="0"> L'ignorer, c'est son problème</label><br>
                            <label><input type="radio" name="q6" value="1"> Le soutenir et l'encourager à en parler</label><br>
                            <label><input type="radio" name="q6" value="0"> Participer au harcèlement pour être populaire</label><br>
                            <label><input type="radio" name="q6" value="0"> Diffuser l'information pour sensibiliser</label>
                        </div>

                        <!-- Question 3 -->
                        <div class="quiz-question">
                            <p>3. Quelle plateforme permet de signaler anonymement le cyberharcèlement ?</p>
                            <label><input type="radio" name="q7" value="1"> 3018</label><br>
                            <label><input type="radio" name="q7" value="0"> Facebook</label><br>
                            <label><input type="radio" name="q7" value="0"> Instagram</label><br>
                            <label><input type="radio" name="q7" value="0"> Snapchat</label>
                        </div>

                        <!-- Question 4 -->
                        <div class="quiz-question">
                            <p>4. Quel est le meilleur moyen de protéger sa vie privée en ligne ?</p>
                            <label><input type="radio" name="q8" value="0"> Utiliser le même mot de passe partout</label><br>
                            <label><input type="radio" name="q8" value="1"> Activer les paramètres de confidentialité sur les réseaux sociaux</label><br>
                            <label><input type="radio" name="q8" value="0"> Publier des informations personnelles</label><br>
                            <label><input type="radio" name="q8" value="0"> Accepter toutes les demandes d'amis</label>
                        </div>

                        <button type="button" onclick="checkQuiz(2)">Soumettre</button>
                    </form>
                    <div id="quiz2-results"></div>
                </div>

                <div id="quiz3" class="quiz-content" style="display:none;">
                    <form id="quiz3-form">
                        <!-- Question 1 -->
                        <div class="quiz-question">
                            <p>1. Quel comportement adopter en ligne pour éviter le cyberharcèlement ?</p>
                            <label><input type="radio" name="q9" value="1"> Être respectueux et bienveillant</label><br>
                            <label><input type="radio" name="q9" value="0"> Partager tout ce que l'on pense</label><br>
                            <label><input type="radio" name="q9" value="0"> Se moquer des autres pour être drôle</label><br>
                            <label><input type="radio" name="q9" value="0"> Utiliser l'anonymat pour critiquer</label>
                        </div>

                        <!-- Question 2 -->
                        <div class="quiz-question">
                            <p>2. Comment réagir face à un message haineux en ligne ?</p>
                            <label><input type="radio" name="q10" value="0"> Y répondre avec colère</label><br>
                            <label><input type="radio" name="q10" value="1"> Ne pas répondre et le signaler</label><br>
                            <label><input type="radio" name="q10" value="0"> Le partager pour montrer l'absurdité</label><br>
                            <label><input type="radio" name="q10" value="0"> En rire et l'ignorer</label>
                        </div>

                        <!-- Question 3 -->
                        <div class="quiz-question">
                            <p>3. Quelle attitude est recommandée pour sécuriser ses comptes en ligne ?</p>
                            <label><input type="radio" name="q11" value="1"> Utiliser des mots de passe forts et uniques</label><br>
                            <label><input type="radio" name="q11" value="0"> Partager ses mots de passe avec des amis</label><br>
                            <label><input type="radio" name="q11" value="0"> Utiliser le même mot de passe pour faciliter la mémorisation</label><br>
                            <label><input type="radio" name="q11" value="0"> Écrire ses mots de passe sur un papier</label>
                        </div>

                        <!-- Question 4 -->
                        <div class="quiz-question">
                            <p>4. Que faire si vous recevez un lien suspect d'un ami ?</p>
                            <label><input type="radio" name="q12" value="0"> Cliquer pour voir ce que c'est</label><br>
                            <label><input type="radio" name="q12" value="1"> Ne pas cliquer et prévenir votre ami</label><br>
                            <label><input type="radio" name="q12" value="0"> Partager le lien avec d'autres amis</label><br>
                            <label><input type="radio" name="q12" value="0"> Ignorer le message</label>
                        </div>
                        <button type="button" onclick="checkQuiz(3)">Soumettre</button>
                    </form>
                    <div id="quiz3-results"></div>
                </div>

                <div id="quiz4" class="quiz-content" style="display:none;">
                    <form id="quiz4-form">
                        <!-- Question 1 -->
                        <div class="quiz-question">
                            <p>1. Pourquoi est-il important de vérifier les sources d'une information avant de la partager ?</p>
                            <label><input type="radio" name="q13" value="1"> Pour éviter de propager des fausses nouvelles</label><br>
                            <label><input type="radio" name="q13" value="0"> Parce que c'est plus amusant de partager rapidement</label><br>
                            <label><input type="radio" name="q13" value="0"> Pour augmenter le nombre de ses abonnés</label><br>
                            <label><input type="radio" name="q13" value="0"> Aucune raison, partager est toujours bon</label>
                        </div>

                        <!-- Question 2 -->
                        <div class="quiz-question">
                            <p>2. Quel est l'impact du cyberharcèlement sur les victimes ?</p>
                            <label><input type="radio" name="q14" value="1"> Des conséquences psychologiques graves</label><br>
                            <label><input type="radio" name="q14" value="0"> Aucun impact, c'est juste en ligne</label><br>
                            <label><input type="radio" name="q14" value="0"> Les victimes deviennent plus populaires</label><br>
                            <label><input type="radio" name="q14" value="0"> Cela les rend plus forts</label>
                        </div>

                        <!-- Question 3 -->
                        <div class="quiz-question">
                            <p>3. Comment peut-on contribuer à créer un environnement en ligne plus sûr ?</p>
                            <label><input type="radio" name="q15" value="0"> En partageant tout ce que l'on voit</label><br>
                            <label><input type="radio" name="q15" value="1"> En étant respectueux et en signalant les abus</label><br>
                            <label><input type="radio" name="q15" value="0"> En participant aux moqueries pour s'intégrer</label><br>
                            <label><input type="radio" name="q15" value="0"> En ne faisant rien, les autres s'en chargeront</label>
                        </div>

                        <!-- Question 4 -->
                        <div class="quiz-question">
                            <p>4. Quelle mesure est essentielle pour protéger son identité en ligne ?</p>
                            <label><input type="radio" name="q16" value="0"> Partager régulièrement ses données personnelles</label><br>
                            <label><input type="radio" name="q16" value="1"> Faire attention aux informations partagées sur les réseaux sociaux</label><br>
                            <label><input type="radio" name="q16" value="0"> Utiliser toujours le même pseudonyme</label><br>
                            <label><input type="radio" name="q16" value="0"> Accepter toutes les demandes d'amis pour être populaire</label>
                        </div>
                        <button type="button" onclick="checkQuiz(4)">Soumettre</button>
                    </form>
                    <div id="quiz4-results"></div>
                </div>
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
