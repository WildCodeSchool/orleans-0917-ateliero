<?php

use AtelierO\Controller\AdminBannerController;
use AtelierO\Controller\AdminController;
use AtelierO\Controller\CreationController;
use AtelierO\Controller\Controller;
use AtelierO\Controller\HomeController;
use AtelierO\Controller\ArticleBlogController;
session_start();

require '../connect.php';
require '../vendor/autoload.php';

if (!empty($_GET['route'])) {

    $route = $_GET['route'];

    if ($route == 'admin') {
        $controller = new AdminController();
        echo $controller->showAdminAction();
    }

    if ($route == 'adminAccueil') {
        $controller = new AdminController();
        echo $controller->showAdminAccueilAction();
    }

    if ($route == 'adminBlogList') {
        $controller = new ArticleBlogController();
        echo $controller->listAction();
    }

    if ($route == 'addArticleBlog') {
        $controller = new ArticleBlogController();
        echo $controller->addArticle();
    }

    if ($route == 'deleteArticleBlog') {
        $controller = new ArticleBlogController();
        echo $controller->deleteAction();
    }

    if ($route == 'updateArticleBlog') {
        $controller = new ArticleBlogController();
        echo $controller->updateAction();
    }

    if ($route == 'deleteImageBlog') {
        $controller = new ArticleBlogController();
        echo $controller->deleteImageBlog();
    }

    if ($route == 'adminShop') {
        $controller = new CreationController();
        echo $controller->listAction();
    }

    if ($route == 'addShopCreation') {
        $controller = new CreationController();
        echo $controller->addCreation();
    }

    if ($route == 'deleteShopAction') {
        $controller = new CreationController();
        echo $controller->deleteAction();
    }

    if ($route == 'deletePartnerAction') {
        $controller = new AdminController();
        echo $controller->deletePartnerAction();
    }

    if ($route == 'updateShopAction') {
        $controller = new CreationController();
        echo $controller->updateAction();
    }
} else {
    $controller = new AdminController();
    echo $controller->showAdminAction();
}
