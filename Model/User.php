<?php

namespace tagtools\Model;
include '../config.php';

class User
{
    private $_email;
    private $_name;
    private $_db;

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

    /**
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->_name = mysqli_real_escape_string($this->_db, $name);;
    }

    public function deleteDB()
    {
        mysqli_query($this->_db, "DELETE FROM Tag WHERE email='$this->_email'");
        mysqli_query($this->_db, "DELETE FROM File WHERE email='$this->_email'");
    }

    public function save()
    {
        mysqli_query($this->_db, "INSERT INTO User (email, name)
        VALUES('$this->_email', '$this->_name')");
    }

    public function load()
    {
        //TODO: SESSION has only principal info, the other is loaded throght this method
    }

    /**
     * @return boolean
     */
    public function isPresent()
    {
        $result = mysqli_query($this->_db, "SELECT * FROM User WHERE email='$this->_email' LIMIT 1");
        //TODO: pheraps it is not correct
        return !is_null(mysqli_fetch_assoc($result));
    }

    /**
     * @param string $id
     * @param string $file
     * @param string $path
     * @param string $tag
     * @return boolean
     */
    public function insertFile($id, $file, $path, $type, $tag)
    {
        $id = mysqli_real_escape_string($this->_db, $id);
        $file = mysqli_real_escape_string($this->_db, $file);
        $path = mysqli_real_escape_string($this->_db, $path);
        $type = mysqli_real_escape_string($this->_db, $type);
        $tag = mysqli_real_escape_string($this->_db, $tag);

        $sqlFile = "INSERT into File (email, id, name, path, type, tag)
        values ('$this->_email', '$id', '$file', '$path', '$type', '$tag')";
        $result = mysqli_query($this->_db, $sqlFile);

        return isset($result);
    }

    /**
     * @param string $tag
     * @return boolean
     */
    public function insertTag($tag)
    {
        $tag = mysqli_real_escape_string($this->_db, $tag);
        if ($tag !== '')
        {
            $sqlTag = "INSERT into Tag (email, name)
                    values ('$this->_email', '$tag')";
            $result = mysqli_query($this->_db, $sqlTag);

            return isset($result);
        }
    }
}