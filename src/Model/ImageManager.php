<?php
/**
 * Created by PhpStorm.
 * User: wilder9
 * Date: 25/10/17
 * Time: 14:30
 */

namespace AtelierO\Model;

use AtelierO\Model\Image;
use AtelierO\Model\ArticleBlog;


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
        $statement->bindValue('is_principal', $articleImage->getIsPrincipal(), \PDO::PARAM_BOOL);
        $statement->execute();
    }

    public function deleteAllImageFromArticle(ArticleBlog $articleBlog)
    {
        $req = "DELETE FROM image
                  WHERE article_blog_id =:id";
        $statement = $this->pdo->prepare($req);
        $statement->bindValue('id', $articleBlog->getId(), \PDO::PARAM_INT);
        $statement->execute();
    }

    public function deleteOneImageFromArticle(Image $image)
    {
        $req = "DELETE FROM image
                  WHERE id=:id";
        $statement = $this->pdo->prepare($req);
        $statement->bindValue('id', $image->getId(), \PDO::PARAM_INT);
        $statement->execute();
    }

    public function findAllImagesToOneArticle($id)
    {
        $req = "SELECT * FROM image WHERE article_blog_id=$id";
        $statement = $this->pdo->prepare($req);
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_CLASS, \AtelierO\Model\Image::class);
    }

    public function findOneImageArticle($id)
    {
        $req = "SELECT * FROM image WHERE id=$id";
        $statement = $this->pdo->prepare($req);
        $statement->execute();
        $statement->setFetchMode(\PDO::FETCH_CLASS, \AtelierO\Model\Image::class);
        return $statement->fetch();
    }

    public function updateImagesArticleBlog(Image $image)
    {
        $req = "UPDATE image SET is_principal=:is_principal 
                  WHERE id=:id";
        $statement = $this->pdo->prepare($req);
        $statement->bindValue('is_principal', $image->getIsPrincipal(), \PDO::PARAM_BOOL);
        $statement->bindValue('id', $image->getId(), \PDO::PARAM_INT);
        $statement->execute();
    }

    public function findAll()
    {
        $req = "SELECT * FROM image";
        $statement = $this->pdo->prepare($req);
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_CLASS, \AtelierO\Model\Image::class);
    }
}
