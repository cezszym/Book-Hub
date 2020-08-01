
<?php
    include "../db_connection.php";
    $c=pg_connect ($db_f);
?>
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

    <form class="new-review" action="insert.php" method="POST">
        <div>
            <input type="text" name="title" placeholder="Title">
            <br>
            <input type="text" name="short" placeholder="Review in two words">
            <br>
            <input type="text" name="author" placeholder="Author">
            <br>
            <input type="text" name="genre" placeholder="Genre">
            <br>
            <input type="hidden" name="username" value="guest">
        </div>
        <div>
            <textarea name="text" class="review-text" placeholder="Your review..."></textarea>
        </div>
        <button type="submit" name="submit">Send</button>
    </form>

</body>
</html>