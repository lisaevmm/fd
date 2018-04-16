<?php
//include_once '../vendor/autoload.php';


function getSiteHeader($name) {
    $db = DbProvider::getInstance();
    $menuList = $db->getAll('menu_list');

    $logoLink = "href='/index.php'";
    if ($name == "Главная" || $name == "Новости") {
        $logoLink = null;
    }

    echo
    <<<FFF
    <div class="content">
        <div class="main-logo">
            <a {$logoLink} class="logo-link">
                <img src="" alt="ЛОГО" width="50" height="30">
            </a>
        </div>
        <nav class="main-nav">
            <ul class="nav-list">
FFF;

    foreach ($menuList as $row) {
        echo "<li class='nav-item'>";
        if ($name == $row['name']) {
            echo "<a href='{$row['link']}' class='nav-link current'>{$row['name']}</a>";
        } else {
            echo "<a href='{$row['link']}' class='nav-link'>{$row['name']}</a>";
        }
        echo "</li>";
    }

    echo
    <<<FFF
            </ul>
        </nav>
    </div>
FFF;


}
