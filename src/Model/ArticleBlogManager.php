<?php
/**
 * Created by PhpStorm.
 * User: wilder4
 * Date: 28/10/17
 * Time: 10:48
 */

namespace AtelierO\Model;


class ArticleBlogManager extends EntityManager
{
    public function add(ArticleBlog $articleBlog)
    {
        $req = "INSERT INTO article_blog
                    (title, date, content)
                     VALUES (:title, :date, :content)";

        $statement = $this->pdo->prepare($req);
        $statement->bindValue('title', $articleBlog->getTitle(), \PDO::PARAM_STR);
        $statement->bindValue('date', $articleBlog->getDate(), \PDO::PARAM_STR);
        $statement->bindValue('content', $articleBlog->getContent(), \PDO::PARAM_STR);
        $statement->execute();
        return $this->pdo->lastInsertId();
    }

    public function findAll()
    {
        $req = "SELECT * FROM article_blog ORDER BY date DESC";
        $statement = $this->pdo->prepare($req);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function find($id)
    {
        $req = "SELECT * FROM article_blog WHERE id=$id";
        $statement = $this->pdo->prepare($req);
        $statement->execute();
        $statement->setFetchMode(\PDO::FETCH_CLASS, \AtelierO\Model\ArticleBlog::class);
        return $statement->fetch();
    }

    public function delete(ArticleBlog $articleBlog)
    {
        $req = "DELETE FROM article_blog WHERE id=:id";
        $statement = $this->pdo->prepare($req);
        $statement->bindValue('id', $articleBlog->getId(), \PDO::PARAM_INT);
        $statement->execute();
    }

    public function update(ArticleBlog $articleBlog)
    {
        $req = "UPDATE article_blog SET title=:title, date=:date, content=:content 
                  WHERE id=:id";
        $statement = $this->pdo->prepare($req);
        $statement->bindValue('title', $articleBlog->getTitle(), \PDO::PARAM_STR);
        $statement->bindValue('date', $articleBlog->getDate(), \PDO::PARAM_STR);
        $statement->bindValue('content', $articleBlog->getContent(), \PDO::PARAM_STR);
        $statement->bindValue('id', $articleBlog->getId(), \PDO::PARAM_INT);
        $statement->execute();

    }
}
