<br>
<hr>
<br>

<form action="wall<?php echo $_GET['user_id']; ?>.php">
<input type="submit" value="S'abonner">
</form>

<?php 

//Etape 4 : construction de la requete
$SqFollow = "INSERT INTO followers "
    . "(id, followed_user_id, following_user_id) "
    . "VALUES (NULL, "
    .  $userId. ", "
    . "'" . $_SESSION['connected_id'] . "', "
    ;

    ?>