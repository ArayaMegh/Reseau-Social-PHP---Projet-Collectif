<header>
    <img src="PROGRESS-PRIDE-FLAG.png" alt="Logo de notre réseau social"/>
        <nav id="menu">
            <a href="news.php">MySafeNews</a>
            <a href="wall.php?user_id=<?php echo $_SESSION['connected_id']; ?>">MySafePlace</a>
            <a href="feed.php?user_id=<?php echo $_SESSION['connected_id']; ?>">MySafeCommu</a>
            <a href="tags.php?tag_id=1">MySafe#</a>
        </nav>
        <nav id="user">
            <a href="#">Profil</a>
            <ul>
                <li><a href="settings.php?user_id=<?php echo $_SESSION['connected_id']; ?>">Paramètres</a></li>
                <li><a href="followers.php?user_id=<?php echo $_SESSION['connected_id']; ?>">Abonnements</a></li>
                <li><a href="subscriptions.php?user_id=<?php echo $_SESSION['connected_id']; ?>">Followers</a></li>
            </ul>

            <!-- $user['id'] -->

        </nav>
</header>