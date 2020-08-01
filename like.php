<?php
    include "../db_connection.php";
    $c=pg_connect ($db_f);
    $id = $_POST['id'];

    $like="UPDATE reviews SET likes = likes + 1 WHERE review_id='$id'";
    pg_exec($c,$like);

    header('Location: ./review.php?like=yes&id='.$id);
    ?>