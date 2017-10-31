<?php
/**
 * Created by PhpStorm.
 * User: eoras
 * Date: 18/10/17
 * Time: 16:36
 */

namespace AtelierO\Controller;

use AtelierO\Model\AboutUs;
use AtelierO\Model\AboutUsManager;
use AtelierO\Model\Partner;
use AtelierO\Model\PartnerManager;
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
        $aboutUsPost = null;
        $messages = [];

        if (isset($_FILES['banner']) AND $_FILES['banner']['name'] == '') {
            $messages['danger'][] = "Vous devez sélectionner une image.";
        }

        if (!empty($_FILES['banner']['name'])) {
            $messages = $this->manageBanner();
            if (empty($messages['danger'])) {
                $_SESSION['success'] = "banner";
                header("Location: admin.php?route=adminAccueil");
                exit();
            }
        }


        if (!empty($_POST['aboutUs'])) {
            $aboutUsPost = new AboutUs();
            $aboutUsPost->setTextPresentation($_POST['aboutUs']);
            $aboutUsPost->setId($_POST['id']);

            if (!empty($_FILES['aboutUsFile']['name'])) {
                $messages = $this->manageAboutUsFile();
            }

            if (empty($messages['danger'])) {
                $aboutManager = new AboutUsManager();
                $aboutManager->update($aboutUsPost);
                $_SESSION['success'] = "aboutUs";
                header("Location: admin.php?route=adminAccueil");
                exit();
            }
        }

        if (isset($_POST['partnerName'])) {
            $newPartner = new Partner();
            $newPartner->setName($_POST['partnerName']);
            $newPartner->setUrl($_POST['partnerUrl']);

            if (empty($_POST['partnerName'])) {
                $messages['danger'][] = "Vous devez rentrer un nom pour votre partenaire.";
            }

            if (empty($_POST['partnerUrl'])) {
                $messages['danger'][] = "Vous devez renseigner une URL vers le site internet de votre partenaire";
            }

            if (empty($_FILES['partnerFile']['name'])) {
                $messages['danger'][] = "Vous devez ajouter une image pour votre partenaire";
            }

            if (!empty($_FILES['partnerFile']['name'])) {
                $inputFileName = "partnerFile";
                $nameFile = "partner_" . uniqid();
                $uploadDir = 'uploads/';
                $acceptedExtension = ['jpg', 'jpeg', 'png', 'gif'];
                $partnerFile = new UploadManager($_FILES['partnerFile']);
                $messages = $partnerFile->fileUploadUnique($inputFileName, $nameFile, $uploadDir, $acceptedExtension);
            }

            if (empty($messages['danger'])) {
                $newPartner->setUrlPicture($messages['partnerFile'][0]);
                $partnerManager = new PartnerManager();
                $partnerManager->add($newPartner);
                $_SESSION['success'] = "partner";
                header("Location: admin.php?route=adminAccueil");
                exit();
            }
        }

        if (!empty($_SESSION['success'])) {
            if ('banner' == $_SESSION['success']) {
                $messages['success'][] = "L'image a bien été envoyée.";
                session_destroy();
            }
            if ('aboutUs' == $_SESSION['success']) {
                $messages['success'][] = "Votre présentation a bien été mise à jour.";
                session_destroy();
            }
            if ('partner' == $_SESSION['success']) {
                $messages['success'][] = "Votre partenaire a bien été ajouté.";
                session_destroy();
            }
            if ('partnerDeleted' == $_SESSION['success']) {
                $messages['success'][] = "Votre partenaire a bien été supprimé.";
                session_destroy();
            }
        }

        if (!isset($newPartner)) {
            $newPartner = null;
        }
        $partnerManager = new PartnerManager();
        $partners = $partnerManager->findAll();
        $aboutManager = new AboutUsManager();
        $aboutUs = $aboutManager->findLast();
        return $this->twig->render('Admin/Accueil/adminAccueil.html.twig', [
            'messages' => $messages,
            'aboutUs' => $aboutUs,
            'route' => $_GET['route'],
            'aboutUsPost' => $aboutUsPost,
            'partners' => $partners,
            'newPartner' => $newPartner,
        ]);
    }

    public function deletePartnerAction()
    {
        $messages = [];
        if (!empty($_POST['id'])) {

            $partnerManager = new PartnerManager();
            $partner = $partnerManager->find($_POST['id']);
            $fileName = $partner->getUrlPicture();
            $partnerManager->delete($partner);

            $fichier = __DIR__ . "/../../public/uploads/" . $fileName;
            if (file_exists($fichier)) {
                if ($fichier != "." AND $fichier != ".." AND !is_dir($fichier)) {
                    unlink($fichier);
                }
            }
            $_SESSION['success'] = "partnerDeleted";
            header('Location: admin.php?route=adminAccueil');
        } else {
            $messages['danger'][] = "Un problème est survenu lors de la suppression, veuillez réessayer.";
        }
    }

    /*
    * Manager le changement de la bannière
    */
    private function manageBanner()
    {
        $inputFileName = "banner";
        $nameFile = "banner";
        $uploadDir = 'images/banner/';
        $acceptedExtension = ['jpg'];
        $uploadFile = new UploadManager($_FILES);
        $messages = $uploadFile->fileUploadUnique($inputFileName, $nameFile, $uploadDir, $acceptedExtension);

        return $messages;
    }

    private function manageAboutUsFile()
    {
        $inputFileName = "aboutUsFile";
        $nameFile = "aboutUs";
        $uploadDir = 'images/aboutUs/';
        $acceptedExtension = ['jpg'];
        $uploadFile = new UploadManager($_FILES);
        $messages = $uploadFile->fileUploadUnique($inputFileName, $nameFile, $uploadDir, $acceptedExtension);

        return $messages;
    }

}
