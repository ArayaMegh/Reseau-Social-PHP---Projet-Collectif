<article>
    <h3>
        <time><?php echo $post['created'];?></time>
    </h3>
    <address><a href="wall.php?user_id=<?php echo $post["author_id"]; ?>"><?php echo $post["author_name"];?></a></address>            
    <div>

    <p><?php echo $post["content"];?></p>
    <!-- <p></p> -->
    <!-- <p></p> -->
    </div>                                            
    <footer>
        
        <small>♥<?php echo $post["like_number"]?></small> 
        <a href="tags.php?id=<?php echo $post["tagId"]; ?>"><?php echo "#" .$post['taglist'];?></a>
        <!-- <a href="">#piscitur</a>, -->
    </footer>
    </article>