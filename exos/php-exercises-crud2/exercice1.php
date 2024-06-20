<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer et nettoyer les données du formulaire
    $lastname = htmlspecialchars($_POST['lastname']);
    $firstname = htmlspecialchars($_POST['firstname']);
    $birthdate = $_POST['birthdate'];
    $loyalty_card = isset($_POST['loyalty_card']) ? 1 : 0;
    $card_number = isset($_POST['card_number']) ? htmlspecialchars($_POST['card_number']) : null;

    try {
        // Préparer la requête d'insertion
        $sql = "INSERT INTO clients (lastName, firstName, birthDate, card, cardNumber) 
                VALUES (:lastname, :firstname, :birthdate, :loyalty_card, :card_number)";
        
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':lastname', $lastname);
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':birthdate', $birthdate);
        $stmt->bindParam(':loyalty_card', $loyalty_card, PDO::PARAM_INT);
        $stmt->bindParam(':card_number', $card_number);

        // Exécuter la requête
        if ($stmt->execute()) {
            echo "<p>Client ajouté avec succès.</p>";
            header('Location: index.php');
        } else {
            echo "<p>Erreur lors de l'ajout du client.</p>";
        }
    } catch (PDOException $e) {
        echo "<p>Erreur : " . $e->getMessage() . "</p>";
    }
}
?>
