<?php
$host = 'localhost'; // Hôte de la base de données
$dbname = 'thesafeplace'; // Nom de la base de données
$user = 'root'; // Utilisateur de la base de données
$password = ''; // Mot de passe de l'utilisateur de la base de données (ajustez selon votre configuration)

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    // Définit le mode d'erreur de PDO à exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
    exit;
}
?>
