<?php

require __DIR__ . '/controllers/book-controller.php';

$urlPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if('/' === $urlPath) {

    home();

} elseif ('/book' === $urlPath) {

    browseBook();

}  else {
    header('HTTP/1.1 404 Not Found');
}
