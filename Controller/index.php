<?php

namespace tagtools\Controller;

use tagtools\Model\User;

class Index
{

    /**@var User**/
    private $_user;

    public function init()
    {
        include '../functions.php';

        if (!isset($_SESSION['email'])) {
            header('location: ../Template/login.phtml');
        }
        if (isset($_GET['logout'])) {
            session_destroy();
            unset($_SESSION['email']);
            header("location: ../Template/login.phtml");
        }


    }

    public function __construct()
    {
        $this->init();
        $this->_user = new User($_SESSION['email']);
    }

    public function printTable()
    {

        $sqlFile = "SELECT * FROM File WHERE email='$email'"; /*WHERE type='jpg' OR type='gif' OR type='png' OR type='jpeg'";*/
        $sqlTag = "SELECT * FROM Tag WHERE email='$email'";
        $resultFile = mysqli_query($db, $sqlFile);
        $resulTag = mysqli_query($db, $sqlTag);

        $table = "<div id='file-table-container'>";
        if (mysqli_num_rows($resultFile) > 0) {
            echo "<table id='file-table' class='highlight centered'>
            <thead><tr><th>Id</th>
                <th>Tipo</th>
                <th>Nome</th>
                <th>Tag</th>
            </tr></thead><tbody>";

            while($row = mysqli_fetch_assoc($resultFile)) {
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
        if (mysqli_num_rows($resulTag) > 0) {
            echo "<table id='tag-table' class='highlight centered'>
            <thead><tr>
                <th>Name</th>
            </tr></thead><tbody>";

            while($row = mysqli_fetch_assoc($resulTag)) {
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