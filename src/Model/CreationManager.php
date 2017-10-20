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
        $statement->bindValue('title', $creation->getTitle(), \PDO::PARAM_STR);
        $statement->bindValue('price', $creation->getPrice(), \PDO::PARAM_INT);
        $statement->bindValue('url_picture', $creation->getUrlPicture(), \PDO::PARAM_STR);
        $statement->bindValue('url_etsy', $creation->getUrlEtsy(), \PDO::PARAM_STR);
        $statement->execute();
    }
}
