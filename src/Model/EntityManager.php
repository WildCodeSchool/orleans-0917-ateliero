<?php
/**
 * Created by PhpStorm.
 * User: emlv
 * Date: 17/10/17
 * Time: 21:34
 */


namespace AtelierO\Model;


class EntityManager
{

    protected $pdo;

    public function __construct()
    {
        $this->pdo = new \PDO(DSN, USER, PASSWORD, [
            \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        ]);
    }
}