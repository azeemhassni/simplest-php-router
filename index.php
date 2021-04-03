<?php

require_once "router.php";

route('/', function () {
    return "Hello World";
});

route('/about', function () {
    return "Hello form the about route";
});

route('/company/{companyName}/?', function($companyName){
    return "The company is {$companyName}";
});

route('/users/{username}/city/{city}', function($username, $city){
    return "{$username} lives in {$city}";
});

$action = $_SERVER['REQUEST_URI'];
dispatch($action);