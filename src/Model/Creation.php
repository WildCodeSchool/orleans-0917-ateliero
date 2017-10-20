<?php
/**
 * Created by PhpStorm.
 * User: emlv
 * Date: 18/10/17
 * Time: 11:21
 */

namespace AtelierO\Model;


class Creation
{
    private $id;
    private $title;
    private $price;
    private $url_picture;
    private $url_etsy;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Creation
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     * @return Creation
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     * @return Creation
     */
    public function setPrice($price)
    {
        $this->price = $price;
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
     * @return Creation
     */
    public function setUrlPicture($url_picture)
    {
        $this->url_picture = $url_picture;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUrlEtsy()
    {
        return $this->url_etsy;
    }

    /**
     * @param mixed $url_etsy
     * @return Creation
     */
    public function setUrlEtsy($url_etsy)
    {
        $this->url_etsy = $url_etsy;
        return $this;
    }

}
