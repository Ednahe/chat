<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion | Chat</title>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>
    <?php
        if(isset($_POST['button_connexion'])) {
            // si le formulaire est envoyé = connexion à la bd
            include "connexion_bdd.php";
            // extraire les infos du form
            extract($_POST);
            // vérification si les champs sont vide
            if(isset($email) && isset($mdp1) && $email != "" && $mdp1 != "") {
            // vérification si les identifiants sont ok
            $req = mysqli_query($con, "SELECT * FROM utilisateurs WHERE email = '$email' AND password = '$mdp1' ");
            if(mysqli_num_rows($req) > 0) {
                $_SESSION['user'] = $email;
                header("location:chat.php");
                // détruire la variable du message d'inscription
                unset($_SESSION['message']);
            } else {
                $error = "Email ou mot de passe incorrect";
            }
                } else {
                    $error = "Veuillez remplir tous les champs";
                }
        }
    ?>
    <main>
        <form action="" method="POST" class="form_connexion">
            <h1>Connexion</h1>
            <?php
                if(isset($_SESSION['message'])) {
                    echo $_SESSION['message'];
                }
            ?>
            <p class="message_error">
                <?php
                if(isset($error)) {
                    echo $error;
                }
                ?>
            </p>
            <label>Adresse Mail</label>
            <input type="email" name="email">
            <label>Mot de passe</label>
            <input type="password" name="mdp1">
            <input type="submit" value="Connexion" name="button_connexion">
            <p class="link">
                Vous n'avez pas de compte ? 
                <a href="inscription.php">Créer un compte</a>
            </p>
        </form>
    </main>

</body>
</html>