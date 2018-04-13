<?php
include_once 'app/pdoConnection.php';


//foreach ($_POST as $key => $value) {
//    echo "{$key} - {$value} <br>";
//}


if (isset($_POST['title-field']) && isset($_POST['text-field']) && isset($_POST['link-field'])) {

    $title = $_POST['title-field'];
    $text = $_POST['text-field'];
    $link = $_POST['link-field'];
    $imgLink = "";
    if (is_uploaded_file($_FILES['img-file']['tmp_name'])) {
        $uploadDir = 'img/';
        $uploadFile = $uploadDir . basename($_FILES['img-file']['name']);
        echo '<pre>';
        if (move_uploaded_file($_FILES['img-file']['tmp_name'], $uploadFile)) {
            echo "Файл корректен и был успешно загружен.\n";
        } else {
            echo "Возможная атака с помощью файловой загрузки!\n";
        }

        echo 'Некоторая отладочная информация:';
        print_r($_FILES);

        print "</pre>";

        $imgLink = $uploadFile;
    }

    $query = "INSERT INTO news_list(title, text, code, main_img_link) VALUES ('{$title}', '{$text}', '{$link}', '{$imgLink}');";

    $pdoConnection->exec($query);

    echo "Статья добавлена!";
} else {
    echo "Введите данные.";

}




