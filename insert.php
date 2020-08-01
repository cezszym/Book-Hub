<?php
    include "../db_connection.php";

    include('simple_html_dom.php');

    $c=pg_connect ($db_f);
    $title = $_POST['title'];
    $username = $_POST['username'];
    $short = $_POST['short'];
    $author = $_POST['author'];
    $genre = $_POST['genre'];
    $text = $_POST['text'];

    $unPretty = array( 
    '/ą/', '/Ą/', '/ć/', '/Ć/', '/ę/', '/Ę/', '/ł/', '/Ł/' ,
    '/ń/', '/Ń/', '/ó/', '/Ó/', '/ś/', '/Ś/', '/ź/', '/Ź/', '/ż/', '/Ż/',
    );

    $pretty   = array(  
    '%b1', '%b1', '%e6', '%e6', '%ea', '%ea', '%b3', '%b3',
    '%f1', '%f1', '%f3', '%f3', '%b6', '%b6', '%bc', '%bc', '%bf', '%bf'
    );

    $prep_title = strtolower(preg_replace($unPretty, $pretty, $title));

    $img_title = str_replace(' ', '+', $prep_title);
    
    $html = file_get_html("https://aros.pl/szukaj/$img_title/0?wyczysc_filtry=1&sortuj_wedlug=0");

    $img = $html->find('img[style="width: 122px; margin: 0px; border-width: 0px;"]', 0) ->src;

    if(!$img){
        $img = null;
    }

    $s="INSERT INTO reviews (title,username,short,author,genre,text,img)
    VALUES ('$title', '$username', '$short', '$author','$genre','$text','$img');";

    pg_exec($c,$s);

    header('Location: ./index.php');
    ?>