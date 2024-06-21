<?php
require_once 'controllers/book-controller.php';

$urlPath= parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if('/liste' === $urlPath) {
    browseBooks();
} elseif('/add' === $urlPath){
    addBook();
} else {
    header('HTTP/1.1 404 Not Found');
}
