<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exos partie 2 - Exercice 1</title>
</head>
<body>
    <h1>Exos partie 2</h1>

    <h2>Exercice 1</h2>
    
    <form action="add_client.php" method="post">
        <div>
            <label for="lastname">Nom :</label>
            <input type="text" id="lastname" name="lastname" required>
        </div>
        <div>
            <label for="firstname">Prénom :</label>
            <input type="text" id="firstname" name="firstname" required>
        </div>
        <div>
            <label for="birthdate">Date de naissance :</label>
            <input type="date" id="birthdate" name="birthdate" required>
        </div>
        <div>
            <label for="loyalty_card">Carte de fidélité :</label>
            <input type="checkbox" id="loyalty_card" name="loyalty_card" value="1">
        </div>
        <div>
            <label for="card_number">Numéro de carte de fidélité :</label>
            <input type="text" id="card_number" name="card_number">
        </div>
        <button type="submit">Ajouter</button>
    </form>

    <h2>Exercice 2</h2>

    <p>cf exercice 1?</p>

    <h2>Exercice 3</h2>

    <form action="exercice3.php" method="post">
        <div>
            <label for="title">Titre :</label>
            <input type="text" id="title" name="title" required>
        </div>
        <div>
            <label for="performer">Artiste :</label>
            <input type="text" id="performer" name="performer" required>
        </div>
        <div>
            <label for="date">Date :</label>
            <input type="date" id="date" name="date" required>
        </div>
        <div>
            <label for="showTypeId">Type de spectacle :</label>
            <input type="number" id="showTypeId" name="showTypeId" required>
        </div>
        <div>
            <label for="firstGenreId">Premier genre :</label>
            <input type="number" id="firstGenreId" name="firstGenreId" required>
        </div>
        <div>
            <label for="secondGenreId">Deuxième genre :</label>
            <input type="number" id="secondGenreId" name="secondGenreId">
        </div>
        <div>
            <label for="duration">Durée :</label>
            <input type="time" id="duration" name="duration" required>
        </div>
        <div>
            <label for="startTime">Heure de début :</label>
            <input type="time" id="startTime" name="startTime" required>
        </div>
        <button type="submit">Ajouter</button>
    </form>

</body>
</html>
