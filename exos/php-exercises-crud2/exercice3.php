<?php
require 'config.php';

$message = '';


// Récupérer et nettoyer les données du formulaire
$title = htmlspecialchars($_POST['title']);
$performer = htmlspecialchars($_POST['performer']);
$date = $_POST['date']; // Pas besoin de htmlspecialchars pour une date
$showTypeId = htmlspecialchars($_POST['showTypeId']);
$firstGenreId = htmlspecialchars($_POST['firstGenreId']);
$secondGenreId = htmlspecialchars($_POST['secondGenreId']);
$duration = htmlspecialchars($_POST['duration']);
$startTime = htmlspecialchars($_POST['startTime']);

// Vérifier que les champs obligatoires ne sont pas vides
if (!empty($title) && !empty($performer) && !empty($date) && !empty($showTypeId) && !empty($firstGenreId) && !empty($duration) && !empty($startTime)) {
    try {
        // Ne pas inclure 'id' dans la liste des colonnes pour l'insertion
        $sql = "INSERT INTO shows (title, performer, date, showTypeId, firstGenreId, secondGenreId, duration, startTime) 
                VALUES (:title, :performer, :date, :showTypeId, :firstGenreId, :secondGenreId, :duration, :startTime)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':performer', $performer);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':showTypeId', $showTypeId);
        $stmt->bindParam(':firstGenreId', $firstGenreId);
        $stmt->bindParam(':secondGenreId', $secondGenreId);
        $stmt->bindParam(':duration', $duration);
        $stmt->bindParam(':startTime', $startTime);

        if ($stmt->execute()) {
            $message = "Le spectacle a été ajouté avec succès.";
        } else {
            $message = "Erreur lors de l'ajout du spectacle.";
        }
    } catch (PDOException $e) {
        $message = "Erreur : " . $e->getMessage();
    }
} else {
    $message = "Veuillez remplir tous les champs obligatoires.";
}

?>

