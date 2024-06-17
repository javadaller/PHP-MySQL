<?php
require 'config.php';

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!empty($username) && !empty($password)) {
        $sql = "SELECT * FROM user WHERE username = :username";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Vérifier le mot de passe
            if (password_verify($password, $user['password'])) {
                $message = "Connexion réussie!";
                session_start();
                $_SESSION['user'] = $user;
                // header("Location: dashboard.php"); // Par exemple
            } else {
                $message = "Mot de passe incorrect.";
            }
        } else {
            $message = "Utilisateur non trouvé.";
        }
    } else {
        $message = "Veuillez remplir tous les champs.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
</head>
<body>

<form action="" method="post">
    <div>
        <label for="username">Identifiant</label>
        <input type="text" name="username" required>
    </div>
    <div>
        <label for="password">Mot de passe</label>
        <input type="password" name="password" required>
    </div>
    <div>
        <button type="submit" name="submit">Se connecter</button>
    </div>
</form>
<p><?php echo htmlspecialchars($message); ?></p>

</body>
</html>
