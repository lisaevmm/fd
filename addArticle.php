<?php
include 'pdoConnection.php';

//
//foreach ($_POST as $key => $value) {
//    echo "{$key} - {$value} <br>";
//}

if (isset($_POST['title']) && isset($_POST['text'])) {

    $title = $_POST['title'];
    $text = $_POST['text'];
    $imgLink = "";
    if (isset($_POST['main_img_link'])) {
        $imgLink = $_POST['main_img_link'];
    }

    $query = "INSERT INTO news_list(title, text, main_img_link) VALUES ('{$title}', '{$text}', '{$imgLink}');";

    $pdoConnection->exec($query);

    echo "Статья добавлена!";
} else {
    echo "Введите данные.";

}




