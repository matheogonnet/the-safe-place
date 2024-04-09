<?php
global $pdo;
session_start();
require_once '../php/db.php'; // Assurez-vous que ce chemin est correct

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $content = file_get_contents('php://input');
    $decoded = json_decode($content, true);

    $note = $decoded['score'];
    $eleveId = $_SESSION['id']; // Assurez-vous que l'ID de l'élève est stocké dans $_SESSION

    try {
        // Compter le nombre de notes existantes pour cet élève
        $countStmt = $pdo->prepare("SELECT COUNT(*) FROM notes WHERE eleve_id = :eleve_id");
        $countStmt->bindParam(":eleve_id", $eleveId, PDO::PARAM_INT);
        $countStmt->execute();
        $notesCount = $countStmt->fetchColumn();

        // Déterminer la valeur de 'try'
        $tryValue = $notesCount + 1;

        // Insérer la nouvelle note avec 'try'
        $stmt = $pdo->prepare("INSERT INTO notes (note, eleve_id, timestamp,try) VALUES (:note, :eleve_id, CURRENT_TIMESTAMP, :try)");
        $stmt->bindParam(":note", $note, PDO::PARAM_INT);
        $stmt->bindParam(":eleve_id", $eleveId, PDO::PARAM_INT);
        $stmt->bindParam(":try", $tryValue, PDO::PARAM_INT);
        $stmt->execute();

        echo json_encode(["success" => true]);
    } catch (Exception $e) {
        echo json_encode(["success" => false, "message" => "Erreur lors de l'enregistrement de la note : " . $e->getMessage()]);
    }
}
?>
