<?php

include_once 'vendor/autoload.php';

$pageCode = $_GET['code'];
//$stmt = $pdoConnection->prepare('SELECT * FROM news_list WHERE code= :code');
//echo gettype($pdoConnection);
//$stmt->execute(['code' => $pageCode]);
//$row = $stmt->fetch(PDO::FETCH_LAZY);

$db = new DbProvider();
$row = $db->getRow('news_list', 'code', $_GET['code']);

//echo "<pre>";
//print_r($row);

if (!$row) {
    header('HTTP/1.1 404 Not Found');
    exit();
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $row['title'] ?></title>
    <link rel="stylesheet" type="text/css" href="/style.css">
</head>
<body>
<header class="main-header">
    <?= getSiteHeader("") ?>
</header>

<main class="content">
    <ul class="news-list">
        <h1><?=$row['title']?></h1>
        <?

        echo "<img class='news-preview-pic' src='{$row['main_img_link']}' alt='картинка - {$row['title']}' width='50%' style='display: block; margin: 0px auto;'>";
        echo "<p class='news-text'> {$row['text']} </p>";

        ?>
    </ul>
</main>

<footer class="main-footer">
    <div class="content">

    </div>
</footer>
</body>
</html>
