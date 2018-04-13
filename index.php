<?php

include_once 'app/pdoConnection.php';
include_once 'templates/header.php';


$stmt = $pdoConnection->prepare('SELECT * FROM news_list order by id DESC');
$stmt->execute();
$table_data = $stmt->fetchAll();
//echo "<pre>";
//print_r($table_data);


?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Новости</title>
    <link rel="stylesheet" type="text/css" href="/style.css">
</head>
<body>
<header class="main-header">
    <?=getSiteHeader("Новости")?>
</header>
<main class="content">
    <ul class="news-list">
        <?php
        foreach ($table_data as $row) {
            echo "<li class='news-list-item'>";
            $pageCode = ($row['code'])? $row['code'] : $row['id'];
            $pageCode = "news/" . $pageCode . ".html";
            /////   ОТДАЮ ССЫЛКИ КОТОРЫЕ ОКАНЧИВАЮТСЯ НА .HTML
            echo "<a href='{$pageCode}'><h2> {$row['title']} </h2></a>";
            echo "<img class='news-preview-pic' src='{$row['main_img_link']}' alt='картинка - {$row['title']}' width='300' height='200'>";
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