<?php
require_once 'controllers/checkpoint1-controller.php';

$urlPath= parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if('/' === $urlPath) {
    browsecheckpoint1();
} elseif ('/show' === $urlPath && isset($_GET['id'])) {
    showcheckpoint1($_GET['id']);
} elseif ('/add' === $urlPath) {
    addcheckpoint1();
} elseif ('/update' === $urlPath && isset($_GET['id'])) {
    updatecheckpoint1($_GET['id']);
} else {
    header('HTTP/1.1 404 Not Found');
}
