<?php

include 'pdoConnection.php';

$table_data = $pdoConnection->query('SELECT * FROM news_list');


?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<header class="main-header">
    <div class="content">
        <div class="main-logo">
            <a href="#" class="logo-link">
                <img src="" alt="ЛОГО" width="50" height="30">
            </a>
        </div>
        <nav class="main-nav">
            <ul class="nav-list">
                <li class="nav-item"><a href="" class="nav-link current">Новости</a></li>
                <li class="nav-item"><a href="" class="nav-link">Контакты</a></li>
                <li class="nav-item"><a href="" class="nav-link">О нас</a></li>
            </ul>
        </nav>
    </div>
</header>
<main class="content">
    <ul class="news-list">
        <?php
        while ($row = $table_data->fetch()) {
            echo "<li class='news-list-item'>";
            echo "<a href='#'><h2> {$row['title']} </h2></a>";
            echo "<img class='news-preview-pic' src='{$row['main_img_link']}' alt='ФОТОКАРТОЧКА' width='300' height='200'>";
            echo "<p class='news-text'> {$row['text']} </p>";

            echo "</li>";
        }
        ?>
    </ul>
</main>
<footer class="main-footer">
    <div class="content">

    </div>
</footer>
</body>
</html>