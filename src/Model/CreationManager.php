<?php
/**
 * Created by PhpStorm.
 * User: emlv
 * Date: 18/10/17
 * Time: 09:51
 */

namespace AtelierO\Model;


use AtelierO\Controller\CreationController;

class CreationManager extends EntityManager
{


    public function add(Creation $creation)
    {
        $req = "INSERT INTO creation_shop
                    (title, price, url_picture, url_etsy)
                     VALUES (:title, :price, :url_picture, :url_etsy)";

        $statement = $this->pdo->prepare($req);
        $statement->bindValue('title', $creation->getTitle(), \PDO::PARAM_STR);
        $statement->bindValue('price', $creation->getPrice(), \PDO::PARAM_INT);
        $statement->bindValue('url_picture', $creation->getUrlPicture(), \PDO::PARAM_STR);
        $statement->bindValue('url_etsy', $creation->getUrlEtsy(), \PDO::PARAM_STR);
        $statement->execute();
    }


    public function update(Creation $creation)
    {
        $req = "UPDATE creation_shop SET title=:title, price=:price, url_picture=:url_picture, url_etsy=:url_etsy 
                  WHERE id=:id";
        $statement = $this->pdo->prepare($req);
        $statement->bindValue('title', $creation->getTitle(), \PDO::PARAM_STR);
        $statement->bindValue('price', $creation->getPrice(), \PDO::PARAM_INT);
        $statement->bindValue('url_picture', $creation->getUrlPicture(), \PDO::PARAM_STR);
        $statement->bindValue('url_etsy', $creation->getUrlEtsy(), \PDO::PARAM_STR);
        $statement->bindValue('id', $creation->getId(), \PDO::PARAM_INT);
        $statement->execute();
    }

    public function delete(Creation $creation)
    {
        $req = "DELETE FROM creation_shop WHERE id=:id";
        $statement = $this->pdo->prepare($req);
        $statement->bindValue('id', $creation->getId(), \PDO::PARAM_INT);
        $statement->execute();
    }

    public function findAll()
    {
        $req = "SELECT * FROM creation_shop";
        $statement = $this->pdo->prepare($req);
        $statement->execute();
        $statement->setFetchMode(\PDO::FETCH_CLASS, \AtelierO\Model\Creation::class);
        return $statement->fetchAll();
    }

    public function find($id)
    {
        $req = "SELECT * FROM creation_shop WHERE id=$id";
        $statement = $this->pdo->prepare($req);
        $statement->execute();
        $statement->setFetchMode(\PDO::FETCH_CLASS, \AtelierO\Model\Creation::class);
        return $statement->fetch();
    }


}


