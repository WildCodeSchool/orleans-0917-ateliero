<?php
/**
 * Created by PhpStorm.
 * User: emlv
 * Date: 18/10/17
 * Time: 19:09
 */

namespace AtelierO\Model;


class UploadManager
{

    private $url_picture;
    private $file;

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



    public function __construct($file)
    {
        $this->file = $file;
    }

    public function fileUpload()
    {
        $uploadDir = 'images/';

        if (!empty($this->file)) {
            $fileName = 'url_picture' . uniqid();
            $sizeLimit = '1000000';

            $error = false;
            $extension = strtolower(pathinfo($this->file['url_picture']['name'], PATHINFO_EXTENSION));

            // verif de la taille
            if ($this->file['url_picture']['size'] > $sizeLimit) {
                echo 'Le fichier trop grand';
                $error = true;
            }

            // verif type mime (basé sur un tableau de type autorisés)
            $allowedMimes = ['image/jpeg', 'image/png'];
            if (!in_array(mime_content_type($this->file['url_picture']['tmp_name']), $allowedMimes)) {
                echo 'Seuls les fichiers jpg ou png sont autorisés';
                $error = true;
            }

            if ($error === false) {
                move_uploaded_file($this->file['url_picture']['tmp_name'], $uploadDir . $fileName . '.' . $extension);

                $this->setUrlPicture($uploadDir . $fileName . '.' . $extension);
            }

        }

    }

}