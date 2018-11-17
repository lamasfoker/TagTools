<?php

namespace tagtools\Model;

require_once 'AbstractModel.php';

class Tag extends AbstractModel
{

    public function insertRow($data)
    {
        $tag = mysqli_real_escape_string($this->_db, $data[0]);
        $uses = mysqli_real_escape_string($this->_db, $data[1]);

        if ($tag !== '')
        {
            $query = "INSERT into Tag (email, name, uses)
                    values ('$this->_email', '$tag', '$uses')";

            $result = mysqli_query($this->_db, $query);

            return isset($result);
        }
        return true;
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