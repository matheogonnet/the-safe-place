<?php
global $pdo;
session_start();
require_once '../php/db.php'; // Assurez-vous que ce chemin est correct

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $content = file_get_contents('php://input');
    $decoded = json_decode($content, true);

    $note = $decoded['score']; // La note de l'évaluation
    $eleveId = $_SESSION['id']; // Assurez-vous que l'ID de l'élève est stocké dans $_SESSION

    try {
        $stmt = $pdo->prepare("INSERT INTO notes (note, eleve_id, timestamp) VALUES (:note, :eleve_id, CURRENT_TIMESTAMP)");
        $stmt->bindParam(":note", $note, PDO::PARAM_INT);
        $stmt->bindParam(":eleve_id", $eleveId, PDO::PARAM_INT);
        $stmt->execute();

        echo json_encode(["success" => true]);
    } catch (Exception $e) {
        echo json_encode(["success" => false, "message" => "Erreur lors de l'enregistrement de la note : " . $e->getMessage()]);
    }
}
?>
