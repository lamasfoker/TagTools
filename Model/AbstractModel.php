<?php

namespace tagtools\Model;

include_once 'config.php';

abstract class AbstractModel
{

    protected $_db;
    protected $_email;

    /**
     * @param array $data
     * @return boolean
     */
    public abstract function insertRow($data);

    public abstract function deleteUserData();

    /**
     * @return string
     */
    public abstract function selectUserData();

    /**
     * @return boolean
     */
    public abstract function isPresentUserData();

    /**
     * @param string $email
     */
    public function __construct($email)
    {
        $this->_db = getdb();
        $this->setEmail($email);
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->_email = mysqli_real_escape_string($this->_db, $email);
    }


}