<?php
/**
 * Created by PhpStorm.
 * User: emlv
 * Date: 18/10/17
 * Time: 09:51
 */

namespace AtelierO\Model;


class CreationManager extends EntityManager
{


    public function add(Creation $creation)
    {
        $req = "INSERT INTO creation_shop
                    (title, price, url_picture, url_etsy)
                     VALUES (:title, :price, :url_picture, :url_etsy)";
        $statement = $this->pdo->prepare($req);
        $statement->bindValue(':title', $creation->getTitle(), $this->pdo::PARAM_STR);
        $statement->bindValue(':price', $creation->getPrice(), $this->pdo::PARAM_INT);
        $statement->bindValue(':url_picture', $creation->getUrlPicture(), $this->pdo::PARAM_STR);
        $statement->bindValue(':url_etsy', $creation->getUrlEtsy(), $this->pdo::PARAM_STR);
        $statement->execute();
    }

//    public function findAll()
//    {
//        $query = "SELECT * FROM item_shop";
//        $statement = $this->pdo->query($query);
//
//        return $statement->fetchAll(\PDO::FETCH_CLASS, \AtelierO\Model\Creation::class);
//    }
//
//    public function find(int $id)
//    {
//        $query = "SELECT * FROM item_shop WHERE id=:id";
//        $statement = $this->pdo->prepare($query);
//        $statement->bindValue('id', $id, \PDO::PARAM_INT);
//        $statement->execute();
//
//        $creations = $statement->fetchAll(\PDO::FETCH_CLASS, \AtelierO\Model\Creation::class);
//        return $creations[0];
//    }

//    public function delete()
//    {
//        // TODO
//    }

}
