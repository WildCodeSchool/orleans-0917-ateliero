<?php
/**
 * Created by PhpStorm.
 * User: eoras
 * Date: 18/10/17
 * Time: 16:36
 */

namespace AtelierO\Controller;

use AtelierO\Model\AboutUsManager;
use AtelierO\Service\UploadManager;

class AdminController extends Controller
{
    /*
    * Afficher la page de connexion de l'administration
    */
    public function showAdminAction()
    {
        return $this->twig->render('Admin/home.html.twig');
    }

    /*
    * Gérer la page Accueil
    */
    public function showAdminAccueilAction()
    {
        $messages = [];

        if (isset($_FILES['banner']) AND $_FILES['banner']['name'] == '') {
            $messages['danger'][] = "Vous devez sélectionner une image.";
        }

        if (!empty($_FILES['banner']['name'])) {
            $messages = $this->manageBanner();
        }
        if (!empty($_SESSION['success']) AND 'banner' == $_SESSION['success']) {
            $messages['success'][] = "L'image a bien été envoyée.";
            session_destroy();
        }

        $aboutManager = new AboutUsManager();
        $aboutUs = $aboutManager->findLast();
        return $this->twig->render('Admin/Accueil/adminAccueil.html.twig', [
            'messages' => $messages,
            'aboutUs' => $aboutUs,
            'route' => $_GET['route'],
        ]);
    }

    /*
    * Manager le changement de la bannière
    */
    private function manageBanner()
    {
        $inputFileName = "banner";
        $nameFile = "banner";
        $uploadDir = 'images/banner/';

        $uploadFile = new UploadManager($_FILES);
        $messages = $uploadFile->fileUploadReplace($inputFileName, $nameFile, $uploadDir);

        return $messages;
    }


    public function manageAboutUs()
    {
        $errors = [];
        $success = [];
    }
}
