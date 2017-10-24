<?php
/**
 * Created by PhpStorm.
 * User: wilder4
 * Date: 24/10/17
 * Time: 08:24
 */

namespace AtelierO\Model;


class FormMail
{
    private $to;
    private $name;
    private $mailExpe;
    private $subject;
    private $message;
    private $headers;

    /**
     * @return mixed
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @param mixed $to
     * @return FormMail
     */
    public function setTo($to)
    {
        $this->to = $to;
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
     * @return FormMail
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMailExpe()
    {
        return $this->mailExpe;
    }

    /**
     * @param mixed $mailExpe
     * @return FormMail
     */
    public function setMailExpe($mailExpe)
    {
        $this->mailExpe = $mailExpe;
        return $this;
    }


    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param mixed $subject
     * @return FormMail
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     * @return FormMail
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @param mixed $headers
     * @return FormMail
     */
    public function setHeaders($headers)
    {
        $this->headers = $headers;
        return $this;
    }

}
