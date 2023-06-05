

<header>
    <div class="background">
        <nav class="mega-menu">
            <div class="mega-menu__item">
                <!-- <img src="PROGRESS-PRIDE-FLAG.png" alt="Logo de notre réseau social"/> -->
                <a href="news.php">MySafeNews</a>
            </div>
            <div class="mega-menu__item">
                <a href="wall.php?user_id=<?php echo $_SESSION['connected_id']; ?>">MySafePlace</a>
            </div>
            <div class="mega-menu__item">
                <a href="feed.php?user_id=<?php echo $_SESSION['connected_id']; ?>">MySafeCommu</a>
            </div>
            <div class="mega-menu__item">
                <a href="tagsPerso.php?tag_id=1">MySafe#</a>
            </div>
        </nav>
        <nav class="mega-menu">
            <div class="mega-menu__item mega-menu__trigger">
                <a href="#">Profil</a>
            </div>
            <div class="mega-menu__item mega-menu__trigger">
                <a href="settings.php?user_id=<?php echo $_SESSION['connected_id']; ?>">Paramètres</a>
                <ul>
                    <li><a href="followers.php?user_id=<?php echo $_SESSION['connected_id']; ?>">Abonnements</a></li>
                    <li><a href="subscriptions.php?user_id=<?php echo $_SESSION['connected_id']; ?>">Followers</a></li>
                </ul>
            </div>
        </nav>
    </div>
</header>
