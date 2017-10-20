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
    public function find(int $id)
    {
        $query = "SELECT textPresentation FROM about_us WHERE id=1";
        $statement = $this->pdo->query($query);

        return $statement->fetch(\PDO::FETCH_CLASS, \AtelierO\Model\AboutUs::class);
    }
}