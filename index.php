<?php
require 'assets/php/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ajouter une nouvelle ville
    if (isset($_POST['ville']) && isset($_POST['maximale']) && isset($_POST['minimale'])) {
        $ville = $_POST['ville'];
        $haut = $_POST['maximale'];
        $bas = $_POST['minimale'];

        $sql_insert = "INSERT INTO Météo (ville, haut, bas) VALUES (:ville, :haut, :bas)";
        $stmt_insert = $pdo->prepare($sql_insert);

        $stmt_insert->execute([
            ':ville' => $ville,
            ':haut' => $haut,
            ':bas' => $bas
        ]);
    }

    // Supprimer une ville
    if (isset($_POST['delete_id'])) {
        $delete_id = $_POST['delete_id'];

        $sql_delete = "DELETE FROM Météo WHERE ville = :ville";
        $stmt_delete = $pdo->prepare($sql_delete);

        $stmt_delete->execute([':ville' => $delete_id]);

        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    }
}

$sql = "SELECT ville, haut, bas FROM Météo";
$stmt = $pdo->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP-MySQL</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f5f5f5;
        }
        h1 {
            text-align: center;
        }
        table {
            width: 50%;
            border-collapse: collapse;
            margin: 20px auto;
            background-color: #fff;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        form {
            width: 30%;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        form div {
            margin-bottom: 15px;
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        input[type="text"], input[type="number"] {
            width: calc(100% - 22px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .delete-button {
            padding: 5px 10px;
            background-color: #DC3545;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .delete-button:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <h1>Prévisions Météo</h1>
    <table>
        <tr>
            <th>Ville</th>
            <th>Température Maximale (°C)</th>
            <th>Température Minimale (°C)</th>
            <th>Action</th>
        </tr>

        <?php
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['ville']) . "</td>";
            echo "<td>" . htmlspecialchars($row['haut']) . "</td>";
            echo "<td>" . htmlspecialchars($row['bas']) . "</td>";
            echo "<td>
                    <form method='POST' action='' style='display:inline;'>
                        <input type='hidden' name='delete_id' value='" . $row['ville'] . "'>
                        <button type='submit' class='delete-button'>Supprimer</button>
                    </form>
                  </td>";
            echo "</tr>";
        }
        ?>
    </table>

    <form method="POST" action="">
        <div>
            <label for="ville">Ville:</label>
            <input type="text" name="ville" id="villeID" required>
        </div>
        <div>
            <label for="maximale">Température maximale:</label>
            <input type="number" name="maximale" id="maximaleID" required>
        </div>
        <div>
            <label for="minimale">Température minimale:</label>
            <input type="number" name="minimale" id="minimaleID" required>
        </div>
        <button type="submit">Soumettre</button>
    </form>
</body>
</html>
