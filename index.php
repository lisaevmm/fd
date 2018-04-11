<?php

$host = '127.0.0.1';
$db = 'news';
$user = 'root';
$pass = '';
$charset = 'utf8';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];
$pdo = new PDO($dsn, $user, $pass, $opt);


$table_data = $pdo->query('SELECT * FROM news_list');

//echo "<table>";
//while ($row = $table_data->fetch()) {
//    echo "<tr>";
//    foreach ($row as $cell) {
//        echo "<td>" . $cell . "</td>>";
//    }
//    echo "</tr>";
//}
//echo "</table>";


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<header>

</header>
<main>
    <h1>
        Новости
    </h1>
    <ul class="news-list">
        <?php
        while ($row = $table_data->fetch()) {
            echo "<li class='news-list-item'>";
            echo "<h2> {$row['title']} </h2>";
            echo "<img src='{$row['title']}' alt='ФОТОКАРТОЧКА'>";
            echo "<p> {$row['text']} </p>";

            echo "</li>";
        }
        ?>
    </ul>
</main>
<footer>

</footer>
</body>
</html>