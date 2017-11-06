<?php
session_start();
use AtelierO\Controller\AdminController;
use AtelierO\Controller\Controller;
use AtelierO\Controller\CreationController;
use AtelierO\Controller\HomeController;

require '../connect.php';
require '../vendor/autoload.php';

if (!empty($_GET['route'])) {

    $route = $_GET['route'];

    if ($route == 'accueil') {
        $controller = new HomeController();
        echo $controller->showAction();
    }

    if ($route == 'blog') {
        // TODO
    }

    if ($route == 'shop') {
        $controller = new CreationController();
        echo $controller->showAction();
    }

    if ($route == 'addCreation') {
        $controller = new CreationController();
        echo $controller->addCreation();
    }

} else {

    $controller = new HomeController();
    echo $controller->showAction();
}
