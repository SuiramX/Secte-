<?php

include 'config.php';
$servername = config::SERVEUR;
$username = config::UTILISATEUR;
$password = config::MOTDEPASSE;
$dbname = config::BASEDEDONNEES;

$conn = new PDO("mysql:host=".Config::SERVEUR.";dbname=".Config::BASEDEDONNEES
    , Config::UTILISATEUR, Config::MOTDEPASSE);


$recup = $conn->prepare("SELECT * FROM secte");
$recup->execute();
$result = $recup->fetchAll();

?>
    <!doctype html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Log-In</title>
    </head>
    <body>
    <div>
        <form action="connexion.php" method="post">
            <div>
                <label for="email">Nom</label>
                <input type="text" id="email" name="email" required>
            </div>
            <div>
                <label for="password">Prenom</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div>
                <input type="submit" value="Log-In">
            </div>
        </form>
    </div>
    </body>
    </html>
<?php
if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $recup = $conn->prepare("SELECT * FROM secte WHERE nom = :email AND prenom = :password");
    $recup->bindParam(':email', $email);
    $recup->bindParam(':password', $password);
    $recup->execute();
    $result = $recup->fetchAll();
    if (count($result) > 0) {
        session_start();
        $_SESSION['id'] = $result[0]['id'];
        header('Location: ../calendrier.html');
        exit;
    }
}