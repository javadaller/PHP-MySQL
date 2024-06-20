<?php
require 'auth.php';
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $sql = "DELETE FROM hiking WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    if ($stmt->execute()) {
        header('Location: read.php');
        exit;
    } else {
        echo "<p>Erreur lors de la suppression de la randonnée.</p>";
    }
} else {
    header('Location: read.php');
    exit;
}

