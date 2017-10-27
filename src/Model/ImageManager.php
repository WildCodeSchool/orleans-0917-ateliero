<?php
/**
 * Created by PhpStorm.
 * User: wilder9
 * Date: 25/10/17
 * Time: 14:30
 */

namespace AtelierO\Model;


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
}