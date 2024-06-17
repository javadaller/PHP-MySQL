<?php
require 'config.php';

//exercice 1
$sql = "SELECT lastName, firstName FROM clients";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$clients = $stmt->fetchAll(PDO::FETCH_ASSOC);


//exercice 2
$sql = "SELECT genre FROM genres";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$genres = $stmt->fetchAll(PDO::FETCH_ASSOC);

//exercice 3
$sql = "SELECT lastName, firstName FROM clients LIMIT 20";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$clients20 = $stmt->fetchAll(PDO::FETCH_ASSOC);

//exercice 4
$sql = "SELECT lastName, firstName FROM clients WHERE card = 1";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$clientsFidelity = $stmt->fetchAll(PDO::FETCH_ASSOC);

//exercice 5
$sql = "SELECT lastName, firstName FROM clients WHERE lastName LIKE 'M%' ORDER BY lastName ASC";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$clientsWithM = $stmt->fetchAll(PDO::FETCH_ASSOC);

//exercice 6
$sql = "SELECT title, performer, date, startTime FROM shows";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$shows = $stmt->fetchAll(PDO::FETCH_ASSOC);

//exercice 7
$sql = "SELECT * FROM clients";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$clientsAll = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Afficher les Clients</title>
</head>
<body>
    <h2>Exercice 1: Liste des clients</h2>
    <?php if (!empty($clients)): ?>
        <ul>
            <?php foreach ($clients as $client): ?>
                <li><?php echo htmlspecialchars($client['firstName'] . ' ' . $client['lastName']); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Aucun client trouvé.</p>
    <?php endif; ?>
    <br>

    <h2>Exercice 2: Liste types de spectacles</h2>
    <?php if (!empty($genres)): ?>
        <ul>
            <?php foreach ($genres as $genre): ?>
                <li><?php echo htmlspecialchars($genre['genre']); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Aucun type trouvé.</p>
    <?php endif; ?>
    <br>

    <h2>Exercice 3: Liste des 20 premiers clients</h2>
    <?php if (!empty($clients20)): ?>
        <ul>
            <?php foreach ($clients20 as $client): ?>
                <li><?php echo htmlspecialchars($client['firstName'] . ' ' . $client['lastName']); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Aucun client trouvé.</p>
    <?php endif; ?>
    <br>

    <h2>Exercice 4: Liste des clients avec carte de fidélité</h2>
    <?php if (!empty($clientsFidelity)): ?>
        <ul>
            <?php foreach ($clientsFidelity as $client): ?>
                <li><?php echo htmlspecialchars($client['firstName'] . ' ' . $client['lastName']); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Aucun client trouvé.</p>
    <?php endif; ?>
    <br>

    <h2>Exercice 5: Liste des clients avec la lettre 'M'</h2>
    <?php if (!empty($clientsWithM)): ?>
        <ul>
            <?php foreach ($clientsWithM as $client): ?>
                <div>
                    <p><?php echo "Nom : ".$client['lastName'];?></p>
                    <p><?php echo "Prénom : ".$client['firstName'];?></p>
                    <p>--------------------------------------</p>
                </div>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Aucun client trouvé.</p>
    <?php endif; ?>
    <br>

    <h2>Exercice 6: Liste des spectacles</h2>
    <?php if (!empty($shows)): ?>
        <ul>
            <?php foreach ($shows as $show): ?>
                <p><?php echo $show['title']." par ".$show['performer'].", le ".$show['date']." à ".$show['startTime'] ?></p>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Aucun client trouvé.</p>
    <?php endif; ?>
    <br>

    <h2>Exercice 7: Liste détaillée des clients</h2>
    <?php if (!empty($clientsAll)): ?>
        <ul>
            <?php foreach ($clientsAll as $client): ?>
                <p><?php 
                    echo "Nom : ".$client['lastName']."<br> Prénom : ".$client['firstName']."<br> Date de naissance: ".$client['birthDate']."<br>";
                    if($client['card'] == 1) {
                        echo "Carte de fidélité: Oui";
                    } else {
                        echo "Carte de fidélité: Non";
                    }
                    if($client['cardNumber'] != null) {
                        echo "<br>Numéro de carte: ".$client['cardNumber'];
                    }
                ?></p>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Aucun client trouvé.</p>
    <?php endif; ?>
    <br>

</body>
</html>
