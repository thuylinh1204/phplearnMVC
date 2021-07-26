<?php
session_start();
error_reporting(E_ALL);
/**
 * This is the Front Controller.
 * The Front Controller decides which action to run.
 *
 * This particular Front Controller defines a route table, which says
 * which defines which URLs map to which actions.
 *
 * @author thanhtv6075 <thanh.trinh@co-well.vn>
 */
require_once '../vendor/autoload.php';

// Define the routes table
$routes = [
    '/\/admin\/products\/edit\/(.+)/' => ['Admin\\ProductController', 'edit'],
    '/\/admin\/products/' => ['Admin\\ProductController', 'index'],
    '//' => ['IndexController', 'index'],
];

// Decide which route to run
foreach ($routes as $url => $action) {

    // See if the route matches the current request
    $matches = preg_match($url, $_SERVER['REQUEST_URI'], $params);

    // If it matches...
    if ($matches > 0) {
        // Run thics action, passing the parameters.
        $c = "App\\Controllers\\$action[0]";
        $controller = new $c;
        $controller->{$action[1]}($params);

        break;
    }
}