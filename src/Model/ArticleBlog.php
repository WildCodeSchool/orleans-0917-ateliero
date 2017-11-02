<?php
/**
 * Created by PhpStorm.
 * User: wilder4
 * Date: 28/10/17
 * Time: 10:46
 */

namespace AtelierO\Model;


class ArticleBlog
{
    private $id;
    private $title;
    private $date;
    private $content;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return ArticleBlog
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
     * @return ArticleBlog
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     * @return ArticleBlog
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     * @return ArticleBlog
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }
}
