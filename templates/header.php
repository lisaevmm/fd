<?php
//include_once '../app/pdoConnection.php';
$menuList = $pdoConnection->query("SELECT * FROM menu_list;");

function getSiteHeader($name) {
    global $menuList;
    $logoLink = "href='/index.php'";
    if ($name == "Главная" || $name == "Новости") {
        $logoLink = null;
    }

    echo
    <<<END
    <div class="content">
        <div class="main-logo">
            <a {$logoLink} class="logo-link">
                <img src="" alt="ЛОГО" width="50" height="30">
            </a>
        </div>
        <nav class="main-nav">
            <ul class="nav-list">
END;
    while ($row = $menuList->fetch()) {
        echo "<li class='nav-item'>";
        if ($name == $row['name']) {
            echo "<a href='{$row['link']}' class='nav-link current'>{$row['name']}</a>";
        } else {
            echo "<a href='{$row['link']}' class='nav-link'>{$row['name']}</a>";
        }
        echo "</li>";
    }

    echo
    <<<END
            </ul>
        </nav>
    </div>

END;


}
