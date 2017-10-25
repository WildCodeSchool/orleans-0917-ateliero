<?php

use AtelierO\Controller\AdminController;
use AtelierO\Controller\CreationController;
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
        if (!empty($_GET['action']) and $_GET['action'] == 'changeBanner') {
            $controller = new AdminController();
            echo $controller->changeBannerAction();
        } else {
            $controller = new AdminController();
            echo $controller->showAdminAccueilAction();
        }
    }

    if ($route == 'adminShop') {
        if (!empty($_GET['action']) and $_GET['action'] == 'showCreationAction') {
            $controller = new CreationController();
            echo $controller->showCreationAction();
        }
        if (!empty($_GET['action']) and $_GET['action'] == 'addCreation') {
            $controller = new CreationController();
            echo $controller->addCreation();

        }

        if (!empty($_GET['action']) and $_GET['action'] == 'deleteAction') {
            $controller = new CreationController();
            echo $controller->deleteAction();

        } else {
            $controller = new CreationController();
            echo $controller->listAction();
        }

    }

    } else {

        $controller = new AdminController();
        echo $controller->showAdminAction();
    }

    ?>