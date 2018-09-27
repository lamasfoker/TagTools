<?php

namespace tagtools\Controller;

use tagtools\Model\File;
use tagtools\Model\Tag;
use tagtools\Model\User;

class Index
{

    /**@var User**/
    private $_user;
    /**@var File**/
    private $_file;
    /**@var Tag**/
    private $_tag;

    public function __construct()
    {
        $this->_user = new User($_SESSION['email']);
        $this->_file = new File($_SESSION['email']);
        $this->_tag = new Tag($_SESSION['email']);
    }

    public function printTable()
    {
        $table = "<div id='file-table-container'>";
        if ($this->_file->isPresentUserData()) {
            echo "<table id='file-table' class='highlight centered'>
            <thead><tr><th>Id</th>
                <th>Tipo</th>
                <th>Nome</th>
                <th>Tag</th>
            </tr></thead><tbody>";

            while($row = mysqli_fetch_assoc($this->_file->selectUserData())) {
                echo '<tr><td>' . $row['id'].'</td>
                    <td>' . $row['type'].'</td>
                    <td>' . $row['name'].'</td>
                    <td>' . $row['tag'].'</td></tr>';
            }

            echo "</tbody></table>";
            echo '<ul id="file-pagination" class="pagination"></ul>';

        } else {
            echo "you have no records";
        }
        echo "</div>";
        echo "<div id='tag-table-container'>";
        if ($this->_tag->isPresentUserData()) {
            echo "<table id='tag-table' class='highlight centered'>
            <thead><tr>
                <th>Name</th>
            </tr></thead><tbody>";

            while($row = mysqli_fetch_assoc($this->_tag->selectUserData())) {
                echo "<tr><td>" . $row['name']."</td></tr>";
            }

            echo "</tbody></table>";
            echo '<ul id="tag-pagination" class="pagination"></ul>';

        } else {
            echo "you have no records";
        }
        $table .= "</div>";

        echo $table;
    }
}


/* if you wish
 * if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $query = "SELECT COUNT(*) AS total FROM File WHERE email='$email'";
    $db = getdb();
    $result = mysqli_query($db, $query);
    $count = mysqli_fetch_assoc($result);
    if ($count['total'] == 0) {
        header("location: upload.phtml");
    }
}*/