<?php
/**
 * Created by PhpStorm.
 * User: wilder4
 * Date: 18/10/17
 * Time: 18:11
 */

namespace AtelierO\Model;


class PartnerManager extends EntityManager
{
    public function findAll()
    {
        $req = "SELECT * FROM partner";
        $statement = $this->pdo->prepare($req);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function add(Partner $partner)
    {
        $query = "INSERT INTO partner (name, url, url_picture) VALUES (:name, :url, :url_picture)";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':name', $partner->getName(), \PDO::PARAM_STR);
        $statement->bindValue(':url', $partner->getUrl(), \PDO::PARAM_STR);
        $statement->bindValue(':url_picture', $partner->getUrlPicture(), \PDO::PARAM_STR);
        $statement->execute();
    }

    public function delete(Partner $partner)
    {
        $req = "DELETE FROM partner WHERE id=:id";
        $statement = $this->pdo->prepare($req);
        $statement->bindValue('id', $partner->getId(), \PDO::PARAM_INT);
        $statement->execute();
    }

    public function find($id)
    {
        $req = "SELECT * FROM partner WHERE id=$id";
        $statement = $this->pdo->prepare($req);
        $statement->execute();
        $statement->setFetchMode(\PDO::FETCH_CLASS, \AtelierO\Model\Partner::class);
        return $statement->fetch();
    }
}
