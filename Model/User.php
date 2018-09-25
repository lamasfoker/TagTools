<?php

namespace tagtools\Model;
include '../config.php';

class User
{
    private $_email;
    private $_name;
    private $_db;

    public function __construct()
    {
        $this->_db = getdb();
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->_email = $email;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->_name = $name;
    }

    public function deleteMe()
    {
        mysqli_query($this->_db, "DELETE FROM Tag WHERE email='$this->_email'");
        mysqli_query($this->_db, "DELETE FROM File WHERE email='$this->_email'");
        return;
    }

}