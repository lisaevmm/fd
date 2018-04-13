<?

include_once 'app/pdoConnection.php';

//echo '<pre> _SERVER: <br>', var_export($_SERVER, 1), '</pre>';
//echo '<pre> _GET: <br>', var_export($_GET, 1), '</pre>';

$pathArr = array_values(array_filter(explode('/', $_SERVER['REDIRECT_URL']), 'strlen'));
//echo '<pre> path: <br>', var_export($pathArr, 1), '</pre>';

$currentLevel = 0;
$isSection = !strpos($pathArr[$currentLevel], '.html');
if ($isSection) {
    $currentSection = $pathArr[$currentLevel];
    if ($currentSection == 'news') {
        $pageCode = $pathArr[$currentLevel+1];
        $pageCode=substr($pageCode, 0, strpos($pageCode, ".html"));  //удаляем из ссылки расширение файла
        $_GET['code'] = $pageCode;
        $pagePath = 'news.php';
    }
    //тут обработка для других секций


} else {
    $pagePath = $pathArr[$currentLevel];
}

if ($pagePath && file_exists($pagePath)) {
    include_once $pagePath;
} else {
    header('Location: /'); // иначе шлем на главную.
}

exit;

