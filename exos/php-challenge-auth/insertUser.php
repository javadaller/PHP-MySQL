<?php
require 'config.php';

$username = 'aze';
$password = 'aze';
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO user (username, password) VALUES (:username, :password)";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':username', $username, PDO::PARAM_STR);
$stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
$stmt->execute();

echo "Utilisateur inséré avec succès.";
?>
