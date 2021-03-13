<?php

require_once "router.php";

route('/', function () {
    return "Hello World";
});

route('/about', function () {
    return "Hello form the about route";
});

$action = $_SERVER['REQUEST_URI'];
dispatch($action);