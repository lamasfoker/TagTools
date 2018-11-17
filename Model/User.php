<?php

namespace tagtools\Model;

require_once 'AbstractModel.php';

class User extends AbstractModel
{

    public function insertRow($data)
    {
        $name = mysqli_real_escape_string($this->_db, $data[0]);
        $imageUrl = mysqli_real_escape_string($this->_db, $data[1]);

        $query = "INSERT INTO User (email, name, imageUrl)
        VALUES('$this->_email', '$name', '$imageUrl')";

        $result = mysqli_query($this->_db, $query );

        return isset($result);
    }

    public function deleteUserData()
    {
        mysqli_query($this->_db, "DELETE FROM User WHERE email='$this->_email'");
    }

    public function isPresentUserData()
    {
        $result = mysqli_query($this->_db, "SELECT * FROM User WHERE email='$this->_email' LIMIT 1");
        //TODO: perhaps it is not correct
        return !is_null(mysqli_fetch_assoc($result));
    }

    public function selectUserData()
    {
        $query = "SELECT * FROM User WHERE email='$this->_email'";

        return mysqli_query($this->_db, $query);
    }
}