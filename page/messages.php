<?php
    session_start();
// si l'utilisateur s'est connecté
    if(isset($_SESSION['user'])) {
        // connexion à la bdd
        include "connexion_bdd.php";
        // requete pour afficher les messages
        $req = mysqli_query($con, "SELECT * FROM messages ORDER BY id DESC");
        if(mysqli_num_rows($req) == 0) {
            // s'il n'y a pas encore de message
            echo "messagerie vide";
        } else {
            while($row = mysqli_fetch_assoc($req)) {
                // si c'est vous qui avez envoyé le message
                if($row['email'] == $_SESSION['user']) {
                    ?>                       
                        <div class="message your_message">
                            <span>Vous</span>
                            <p><?=$row['msg']?></p>
                            <p class="date"><?=$row['date']?></p>
                        </div>
                      
                    <?php
                } else {
                    ?>
                        <div class="message others_message">
                            <span><?=$row['email']?></span>
                            <p><?=$row['msg']?></p>
                            <p class="date"><?=$row['date']?></p>
                        </div>
                    <?php
                }
            }
        }
    }
?>
