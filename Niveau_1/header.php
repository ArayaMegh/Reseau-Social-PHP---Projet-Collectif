<header>
    <div class="background">
        <nav class="mega-menu">
            <div class="mega-menu__item">
                <!-- <img src="PROGRESS-PRIDE-FLAG.png" alt="Logo de notre réseau social"/> -->
                <a href="news.php">MySafeNews</a>
            </div>

            <?php if (isset($_SESSION['connected_id'])) : ?>
                <!-- Menu content when the user is connected -->
                <div class="mega-menu__item">
                    <a href="wall.php?user_id=<?php echo $_SESSION['connected_id']; ?>">MySafePlace</a>
                </div>
                <div class="mega-menu__item">
                    <a href="feed.php?user_id=<?php echo $_SESSION['connected_id']; ?>">MySafeCommu</a>
                </div>
                <div class="mega-menu__item">
                    <a href="tagsPerso.php?tag_id==<?php echo $_SESSION['connected_id']; ?>">MySafe#</a>
                </div>
            <?php endif; ?>



            <div class="mega-menu__item mega-menu__trigger">
                <div>
                    <a href="#">Profil</a>
                </div>
                <?php if (isset($_SESSION['connected_id'])) : ?>
                    <ul>
                        <li>
                            <a href="settings.php?user_id=<?php echo $_SESSION['connected_id']; ?>">Paramètres</a>
                        </li>
                        <li>
                            <a href="followers.php?user_id=<?php echo $_SESSION['connected_id']; ?>">Followers</a>
                        </li>
                        <li>
                            <a href="subscriptions.php?user_id=<?php echo $_SESSION['connected_id']; ?>">Abonnements</a>
                        </li>
                        <li>
                            <a href="logout.php">Déconnexion</a>
                        </li>
                    </ul>
                    <div class="mega-menu__content">
                        <a href="settings.php?user_id=<?php echo $_SESSION['connected_id']; ?>">Paramètres</a>
                        <a href="followers.php?user_id=<?php echo $_SESSION['connected_id']; ?>">Followers</a>
                        <a href="subscriptions.php?user_id=<?php echo $_SESSION['connected_id']; ?>">Abonnements</a>
                        <a href="logout.php">Déconnexion</a>
                    </div>
                <?php endif; ?>
            </div>
    </div>
    </nav>
    </div>
</header>