<?php
require_once "connexion_db.php"; // Assure-toi que ce fichier définit bien $pdo

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupération et nettoyage des données
    $nom = trim($_POST["nom"] ?? "");
    $prenom = trim($_POST["prenom"] ?? "");
    $telephone = trim($_POST["telephone"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $date_jour = $_POST["date_jour"] ?? null;
    $source = trim($_POST["source"] ?? "");
    $type_evenement = trim($_POST["type_evenement"] ?? "");
    $lieu = trim($_POST["lieu"] ?? "");
    $date_debut = $_POST["date_debut"] ?? null;
    $date_fin = $_POST["date_fin"] ?? null;
    $message = trim($_POST["message"] ?? "");

    // Préparation de la requête SQL
    $sql = "INSERT INTO reservations (
                nom, prenom, telephone, email, date_jour, source,
                type_evenement, lieu, date_debut, date_fin, message
            ) VALUES (
                :nom, :prenom, :telephone, :email, :date_jour, :source,
                :type_evenement, :lieu, :date_debut, :date_fin, :message
            )";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ":nom" => $nom,
            ":prenom" => $prenom,
            ":telephone" => $telephone,
            ":email" => $email,
            ":date_jour" => $date_jour,
            ":source" => $source,
            ":type_evenement" => $type_evenement,
            ":lieu" => $lieu,
            ":date_debut" => $date_debut,
            ":date_fin" => $date_fin,
            ":message" => $message
        ]);

        echo "<h3>✅ Réservation enregistrée avec succès !</h3>";
        echo "<p><a href='index.html'>Retour à l'accueil</a></p>";
    } catch (PDOException $e) {
        echo "<h3>❌ Erreur lors de l'enregistrement : " . $e->getMessage() . "</h3>";
    }
} else {
    echo "<h3>⚠️ Accès non autorisé.</h3>";
}
?>
