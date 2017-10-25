<?php
/**
 * Created by PhpStorm.
 * User: wilder9
 * Date: 25/10/17
 * Time: 14:30
 */

namespace AtelierO\Model;


class ImageManager extends EntityManager
{
    public function extractPicture()
    {
        $req = "SELECT * FROM image WHERE is_principal
          INNER JOIN article_blog
          ORDER BY 'date' DESC";
    }
}