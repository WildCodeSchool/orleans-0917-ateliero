<?php
/**
 * Created by PhpStorm.
 * User: eoras
 * Date: 30/10/17
 * Time: 11:44
 */

namespace AtelierO\Model;


class Partner
{
    private $id;
    private $name;
    private $url;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Partners
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return Partners
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     * @return Partners
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUrlPicture()
    {
        return $this->url_picture;
    }

    /**
     * @param mixed $url_picture
     * @return Partners
     */
    public function setUrlPicture($url_picture)
    {
        $this->url_picture = $url_picture;
        return $this;
    }
    private $url_picture;
}