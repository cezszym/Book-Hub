<?php
    include "../db_connection.php";
    $c=pg_connect ($db_f);
    $id = $_POST['review_id'];
    $nick = $_POST['nick'];
    $text = $_POST['text'];
    $like = $_POST['like'];

    $s="INSERT INTO comments (review_id,nick,text)
    VALUES ('$id', '$nick','$text');";

    pg_exec($c,$s);

    header('Location: ./review.php?id='.$id.'&like='.$like);
    ?>