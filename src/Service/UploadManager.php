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

}