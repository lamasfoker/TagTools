<?php

namespace tagtools\Model;

class Tag extends AbstractModel
{

    public function insertRow($data)
    {
        $tag = mysqli_real_escape_string($this->_db, $data[0]);

        if ($tag !== '')
        {
            $query = "INSERT into Tag (email, name)
                    values ('$this->_email', '$tag')";

            $result = mysqli_query($this->_db, $query);

            return isset($result);
        }
        return false;
    }

    public function deleteUserData()
    {
        mysqli_query($this->_db, "DELETE FROM Tag WHERE email='$this->_email'");
    }

    public function isPresentUserData()
    {
        $result = mysqli_query($this->_db, "SELECT * FROM Tag WHERE email='$this->_email' LIMIT 1");
        //TODO: pheraps it is not correct
        return !is_null(mysqli_fetch_assoc($result));
    }

    public function selectUserData()
    {
        $query = "SELECT * FROM Tag WHERE email='$this->_email'";

        return mysqli_query($this->_db, $query);
    }

}