<?php

namespace tagtools\Model;

class User extends AbstractModel
{

    public function insertRow($data)
    {
        $name = mysqli_real_escape_string($this->_db, $data[0]);

        $query = "INSERT INTO User (email, name)
        VALUES('$this->_email', '$name')";

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
        //TODO: pheraps it is not correct
        return !is_null(mysqli_fetch_assoc($result));
    }

    public function selectUserData()
    {
        $query = "SELECT * FROM User WHERE email='$this->_email'";

        return mysqli_query($this->_db, $query);
    }
}