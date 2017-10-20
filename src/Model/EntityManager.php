<?php
/**
 * Created by PhpStorm.
 * User: wilder4
 * Date: 18/10/17
 * Time: 17:49
 */

namespace AtelierO\Model;


class EntityManager
{

    protected $pdo;

    public function __construct()
    {
        $this->pdo = new \PDO(DSN, USERNAME, PASSWORD, [
            \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        ]);

    }
}