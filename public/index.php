<?php

use AtelierO\Controller\Controller;
use AtelierO\Controller\HomeController;

require '../connect.php';
require '../vendor/autoload.php';

if (!empty($_GET['route'])) {

    $route = $_GET['route'];

    if ($route == 'Accueil') {
        // TODO
    }

    if ($route == 'Blog') {
        // TODO
    }

    if ($route == 'Shop') {
        // TODO
    }

} else {

    $controller = new HomeController();
    echo $controller->showAction();
}

?>
