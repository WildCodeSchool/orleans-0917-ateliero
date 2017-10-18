<?php

use AtelierO\Controller\Controller;
use AtelierO\Controller\HomeController;

require '../connect.php';
require '../vendor/autoload.php';

if (!empty($_GET['route'])) {

    $route = $_GET['route'];

    if ($route == 'accueil') {
        // TODO
    }

    if ($route == 'blog') {
        // TODO
    }

    if ($route == 'shop') {
        $controller = new \AtelierO\Controller\CreationController();
        echo $controller->showAction();
    }

    if ($route =='addCreation') {
        $controller = new \AtelierO\Controller\CreationController();
        echo $controller->addCreation();
    }

} else {

    $controller = new HomeController();
    echo $controller->showAction();
}

?>
