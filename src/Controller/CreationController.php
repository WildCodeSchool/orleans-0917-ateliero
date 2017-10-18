<?php
/**
 * Created by PhpStorm.
 * User: emlv
 * Date: 17/10/17
 * Time: 12:13
 */

namespace AtelierO\Controller;


use AtelierO\Model\Creation;
use AtelierO\Model\CreationManager;
use AtelierO\Model\UploadManager;

class CreationController extends Controller
{
    public function addCreation()
    {
        $errors = [];
        $creation = new Creation();

        if (!empty($_POST)) {
            $creation->setTitle($_POST['title']);

            $creation->setPrice($_POST['price']);

            $uploadManager = new UploadManager($_FILES);
            $uploadManager->fileUpload();
            $creation->setUrlPicture($uploadManager->getUrlPicture());

            $creation->setUrlEtsy($_POST['url_etsy']);

            if (empty($_POST['title'])) {
                $errors[] = 'Veuillez ajouter un titre';
            }

            if (empty($_POST['price'])) {
                $errors[] = 'Veuillez ajouter un prix';
            }

            if (empty($_POST['url_etsy'])) {
                $errors[] = 'Veuillez ajouter un lien Etsy';
            }


            if (empty($errors)) {

                $creationManager = new CreationManager();
                $creationManager->add($creation);
            }

            return $this->showAction();
        }
    }

    public function showAction()
    {

        return $this->twig->render('Shop/formShop.html.twig');
    }
}

