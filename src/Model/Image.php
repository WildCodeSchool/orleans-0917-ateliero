<?php
/**
 * Created by PhpStorm.
 * User: wilder9
 * Date: 25/10/17
 * Time: 14:26
 */

namespace AtelierO\Model;


class Image
{
    private $id;
    private $path;
    private $articleBlogId;
    private $isPrincipal;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Image
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param mixed $path
     * @return Image
     */
    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getArticleBlogId()
    {
        return $this->articleBlogId;
    }

    /**
     * @param mixed $articleBlogId
     * @return Image
     */
    public function setArticleBlogId($articleBlogId)
    {
        $this->articleBlogId = $articleBlogId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getisPrincipal()
    {
        return $this->isPrincipal;
    }

    /**
     * @param mixed $isPrincipal
     * @return Image
     */
    public function setisPrincipal($isPrincipal)
    {
        $this->isPrincipal = $isPrincipal;
        return $this;
    }


}