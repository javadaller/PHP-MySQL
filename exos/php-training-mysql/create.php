<?php
require 'auth.php';
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $difficulty = htmlspecialchars($_POST['difficulty']);
    $distance = htmlspecialchars($_POST['distance']);
    $duration = htmlspecialchars($_POST['duration']);
    $height_difference = htmlspecialchars($_POST['height_difference']);
    $available = isset($_POST['available']) ? 1 : 0;

    $errors = [];

    if (empty($name)) {
        $errors[] = "Le champ 'Nom' est requis.";
    }

    if (empty($difficulty)) {
        $errors[] = "Le champ 'Difficulté' est requis.";
    }

    if (empty($distance) || !is_numeric($distance)) {
        $errors[] = "Le champ 'Distance' doit être un nombre.";
    }

    if (empty($duration) || !preg_match('/^\d{2}:\d{2}$/', $duration)) {
        $errors[] = "Le champ 'Durée' doit être au format HH:MM.";
    }

    if (empty($height_difference) || !is_numeric($height_difference)) {
        $errors[] = "Le champ 'Dénivelé' doit être un nombre.";
    }

    if (empty($errors)) {
        try {
            $sql = "INSERT INTO hiking (name, difficulty, distance, duration, height_difference, available) VALUES (:name, :difficulty, :distance, :duration, :height_difference, :available)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':difficulty', $difficulty);
            $stmt->bindParam(':distance', $distance);
            $stmt->bindParam(':duration', $duration);
            $stmt->bindParam(':height_difference', $height_difference);
            $stmt->bindParam(':available', $available);

            if ($stmt->execute()) {
                header('Location: read.php');
                exit;
            } else {
                echo "<p>Erreur lors de l'ajout de la randonnée.</p>";
            }
        } catch (Exception $e) {
            echo "<p>Erreur : " . $e->getMessage() . "</p>";
        }
    } else {
        // Afficher les erreurs
        foreach ($errors as $error) {
            echo "<p style='color: red;'>$error</p>";
        }
    }
}
?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Ajouter une randonnée</title>
    <link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
</head>
<body>
    <a href="read.php">Liste des données</a>
    <h1>Ajouter</h1>
    <form action="" method="post">
        <div>
            <label for="name">Name</label>
            <input type="text" name="name" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
        </div>
        <div>
            <label for="difficulty">Difficulté</label>
            <select name="difficulty">
                <option value="très facile" <?php if (isset($_POST['difficulty']) && $_POST['difficulty'] === 'très facile') echo 'selected'; ?>>Très facile</option>
                <option value="facile" <?php if (isset($_POST['difficulty']) && $_POST['difficulty'] === 'facile') echo 'selected'; ?>>Facile</option>
                <option value="moyen" <?php if (isset($_POST['difficulty']) && $_POST['difficulty'] === 'moyen') echo 'selected'; ?>>Moyen</option>
                <option value="difficile" <?php if (isset($_POST['difficulty']) && $_POST['difficulty'] === 'difficile') echo 'selected'; ?>>Difficile</option>
                <option value="très difficile" <?php if (isset($_POST['difficulty']) && $_POST['difficulty'] === 'très difficile') echo 'selected'; ?>>Très difficile</option>
            </select>
        </div>
        <div>
            <label for="distance">Distance (km)</label>
            <input type="text" name="distance" value="<?php echo isset($_POST['distance']) ? htmlspecialchars($_POST['distance']) : ''; ?>">
        </div>
        <div>
            <label for="duration">Durée</label>
            <input type="time" name="duration" value="<?php echo isset($_POST['duration']) ? htmlspecialchars($_POST['duration']) : ''; ?>">
        </div>
        <div>
            <label for="height_difference">Dénivelé (m)</label>
            <input type="text" name="height_difference" value="<?php echo isset($_POST['height_difference']) ? htmlspecialchars($_POST['height_difference']) : ''; ?>">
        </div>
        <div>
            <label for="available">Disponible</label>
            <input type="checkbox" name="available" value="1" <?php echo isset($_POST['available']) && $_POST['available'] ? 'checked' : ''; ?>>
        </div>
        <button type="submit" name="button">Envoyer</button>
    </form>

    <a id="logout" href="logout.php">Logout</a>
</body>
</html>
