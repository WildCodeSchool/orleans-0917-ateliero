<?php

use AtelierO\Controller\AdminController;
use AtelierO\Controller\Controller;
use AtelierO\Controller\HomeController;

require '../connect.php';
require '../vendor/autoload.php';

if (!empty($_GET['route'])) {

    $route = $_GET['route'];

    if ($route == 'admin') {
        $controller = new AdminController();
        echo $controller->showAdminAction();
    }

    if ($route == 'adminAccueil') {
        if (!empty($_GET['action']) and $_GET['action'] == 'changeBanner'){
            $controller = new AdminController();
            echo $controller->changeBannerAction();
        } else {
        $controller = new AdminController();
        echo $controller->showAdminAccueilAction();
        }
    }

} else {

    $controller = new AdminController();
    echo $controller->showAdminAction();
}

?>
