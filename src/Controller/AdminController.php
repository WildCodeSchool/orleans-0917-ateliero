<?php
/**
 * Created by PhpStorm.
 * User: eoras
 * Date: 18/10/17
 * Time: 16:36
 */

namespace AtelierO\Controller;

class AdminController extends Controller
{

    /*
    * Afficher la page principal de l'admin
    */
    public function showAdminAction()
    {
        return $this->twig->render('Admin/home.html.twig');
    }
}
