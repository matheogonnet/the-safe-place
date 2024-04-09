<?php
global $pdo;
session_start();

// Assurez-vous que l'utilisateur est connecté et a une classe attribuée
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || !isset($_SESSION["classe"])) {
    header("location: connexion.php");
    exit;
}

require_once '../php/db.php'; // Chemin d'accès à votre script de connexion à la base de données

$classe = $_SESSION["classe"];

try {
    $stmt = $pdo->prepare("SELECT * FROM evaluation WHERE classe = :classe ORDER BY id ASC");
    $stmt->bindParam(":classe", $classe, PDO::PARAM_STR);
    $stmt->execute();
    $questions = $stmt->fetchAll();
} catch (Exception $e) {
    die("Erreur de connexion à la base de données: " . $e->getMessage());
}
    $correctAnswers= array_column($questions, "correct_option");
?>





<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Évaluation sur le Cyberharcèlement</title>
    <link rel="stylesheet" href="../css/evaluation.css">
</head>
<body>

<div class="timer" id="timerDisplay">10:00</div>
<form id="evaluationForm" method="post">
    <div class="evaluation-container">
        <?php foreach ($questions as $index => $question): ?>
            <div class="evaluation-question">
                <p><?php echo ($index + 1) . ". " . htmlspecialchars($question["question"]); ?></p>
                <label><input type="radio" name="q<?php echo $index + 1; ?>" value="1"> <?php echo htmlspecialchars($question["option_1"]); ?></label><br>
                <label><input type="radio" name="q<?php echo $index + 1; ?>" value="2"> <?php echo htmlspecialchars($question["option_2"]); ?></label><br>
                <label><input type="radio" name="q<?php echo $index + 1; ?>" value="3"> <?php echo htmlspecialchars($question["option_3"]); ?></label><br>
                <label><input type="radio" name="q<?php echo $index + 1; ?>" value="4"> <?php echo htmlspecialchars($question["option_4"]); ?></label>
            </div>
        <?php endforeach; ?>

    </div>
    <button type="submit">Soumettre</button>
</form>
<script src="../js/evaluation.js"></script>
<footer class="evaluation-footer"></footer>
<div id="scorePopup" class="popup-container" style="display: none;">
    <div class="popup-content">
        <span class="close-button">&times;</span>
        <p id="scoreText">Vous avez X sur Y bonnes réponses.</p>
        <button id="closePopup">OK</button>
    </div>
</div>
<script>
    const correctAnswers = <?php echo json_encode($correctAnswers); ?>;
</script>
</body>
</html>
