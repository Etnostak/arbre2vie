<?php
require_once "connexion_db.php"; // Assure-toi que ce fichier définit bien $pdo
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"] ?? "");
    $mot_de_passe = $_POST["mot_de_passe"] ?? "";

    if ($email && $mot_de_passe) {
        $sql = "SELECT * FROM utilisateurs WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([":email" => $email]);
        $user = $stmt->fetch();

        if ($user && password_verify($mot_de_passe, $user["mot_de_passe"])) {
            $_SESSION["utilisateur"] = [
                "id" => $user["id"],
                "nom" => $user["nom"],
                "email" => $user["email"]
            ];
            header("Location: menu.html");
            exit;
        } else {
            echo "<h3>❌ Email ou mot de passe incorrect.</h3>";
            echo "<p><a href='connexion.html'>Réessayer</a></p>";
        }
    } else {
        echo "<h3>❌ Veuillez remplir tous les champs.</h3>";
        echo "<p><a href='connexion.html'>Retour</a></p>";
    }
}
?>
