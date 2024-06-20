<?php
require 'auth.php';
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = htmlspecialchars($_POST['name']);
    $difficulty = htmlspecialchars($_POST['difficulty']);
    $distance = htmlspecialchars($_POST['distance']);
    $duration = htmlspecialchars($_POST['duration']);
    $height_difference = htmlspecialchars($_POST['height_difference']);
    $available = isset($_POST['available']) ? 1 : 0;

    $sql = "UPDATE hiking SET name = :name, difficulty = :difficulty, distance = :distance, duration = :duration, height_difference = :height_difference, available = :available WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
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
        echo "<p>Erreur lors de la mise à jour de la randonnée.</p>";
    }
} else {
    $id = $_GET['id'];
    $sql = "SELECT * FROM hiking WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $hike = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Modifier une randonnée</title>
    <link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
</head>
<body>
    <a href="read.php">Liste des données</a>
    <h1>Modifier</h1>
    <form action="" method="post">
        <input type="hidden" name="id" value="<?php echo $hike['id']; ?>">
        <div>
            <label for="name">Name</label>
            <input type="text" name="name" value="<?php echo htmlspecialchars($hike['name']); ?>">
        </div>
        <div>
            <label for="difficulty">Difficulté</label>
            <select name="difficulty">
                <option value="très facile" <?php if ($hike['difficulty'] == 'très facile') echo 'selected'; ?>>Très facile</option>
                <option value="facile" <?php if ($hike['difficulty'] == 'facile') echo 'selected'; ?>>Facile</option>
                <option value="moyen" <?php if ($hike['difficulty'] == 'moyen') echo 'selected'; ?>>Moyen</option>
                <option value="difficile" <?php if ($hike['difficulty'] == 'difficile') echo 'selected'; ?>>Difficile</option>
                <option value="très difficile" <?php if ($hike['difficulty'] == 'très difficile') echo 'selected'; ?>>Très difficile</option>
            </select>
        </div>
        <div>
            <label for="distance">Distance (km)</label>
            <input type="text" name="distance" value="<?php echo htmlspecialchars($hike['distance']); ?>">
        </div>
        <div>
            <label for="duration">Durée</label>
            <input type="time" name="duration" value="<?php echo htmlspecialchars($hike['duration']); ?>">
        </div>
        <div>
            <label for="height_difference">Dénivelé (m)</label>
            <input type="text" name="height_difference" value="<?php echo htmlspecialchars($hike['height_difference']); ?>">
        </div>
        <div>
            <label for="available">Disponible</label>
            <input type="checkbox" name="available" value="1" <?php if ($hike['available'] == 1) echo 'checked'; ?>>
        </div>
        <button type="submit">Modifier</button>
    </form>

    <a id="logout" href="logout.php">Logout</a>
</body>
</html>
