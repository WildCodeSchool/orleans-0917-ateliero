<?php
/**
 * Created by PhpStorm.
 * User: pauldossantos
 * Date: 12/10/17
 * Time: 17:45
 */


namespace AtelierO\Controller;


class Controller
{
    protected $twig;

    public function __construct ()
    {
        $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../View');
        $this->twig = new \Twig_Environment($loader, array(
            'cache' => false,
        ));
    }
}