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
        $allErrors = [];
        $errors = [];
        $success = [];
        $uploadErrors = [];


        if (!empty($_POST)) {

            $creation = new Creation();

            if (empty($_POST['title'])) {
                $errors[] = "Veuillez ajouter un titre";
            }

            $creation->setTitle($_POST['title']);

            if (empty($_POST['price'])) {
                $errors[] = 'Veuillez ajouter un prix';
            }

            if (!is_int($_POST['price']))
            {
                $errors[] = "Il ne peut y avoir que des chiffres dans le prix";
            }

            $creation->setPrice($_POST['price']);

            if (empty($_POST['url_etsy'])) {
                $errors[] = 'Veuillez ajouter un lien Etsy';
            }

            if (empty($_FILES['url_picture'])) {
                $errors[] = 'Veuillez ajouter une photo';
            }

            $creation->setUrlEtsy($_POST['url_etsy']);

            if (empty($errors)) {
                $uploadManager = new UploadManager($_FILES);
                $uploadErrors = $uploadManager->fileUpload();
                if (empty($uploadErrors)) {
                    $creation->setUrlPicture($uploadManager->getUrlPicture());

                    $creationManager = new CreationManager();
                    $creationManager->add($creation);
                    $success [] = 'L\'objet a bien été ajouté';
                }
            }
        }

        $allErrors = array_merge($errors, $uploadErrors);

        return $this->twig->render('Admin/Shop/adminShopAddCreation.html.twig', [
            'errors' => $allErrors,
            'success' => $success,
            'route' => $_GET['route'],
        ]);
    }

    public function deleteAction()
    {
        if (!empty($_POST['id'])) {
            $creationManager = new CreationManager();
            $creation = $creationManager->find($_POST['id']);
            $picture = $creation->getUrlPicture();
            $creationManager->delete($creation);

            if (file_exists('uploads/' . $picture)) {

                unlink('uploads/' . $picture);
            }
            header('Location: admin.php?route=adminShop');
        }
    }


    public function listAction()
    {
        $creationManager = new CreationManager();
        $listCreations = $creationManager->findAll();

        return $this->twig->render('Admin/Shop/adminShopList.html.twig', [
            'creations' => $listCreations
        ]);
    }

    public function updateAction()
    {
        $errors = [];
        $success = [];
        $uploadErrors = [];
        $creationManager = new CreationManager();

        if (!empty($_POST)) {
            $creation = $creationManager->find($_POST['id']);
//set ton objet creation


            if (empty($_POST['title'])) {
                $errors[] = "Veuillez ajouter un titre";
            }

            if (empty($_POST['price'])) {
                $errors[] = 'Veuillez ajouter un prix';
            }

            if (!is_int( $_POST['price']))
            {
                $errors[] = "Il ne peut y avoir que des chiffres dans le prix";
            }

            if (empty($_POST['url_etsy'])) {
                $errors[] = 'Veuillez ajouter un lien Etsy';
            }

            $creation->setTitle($_POST['title']);
            $creation->setPrice($_POST['price']);
            $creation->setUrlEtsy($_POST['url_etsy']);


            if (empty($errors)) {
                if ($_FILES['url_picture']['name'] != '') {
                    $uploadManager = new UploadManager($_FILES);
                    $uploadErrors = $uploadManager->fileUpload();
                    if (empty($uploadErrors)) {
                        $creation->setUrlPicture($uploadManager->getUrlPicture());
                    }
                }
                $creationManager = new CreationManager();
                $creationManager->update($creation);
                $success [] = 'L\'objet a bien été modifié';
            }
            $allErrors = array_merge($errors, $uploadErrors);
            if (!empty($allErrors)) {
                return $this->twig->render('Admin/Shop/adminShopAddCreation.html.twig', [
                    'creation' => $creation,
                    'errors' => $allErrors,
                ]);
            }
            $listCreations = $creationManager->findAll();

            return $this->twig->render('Admin/Shop/adminShopList.html.twig', [
                'success' => $success,
                'creations' => $listCreations]);
        } else {
            $creation = $creationManager->find($_GET['id']);
            return $this->twig->render('Admin/Shop/adminShopAddCreation.html.twig', [
                'creation' => $creation
            ]);
        }
    }

    public function showAction()
    {
        $creationManager = new CreationManager();
        $listCreations = $creationManager->findAll();

        return $this->twig->render('/Shop/creationView.html.twig', [
            'creations' => $listCreations
        ]);
    }
}
