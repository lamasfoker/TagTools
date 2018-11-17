<?php

namespace tagtools\Controller;

use tagtools\Model\File;
use tagtools\Model\Tag;

require_once '../Model/File.php';
require_once '../Model/Tag.php';

class Index
{

    /**@var File**/
    private $_file;
    /**@var Tag**/
    private $_tag;

    public function __construct($email)
    {
        $this->_file = new File($email);
        $this->_tag = new Tag($email);
    }

    public function printTables()
    {
        echo "<div id='file-table-container'>";
        if ($this->_file->isPresentUserData()) {
            echo "<table id='file-table' class='highlight centered'>
            <thead><tr>
                <th>Id</th>
                <th>Tipo</th>
                <th>Nome</th>
                <th>Path</th>
                <th>Tag</th>
            </tr></thead><tbody>";

            $return = $this->_file->selectUserData();

            while($row = mysqli_fetch_assoc($return)) {
                echo '<tr';

                if (in_array($row['type'], ['jpg', 'jpeg', 'png', 'gif']))
                {
                    echo ' class="img"';
                }

                echo '><td>' . $row['id'].'</td>
                    <td>'.$row['type'].'</td>
                    <td>'.$row['name'].'</td>
                    <td>'.$row['path'].'</td>
                    <td>'.$row['tag'].'</td></tr>';
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
                <th>Nome</th>
                <th>N° Usi</th>
            </tr></thead><tbody>";

            $return = $this->_tag->selectUserData();

            while($row = mysqli_fetch_assoc($return)) {
                echo "<tr><td>".$row['name']."</td><td>".$row['uses']."</td></tr>";
            }

            echo "</tbody></table>";
            echo '<ul id="tag-pagination" class="pagination"></ul>';

        } else {
            echo "you have no records";
        }
        echo "</div>";
    }
}