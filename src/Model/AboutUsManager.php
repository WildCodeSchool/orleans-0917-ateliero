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
    public function find()
    {
        $query = "SELECT textPresentation FROM about_us WHERE id=3";
        $statement = $this->pdo->query($query);
        $statement->execute();


        $textPresentation = $statement->fetchAll(\PDO::FETCH_CLASS, \AtelierO\Model\AboutUs::class);
        return $textPresentation[0];

    }
}