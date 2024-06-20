<?php
require 'config.php';

$sql = "SELECT * FROM hiking";
$stmt = $pdo->query($sql);
$hikes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/basics.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Randonnées</title>
</head>
<body>
    <div class="container">
        <h1>Liste des randonnées</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Difficulty</th>
                    <th>Distance (km)</th>
                    <th>Duration</th>
                    <th>Height Difference (m)</th>
                    <th>Available</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($hikes): ?>
                    <?php foreach ($hikes as $hike): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($hike['name']); ?></td>
                            <td><?php echo htmlspecialchars($hike['difficulty']); ?></td>
                            <td><?php echo htmlspecialchars($hike['distance']); ?></td>
                            <td><?php echo htmlspecialchars($hike['duration']); ?></td>
                            <td><?php echo htmlspecialchars($hike['height_difference']); ?></td>
                            <td><?php echo htmlspecialchars($hike['available'] == 1 ? 'Oui' : 'Non'); ?></td>
                            <td>
                                <a href="update.php?id=<?php echo $hike['id']; ?>" class="btn btn-warning btn-sm">Modifier</a>
                                <form action="delete.php" method="post" style="display:inline;">
                                    <input type="hidden" name="id" value="<?php echo $hike['id']; ?>">
                                    <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">No hikes found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <input type="button" class="btn btn-primary" value="Ajouter" onclick="location.href='create.php';">
    </div>

    <a id="logout" href="logout.php">Logout</a>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>
