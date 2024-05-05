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
        if(isset($_POST['button_inscription'])) {

                include "connexion_bdd.php";
                extract($_POST);

                if(isset($email) && isset($mdp1) && $email != "" && $mdp1 != "" && isset($mdp2) && $mdp2 != "") {
                    // vérification si les mdp sont conforme
                    if($mdp2 != $mdp1) {
                        $error = "Les mots de passe doivent être identique";
                } else {
                    // si conforme vérification si l'email existe
                    $req = mysqli_query($con, "SELECT * FROM utilisateurs WHERE email = '$email'");
                    if(mysqli_num_rows($req) == 0) {
                        // si il n'existe pas on peut créer le compte
                        $req = mysqli_query($con, "INSERT INTO utilisateurs VALUES (NULL, '$email', '$mdp1')");
                        if($req) {
                            // si le compte a correctement été créer -> on affiche un message sur la page de connexion
                            $_SESSION['message'] = "<p class='message_inscription'>Votre compte a été crée avec succès.</p>";
                            // redirection vers la page de connexion
                            header("Location:index.php");
                        } else {
                            // si le compte ne s'est pas correctement créer
                            $error = "Inscription échoué :( !";
                        }
                    } else {
                        // si il existe
                        $error = "Cet email existe déjà";
                    }
                }  
                } else {
                     $error = "Veuillez remplir tous les champs !";
                }

    }
    ?>
    <main>
        <form action="" method="POST" class="form_connexion">
            <h1>Inscription</h1>
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
            <input type="password" name="mdp1" class="mdp1">
            <label>Confirmation mot de passe</label>
            <input type="password" name="mdp2" class="mdp2">
            <input type="submit" value="Inscription" name="button_inscription">
            <p class="link">
                Vous avez déjà un compte ? 
                <a href="index.php">Se connecter</a>
            </p>
        </form>
    </main>
    <script src="../script/main.js"></script>
</body>
</html>