<?php
require_once "connexion_db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = trim($_POST["nom"]);
    $email = trim($_POST["email"]);
    $mot_de_passe = password_hash($_POST["mot_de_passe"], PASSWORD_DEFAULT);

    $sql = "INSERT INTO utilisateurs (nom, email, mot_de_passe) VALUES (:nom, :email, :mot_de_passe)";
    $stmt = $pdo->prepare($sql);

    try {
        $stmt->execute([
            ":nom" => $nom,
            ":email" => $email,
            ":mot_de_passe" => $mot_de_passe
        ]);
        echo "<h3>✅ Inscription réussie ! <a href='connexion.html'>Connectez-vous ici</a>.</h3>";
    } catch (PDOException $e) {
        echo "<h3>❌ Erreur : " . $e->getMessage() . "</h3>";
    }
}
?>