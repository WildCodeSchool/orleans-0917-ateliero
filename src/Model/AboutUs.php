<?php
/**
 * Created by PhpStorm.
 * User: wilder4
 * Date: 18/10/17
 * Time: 17:57
 */

namespace AtelierO\Model;

class AboutUs
{
    private $id;
    private $textPresentation;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return AboutUs
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTextPresentation()
    {
        return $this->textPresentation;
    }

    /**
     * @param mixed $textPresentation
     * @return AboutUs
     */
    public function setTextPresentation($textPresentation)
    {
        $this->textPresentation = $textPresentation;
        return $this;
    }
}
