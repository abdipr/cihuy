<?php
$request = $_SERVER['REQUEST_URI'];
switch ($request) {
    case '/' :
        require __DIR__ . '/home.php';
        break;
    case preg_match('/\/film\/(.+)/', $request, $matches) ? true : false :
        $_GET['id'] = $matches[1];
        require __DIR__ . '/film.php';
        break;
    default:
        http_response_code(404);
        echo "404 - Page not found";
        break;
}
?>
