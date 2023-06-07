
<header>
    <div class="background">
    <img src="logo.png" alt="Logo de notre réseau social"/>
        <nav class="mega-menu">
            <div class="mega-menu__item">
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
                    <a href="tags.php">MySafe#</a>
                </div>
                <div class="mega-menu__item">
                <div><a href="settings.php?user_id=<?php echo $_SESSION['connected_id']; ?>"> Paramètres </a></div>
            </div>
            <?php endif; ?>

        </nav>
    </div>
</header>


