<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
    <link rel="icon" href="https://cdn.icon-icons.com/icons2/1066/PNG/512/Books_icon-icons.com_76879.png">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
    <title>Book Review Hub</title>
</head>
<body>
    
    <header>
        <a href="index.php"><h1>Book Review Hub</h1></a>
    </header>

    <div class="label">Review:</div>

    <div class="review-list">
    <?php
    include "../db_connection.php";
    $c=pg_connect ($db_f);

    $id = pg_escape_string($c, $_GET['id']);
    $like = pg_escape_string($c, $_GET['like']);


    $s="SELECT * FROM reviews WHERE review_id='$id'";
    $r=pg_exec($c,$s);
    

    $rn = pg_numrows($r);
    $cn = pg_numfields($r);

    if($like){
        $like_img = "<form style='padding:1rem'>
        <i style='font-size:2.5rem; color:#d8345f;' class='fas fa-heart'></i>
        </form>";
    }else {
        $like_img = "<form style='padding:1rem' action='like.php' method='POST'>
        <input type='hidden' name='id' value='$id'>
        <button style='padding:0;'><i style='font-size:2.5rem; color:#d8345f; cursor: pointer;' class='far fa-heart'></i></button>
        </form>";
    }

    include "./scape-img.php";

    echo $list;

    for($i=0; $i<$rn; $i++)
        echo "<div class='review'>
            <h1>".pg_result($r,$i,1)."</h1>
            <h6>Added by <a href='user.php?username=".pg_result($r,$i,2)."'>".pg_result($r,$i,2)."</a></h6>
            <br>
            <div>
                <img src='".pg_result($r,$i,8)."'>
            </div>
            <h3>Author: ".pg_result($r,$i,4)."</h3>
            <h3>Genre: ".pg_result($r,$i,5)."</h3>
            <br>
            <br>
            <br>
            <p> ".pg_result($r,$i,6)."<p>   
            <br>
            <a href='https://www.amazon.com/s?k=".pg_result($r,$i,1)."&i=stripbooks-intl-ship&ref=nb_sb_noss' target='_blank'>
            <span style='color:#ff9a00; font-size:0.8rem;'>Get this book on Amazon</span>
            </a>
            $like_img
        </div>";
    ?>
    </div>

    <div class="label">Add comment:</div>

    <form  action="new_com.php" method="POST">
        <?php
        print "<input type='hidden' name='review_id' value=".$id.">";
        print "<input type='hidden' name='like' value=".$like.">";
        ?>
        <input type="text" name="nick" placeholder="Your nick...">
        <br>
        <input type="text" name="text" placeholder="Your comment..." class="text-comment">
        <br>
        <button class="active-button" type="submit" name="submit">
            <i class="fas fa-plus-square"></i>
        </button>
    </form>

    <div class="label">Comments:</div>
    
    <div class="review-list">
        <?php

        $s="SELECT * FROM comments WHERE review_id='$id'";
        $r=pg_exec($c,$s);

        $rn = pg_numrows($r);
        $cn = pg_numfields($r);

        if($rn>0){
            for($i=0; $i<$rn; $i++)
            echo "<div class='review'>
                <h4>".pg_result($r,$i,3)."</h4>
                <h5>".pg_result($r,$i,2)." : ".pg_result($r,$i,4)."</h5>
            </div>";
        }else{
            echo "<h3 style='text-align:center;'>No comments yet</h3>";
            echo "<br><br>";
        }
        ?>
        </ul>
    </div>
</body>
</html>