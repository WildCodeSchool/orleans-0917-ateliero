<?php
/**
 * Created by PhpStorm.
 * User: pauldossantos
 * Date: 13/10/17
 * Time: 11:31
 */


namespace AtelierO\Controller;


class HomeController extends Controller
{
    public function showAction()
    {
        return $this->twig->render('Home/home.html.twig');
    }
}
