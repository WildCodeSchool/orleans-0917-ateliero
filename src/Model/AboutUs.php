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
    private $textePresentation;

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
    public function getTextePresentation()
    {
        return $this->textePresentation;
    }

    /**
     * @param mixed $textePresentation
     * @return AboutUs
     */
    public function setTextePresentation($textePresentation)
    {
        $this->textePresentation = $textePresentation;
        return $this;
    }

}