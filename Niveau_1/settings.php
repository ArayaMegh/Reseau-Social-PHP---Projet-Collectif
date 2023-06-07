<?php
session_start();
// Vérifie si l'utilisateur n'est pas connecté (par exemple, en vérifiant la présence d'une variable de session)
if (!isset($_SESSION['connected_id'])) {
    header("Location: login.php"); // Redirige vers la page de connexion
    exit(); // Arrête l'exécution du reste du code
}

?>

<?php include("header.php"); ?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>MySafePLace - Paramètres</title>
    <meta name="author" content="Julien Falconnet">
    <link rel="stylesheet" href="style.css" />
</head>

<body>



    <div id="wrapper" class='profile'>


        <aside>
            <img src="user.jpg" alt="Portrait de l'utilisatrice"/>
            <section>
                <h3>Mes paramètres</h3>
                <p>Sur cette page vous trouverez toutes vos informations personnelles - que nous ne vendons pas au plus offrant comme Facebook.</p>
                <br>
                <form action="settings.php?user_id=<?php echo $_SESSION['connected_id']; ?>" method="post">
                <input class="button_settings"class="button_settings" type="submit" name = 'followers' value="Mes followers">
                </form>
                <form action="settings.php?user_id=<?php echo $_SESSION['connected_id']; ?>" method="post">
                <input class="button_settings" type="submit" name = 'subscribe' value="Mes abonnements">
                </form>
                <form action="login.php?user_id=<?php echo $_SESSION['connected_id']; ?>" method="post">
                <input class="button_settings" type="submit" name = 'disconnect' value="Me déconnecter">
                </form>

            </section>
        </aside>
        <main>
            <?php
            /**
             * Etape 1: Les paramètres concernent une utilisatrice en particulier
             * La première étape est donc de trouver quel est l'id de l'utilisatrice
             * Celui ci est indiqué en parametre GET de la page sous la forme user_id=...
             * Documentation : https://www.php.net/manual/fr/reserved.variables.get.php
             * ... mais en résumé c'est une manière de passer des informations à la page en ajoutant des choses dans l'url
             */
            $userId = intval($_SESSION['connected_id']);

            /**
             * Etape 2: se connecter à la base de donnée
             */
            include("BDconnection.php");

            /**
             * Etape 3: récupérer le nom de l'utilisateur
             */
            $laQuestionEnSql = "
                    SELECT users.*, 
                    count(DISTINCT posts.id) as totalpost, 
                    count(DISTINCT given.post_id) as totalgiven, 
                    count(DISTINCT recieved.user_id) as totalrecieved 
                    FROM users 
                    LEFT JOIN posts ON posts.user_id=users.id 
                    LEFT JOIN likes as given ON given.user_id=users.id 
                    LEFT JOIN likes as recieved ON recieved.post_id=posts.id 
                    WHERE users.id = '$userId' 
                    GROUP BY users.id
                    ";
            $lesInformations = $mysqli->query($laQuestionEnSql);
            if (!$lesInformations) {
                echo ("Échec de la requete : " . $mysqli->error);
            }
            $user = $lesInformations->fetch_assoc();

            /**
             * Etape 4: à vous de jouer
             */
            //@todo: afficher le résultat de la ligne ci dessous, remplacer les valeurs ci-après puiseffacer la ligne ci-dessous
            ?>
            <article class='parameters'>
                <h3>Mes paramètres</h3>
                <dl>
                    <dt>Pseudo</dt>
                    <dd><?php echo $user['alias'] ?></dd>
                    <dt>Email</dt>
                    <dd><?php echo $user['email'] ?></dd>
                    <dt>Nombre de message</dt>
                    <dd><?php echo $user['totalpost'] ?></dd>
                    <dt>Nombre de "J'aime" donnés </dt>
                    <dd><?php echo $user['totalgiven'] ?></dd>
                    <dt>Nombre de "J'aime" reçus</dt>
                    <dd><?php echo $user['totalrecieved'] ?></dd>
                </dl>
            </article>

            <main class='contacts'>

            <!-- Si on appuie sur le bouton Mes followers -->
            <?php if(isset($_POST['followers'])){
 
            // Etape 1: récupérer l'id de l'utilisateur
            $userId = intval($_SESSION['connected_id']);
            // Etape 2: se connecter à la base de donnée
            include("BDconnection.php");
            // Etape 3: récupérer le nom de l'utilisateur
            $laQuestionEnSql = "
                    SELECT users.*
                    FROM followers
                    LEFT JOIN users ON users.id=followers.following_user_id
                    WHERE followers.followed_user_id='$userId'
                    GROUP BY users.id
                    ";
            $lesInformations = $mysqli->query($laQuestionEnSql);
            // Etape 4: à vous de jouer
            //@todo: faire la boucle while de parcours des abonnés et mettre les bonnes valeurs ci dessous 

            while ($userId = $lesInformations->fetch_assoc()) { ?>
                <article class='contacts'>
                    <img src="user.jpg" alt="blason" />
                    <h3><?php echo $userId["alias"] ?></h3>
                    <p><?php echo $userId["id"] ?></p>
                </article>
            <?php
            } ?>
            <?php
            }
            ?>

            <!-- Si on appuie sur le boutton mes abonnements -->
            <?php if(isset($_POST['subscribe'])){
                // Etape 1: récupérer l'id de l'utilisateur
                $userId = intval($_SESSION['connected_id']);
                // Etape 2: se connecter à la base de donnée
                include("BDconnection.php");
                // Etape 3: récupérer le nom de l'utilisateur
                $laQuestionEnSql = "
                    SELECT users.* 
                    FROM followers 
                    LEFT JOIN users ON users.id=followers.followed_user_id 
                    WHERE followers.following_user_id='$userId'
                    GROUP BY users.id
                    ";
                $lesInformations = $mysqli->query($laQuestionEnSql);
                
                // Etape 4: à vous de jouer
                //@todo: faire la boucle while de parcours des abonnés et mettre les bonnes valeurs ci dessous 
                while ($user = $lesInformations->fetch_assoc())
                {?>
                    <article class='contacts'>
                    <img src="user.jpg" alt="blason"/>
                    <h3><?php echo $user["alias"]?></h3>
                    <p><?php echo $user["id"]?></p>                    
                </article>
                <?php
                } 
            }?>
        </main>

            
            

        </main>
    </div>
</body>

</html>