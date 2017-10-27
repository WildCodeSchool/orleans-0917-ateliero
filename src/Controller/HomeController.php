<?php
/**
 * Created by PhpStorm.
 * User: pauldossantos
 * Date: 13/10/17
 * Time: 11:31
 */


namespace AtelierO\Controller;

use AtelierO\Model\AboutUsManager;
use AtelierO\Model\Image;
use AtelierO\Model\ImageManager;

class HomeController extends Controller
{
    public function showAction()
    {
        $imgManager = new ImageManager();
        $imgBlog = $imgManager->extractPicture();
        $aboutManager = new AboutUsManager();
        $aboutUs = $aboutManager->findLast();
        return $this->twig->render('Home/home.html.twig', [
            'aboutUs' => $aboutUs,
            'imgBlog' => $imgBlog,
        ]);
    }

}
