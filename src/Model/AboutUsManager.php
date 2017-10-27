<?php
/**
 * Created by PhpStorm.
 * User: wilder4
 * Date: 18/10/17
 * Time: 18:11
 */

namespace AtelierO\Model;


class AboutUsManager extends EntityManager
{
    public function findLast()
    {
        $query = "SELECT * FROM about_us";
        $statement = $this->pdo->query($query);
        $statement->execute();
        $statement->setFetchMode(\PDO::FETCH_CLASS, \AtelierO\Model\AboutUs::class);
        return $statement->fetch();
    }

    public function update(AboutUs $aboutUs)
    {
        $query = "UPDATE about_us SET textPresentation=:textPresentation WHERE id=:id";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':textPresentation', $aboutUs->getTextPresentation(), \PDO::PARAM_STR);
        $statement->bindValue(':id', $aboutUs->getId(), \PDO::PARAM_STR);
        $statement->execute();
    }
}
