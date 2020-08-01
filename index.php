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
        <a href="index.php"><h1>Book Review Pub</h1></a>
    </header>  

    <a href="create.php">
        <div class='create'>
            Add review as a guest
        </div>
    </a>
    <h1>Hello</h1>
    <form action="search.php" method="POST">
        <input class="text-input" placeholder="search" type="text" name="search">
        <button class="active-button" type="search">
            <i class="fas fa-search"></i>
        </button>
        <div class="select">
            <select name="by" class="filter-by">
                <option value="title">By Title</option>
                <option value="author">By Author</option>
                <option value="genre">By Genre</option>
                <option value="username">By User</option>
            </select>
        </div>
    </form>

    <div class="review-cont">
        <ul class="review-list">
            <?php
            include "../db_connection.php";
            $c=pg_connect ($db_f);
            $s="select * from reviews";
            $r=pg_exec($c,$s);

            $rn = pg_numrows($r);
            $cn = pg_numfields($r);
            
                for($i=0; $i<$rn; $i++){

                $review_id = pg_result($r,$i,0);
                $likes = pg_result($r,$i,7);
                $scom = "select * from comments where review_id='$review_id'";
                $rcom = pg_exec($c, $scom);
                $comnum = pg_numrows($rcom);


                echo "<a href='review.php?id=".pg_result($r,$i,0)."'><li class='review-box'>
                    <ul class='review-elements'>
                        <li style='font-size: 2rem; font-weight:700;'>".pg_result($r,$i,1)."</li>
                        <li style='font-size: 0.8rem; color:grey; font-weight:200;'>Added by ".pg_result($r,$i,2)."</li>
                        <li style='font-size: 1.6rem; font-weight:500;'>".pg_result($r,$i,3)."</li>
                        <li style='font-size: 1rem; font-weight:500; color:grey;'>         
                        <i class='far fa-comments'></i>
                        $comnum
                        <i class='far fa-heart'></i>
                        $likes
                        </li>
                    </ul>               
                </li>
                </a>";
                }
            ?>
        </ul>
    </div>
</body>
</html>