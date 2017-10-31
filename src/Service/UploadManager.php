<?php
/**
 * Created by PhpStorm.
 * User: emlv
 * Date: 18/10/17
 * Time: 19:09
 */

namespace AtelierO\Service;

class UploadManager
{

    const UPLOAD_DIR = 'uploads/';
    const SIZELIMIT = '1000000';
    private $url_picture;
    private $file;

    public function __construct($file)
    {
        $this->file = $file;
    }

    /**
     * @return mixed
     */
    public function getUrlPicture()
    {
        return $this->url_picture;
    }

    /**
     * @param mixed $url_picture
     * @return UploadManager
     */
    public function setUrlPicture($url_picture)
    {
        $this->url_picture = $url_picture;
        return $this;
    }

    // upload simple

    /**
     * @return array
     */
    public function fileUpload()
    {
        $uploadErrors = [];

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

        if (!empty($this->file) && !$this->file['url_picture']['error']) {
            $fileName = 'url_picture' . uniqid();


            $extension = strtolower(pathinfo($this->file['url_picture']['name'], PATHINFO_EXTENSION));

            // verif de la taille
            if ($this->file['url_picture']['size'] > self::SIZELIMIT) {
                $uploadErrors[] = 'Le fichier est trop grand';
            }

            // verif type mime (basé sur un tableau de type autorisés)
            $allowedMimes = ['image/jpeg', 'image/png'];
            if (!in_array(mime_content_type($this->file['url_picture']['tmp_name']), $allowedMimes)) {
                $uploadErrors[] = 'Seuls les fichiers jpg ou png sont autorisés';
            }

            if (empty($uploadErrors)) {
                move_uploaded_file($this->file['url_picture']['tmp_name'], self::UPLOAD_DIR . $fileName . '.' . $extension);

                $this->setUrlPicture($fileName . '.' . $extension);
            }
        }

        if ($this->file['url_picture']['error']){
            $uploadErrors[] = $fileUploadErrors[$this->file['url_picture']['error']];

        }

        if (empty($this->file['url_picture']['name'])) {
            $uploadErrors[] = 'Vous devez envoyer une photo';
        }

        return $uploadErrors;

    }

    // Upload multiple

    /**
     * @return array
     */
    public function filesUploads()
    {
        $messages = [];

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

        if (!empty($_FILES['articleBlogFile']['name'][0])) {

            for ($i = 0; $i < count($_FILES['articleBlogFile']['name']); $i++) {

                $fileName = 'blog_' . uniqid();

                $extension = strtolower(pathinfo($_FILES['articleBlogFile']['name'][$i], PATHINFO_EXTENSION));

                // verif de la taille
                if ($_FILES['articleBlogFile']['size'][$i] > self::SIZELIMIT) {
                    $messages['danger'][] = 'Le fichier est trop grand, il ne doit pas excéder 1MO.';
                }

                // verif type mime (basé sur un tableau de type autorisé)
                $allowedMimes = ['image/jpeg', 'image/png'];

                if (!in_array(mime_content_type($_FILES['articleBlogFile']['tmp_name'][$i]), $allowedMimes)) {
                    $messages['danger'][] = 'Seuls les fichiers .jpg ou .png sont autorisés';
                }

                if ($_FILES['articleBlogFile']['error'][$i]) {
                    $messages['danger'][] = $fileUploadErrors[$this->file['articleBlogFile']['error'][$i]];
                }

                if (empty($_FILES['articleBlogFile']['name'][$i])) {
                    $messages['danger'][] = 'Veuillez sélectionner une image';
                }

                if (empty($messages['danger'])) {
                    move_uploaded_file($_FILES['articleBlogFile']['tmp_name'][$i], self::UPLOAD_DIR . $fileName . '.' . $extension);
                    $messages['filesUploaded'][] = $fileName . '.' . $extension;
                }
            }
            return $messages;

        }
    }

    /*
     * Upload de fichier avec remplacement
     */
    public function fileUploadReplace($inputFileName, $nameFile, $uploadDir)
    {
        $messages = [];
        $uploadDir = $uploadDir;   // Ex: images/banner/
        $fileName = $_FILES[$inputFileName]['name'];
        $fileTmpName = $_FILES[$inputFileName]['tmp_name'];
        $fileError = $_FILES[$inputFileName]['error'];
        $movedNameFile = $nameFile;
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

        if (!empty($fileName)) {
            // On récupère l'extention du fichier
            $fileExtension = strtolower(strrchr($fileName, '.'));

            // Vérification de l'extension
            if ($AccepteExtension !== substr($fileExtension, 1)) {
                $messages['danger'][] = "L'extension <b>$fileExtension</b> du fichier " . $fileName . " n'est pas autorisée !";
            }

            // Si erreur PHP on ajoute dans le tableau errors
            if ($fileError > 0) {
                $messages['danger'][] = "Erreur lors du transfert de " . $fileName . ".<br/>" . $fileUploadErrors[$fileError] . ".";
            }
            // Si pas d'erreur, j'envoie mon fichier
            if (empty($messages['danger'])) {
                $uploadFile = $uploadDir . $movedNameFile . $fileExtension;
                // On déplace le fichier du dossier tmp avec le nouveau nom.
                if (move_uploaded_file($fileTmpName, $uploadFile)) {
                } else {
                    $messages['danger'][] = "Erreur lors du transfert de " . $fileName;
                }
            }
        }
        return $messages;
    }
}
