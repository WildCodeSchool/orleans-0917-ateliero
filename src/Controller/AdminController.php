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

    public function showAdminAccueilAction()
    {
        return $this->twig->render('Admin/Accueil/adminAccueil.html.twig', [
            'route' => $_GET['route'],
        ]);

    }

    /*
     * Changer la bannière du site internet
     * Envoyer un fichier banner.jpg dans le dossier images/banner
     */
    public function changeBannerAction()
    {
        // Initialisation d'un tableau si erreurs
        $errors = [];
        $success = [];
        $uploadDir = 'images/banner/';
        $AccepteExtension = 'jpg';
        $fileUploadErrors = [
            0 => "Aucune erreur, le téléchargement est correct.",
            1 => "La taille du fichier téléchargé excède la valeur maximum",
            2 => "La taille du fichier téléchargé excède la valeur maximum",
            3 => "Le fichier n'a été que partiellement téléchargé.",
            4 => "Aucun fichier n'a été téléchargé.",
            6 => "Un dossier temporaire est manquant, contactez l'administrateur du site.",
            7 => "Échec de l'écriture du fichier sur le disque, contactez l'administrateur du site.",
            8 => "Erreur inconnu, contactez l'administrateur du site.",
        ];

        if (!empty($_FILES['banner']['name'])) {
            // On récupère l'extention du fichier
            $fileExtension = strtolower(strrchr($_FILES['banner']['name'], '.'));

            // Vérification de l'extension
            if ($AccepteExtension !== substr($fileExtension, 1)) {
                $errors[] = "L'extension <b>($fileExtension)</b> du fichier <b>" . $_FILES['banner']['name'] . "</b> n'est pas autorisée !";
            }

            // Si erreur PHP on ajoute dans le tableau errors
            if ($_FILES['banner']['error'] > 0) {
                $errors[] = "Erreur lors du transfert de " . $_FILES['banner']['name'] . ".<br/>" . $fileUploadErrors[$_FILES['banner']['error']] . ".";
            }
            // Si pas d'erreur, j'envoie mon fichier
            if (empty($errors)) {
                $uploadFile = $uploadDir . "banner" . $fileExtension;
                // On déplace le fichier du dossier tmp avec le nouveau nom.
                if (move_uploaded_file($_FILES['banner']['tmp_name'], $uploadFile)) {
                    $success[] = "L'image a bien été envoyée.<br/>";
                } else {
                    $errors[] = "Erreur lors du transfert de " . $_FILES['banner']['name'];
                }
            }
        } else {
            $errors[] = "Vous devez sélectionner une image.";
        }

        return $this->twig->render('Admin/Accueil/adminAccueil.html.twig', [
            'errors' => $errors,
            'success' => $success,
            'route' => $_GET['route'],
        ]);
    }
}
