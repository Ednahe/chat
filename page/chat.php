<?php
    session_start();
    if(!isset($_SESSION['user'])) {
        // si l'utilisateur n'est pas co on le redirige vers la page de connexion
        header('location:index.php');
    }
    $user = $_SESSION['user']
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?=$user?> Chat</title>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>
    <main class="chat">
        <div class="button-email">
            <span><?=$user?></span>
            <a href="deconnexion.php" class="deconnexion">Déconnexion</a>
        </div>
        <div class="container_message">Chargement ...</div>
        <?php 
            // envoi des messages
            if(isset($_POST['send'])) {
                $message = $_POST['message'];
                // connexion à la base de donnée
                include("connexion_bdd.php");
                // vérification si le champ n'est pas vide
                if(isset($message) && $message != "") {
                    // insérer le message dans la base de donnée
                    // Préparation de la requête
                    $stmt = $con->prepare("INSERT INTO messages (email, msg, date) VALUES (?, ?, NOW())");

                    // Liaison des paramètres
                    $stmt->bind_param("ss", $user, $message);

                    // Exécution de la requête
                    $stmt->execute();

                    header('location:chat.php');
                } else {
                    header('location:chat.php');
                }
            }
        ?>
        <form action="" method="post" class="send_message">
            <textarea name="message" cols="30" rows="2" placeholder="Votre message"></textarea>
            <input type="submit" value="Envoyer" name="send">
        </form>
    </main>
    <script src="../script/script.js"></script>
</body>
</html>