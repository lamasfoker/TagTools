<?php

namespace tagtools\Model;

class File extends AbstractModel
{

    public function insertRow($data)
    {
        $id = mysqli_real_escape_string($this->_db, $data[0]);
        $file = mysqli_real_escape_string($this->_db, $data[1]);
        $path = mysqli_real_escape_string($this->_db, $data[2]);
        $type = mysqli_real_escape_string($this->_db, $data[3]);
        $tag = mysqli_real_escape_string($this->_db, $data[4]);

        $query = "INSERT into File (email, id, name, path, type, tag)
        values ('$this->_email', '$id', '$file', '$path', '$type', '$tag')";

        $result = mysqli_query($this->_db, $query);

        return isset($result);
    }

    public function deleteUserData()
    {
        mysqli_query($this->_db, "DELETE FROM File WHERE email='$this->_email'");
    }

    public function isPresentUserData()
    {
        $result = mysqli_query($this->_db, "SELECT * FROM File WHERE email='$this->_email' LIMIT 1");
        //TODO: pheraps it is not correct
        return !is_null(mysqli_fetch_assoc($result));
    }

    public function selectUserData()
    {
        $query = "SELECT * FROM File WHERE email='$this->_email' AND type IN ('jpg', 'gif', 'png','jpeg')";

        return mysqli_query($this->_db, $query);
    }

}