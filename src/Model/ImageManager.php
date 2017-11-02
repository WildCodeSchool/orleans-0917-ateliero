<?php
/**
 * Created by PhpStorm.
 * User: wilder9
 * Date: 25/10/17
 * Time: 14:30
 */

namespace AtelierO\Model;

use AtelierO\Model\Image;


class ImageManager extends EntityManager
{
    public function extractPicture()
    {
        $query = "SELECT image.*, ab.date FROM image
                JOIN article_blog ab
                    ON image.article_blog_id = ab.id
                WHERE is_principal = 1
                ORDER BY date DESC
                LIMIT 4";

        $statement = $this->pdo->query($query);
        $statement->execute();
        $result = $statement->fetchAll(\PDO::FETCH_CLASS, \AtelierO\Model\Image::class);
        return $result;
    }

    public function addImage(Image $articleImage)
    {
        $req = "INSERT INTO image
                    (path, article_blog_id, is_principal)
                     VALUES (:path, :article_blog_id, :is_principal)";

        $statement = $this->pdo->prepare($req);
        $statement->bindValue('path', $articleImage->getPath(), \PDO::PARAM_STR);
        $statement->bindValue('article_blog_id', $articleImage->getArticleBlogId(), \PDO::PARAM_INT);
        $statement->bindValue('is_principal', $articleImage->getisPrincipal(), \PDO::PARAM_BOOL);
        $statement->execute();
    }
}
