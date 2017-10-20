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
use AtelierO\Service\UploadManager;

class CreationController extends Controller
{
    public function addCreation()
    {
        $errors = [];
        if (!empty($_POST)) {

            $creation = new Creation();
            var_dump($creation);

            if (empty($_POST['title'])) {
                $errors[] = "Veuillez ajouter un titre";
            }

            $creation->setTitle($_POST['title']);

            if (empty($_POST['price'])) {
                $errors[] = 'Veuillez ajouter un prix';
            }

            $creation->setPrice($_POST['price']);

            if (empty($_POST['url_etsy'])) {
                $errors[] = 'Veuillez ajouter un lien Etsy';
            }

            $creation->setUrlEtsy($_POST['url_etsy']);

            if (empty($errors)) {
                $uploadManager = new UploadManager($_FILES);
                $uploadManager->fileUpload();
                $creation->setUrlPicture($uploadManager->getUrlPicture());

                $creationManager = new CreationManager();
                $creationManager->add($creation);
            }

        }
        return $this->twig->render('Shop/formShop.html.twig', [
            'message' => $errors,
        ]);
    }

    public function showAction()
    {
        return $this->twig->render('Shop/formShop.html.twig');
    }
}

