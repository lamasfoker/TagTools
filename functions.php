<?php
session_start();
// connect to the database
include 'config.php';
$db = getdb();

if (isset($_POST["upload_btn"]))
{
    $filename=$_FILES["userFile"]["tmp_name"];
    $email = $_SESSION['email'];

    $target_Path = "data/".$_SESSION['email'].'.csv';
    move_uploaded_file( $filename, $target_Path );

    if ($_FILES["userFile"]["size"] > 0 && getFileType(basename( $_FILES['userFile']['name'] )) === 'csv')
    {
        $file = fopen($target_Path, "r");
        fgetcsv($file);
        while (($getData = fgetcsv($file)) !== false)
        {

            foreach (getTag($getData[4]) as $tag)
            {
                if ($tag !== '')
                {
                    $sqlTag = "INSERT into Tag (email, name)
                    values ('$email','$tag')";
                    $result = mysqli_query($db, $sqlTag);
                }
            }

            $sqlFile = "INSERT into File (email, id, name, path, type, tag)
            values ('$email','$getData[2]','".getFileName($getData[3])."','".getFilePath($getData[3])."','".getFileType($getData[3])."','$getData[4]')";
            $result = mysqli_query($db, $sqlFile);

            if(!isset($result))
            {
                echo "<script type=\"text/javascript\">
                          alert(\"Invalid Format:Please Upload CSV File From CloudFind.\");
                          window.location = \"upload.php\"
                      </script>";
            } else {
                echo "<script type=\"text/javascript\">
                        alert(\"CSV File has been successfully Imported.\");
                        window.location = \"index.php\"
                      </script>";
            }
        }
        fclose($file);
    } else {
        echo "<script type=\"text/javascript\">
                  alert(\"Invalid File:Please Upload CSV File.\");
                  window.location = \"upload.php\"
              </script>";
    }
}


/* make a modification use to download the csv
if (isset($_POST["Export"])){

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=data.csv');
    $output = fopen("php://output", "w");
    fputcsv($output, array('ID', 'First Name', 'Last Name', 'Email', 'Joining Date'));
    $query = "SELECT * from employeeinfo ORDER BY emp_id DESC";
    $result = mysqli_query($db, $query);
    while($row = mysqli_fetch_assoc($result))
    {
        fputcsv($output, $row);
    }
    fclose($output);
}*/

function getFileName($string_data)
{
    return substr($string_data, strrpos($string_data, '/')+1);
}

function getFilePath($string_data)
{
    $index = strrpos($string_data, '/');
    if ($index === 0)
    {
        $path = '/';
    } else {
        $path = substr($string_data, 0, $index);
    }
    return $path;
}

function getFileType($string_data)
{
    $index = strrpos($string_data, '.');
    if (!$index)
    {
        $suffix = 'null';
    } else {
        $suffix = substr($string_data, $index+1);
    }
    return  strtolower($suffix);
}

function getTag($string_data)
{
    return explode(', ', $string_data);
}

function getAllRecords(){
    $db = getdb();
    $email = $_SESSION['email'];

    $sqlFile = "SELECT * FROM File WHERE email='$email'"; /*WHERE type='jpg' OR type='gif' OR type='png' OR type='jpeg'";*/
    $sqlTag = "SELECT * FROM Tag WHERE email='$email'";
    $resultFile = mysqli_query($db, $sqlFile);
    $resulTag = mysqli_query($db, $sqlTag);

    echo "<div id='file-table-container'>";
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
    echo "</div>";
}