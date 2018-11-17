<?php

use \tagtools\Model\Tag;
use \tagtools\Model\File;

require_once '../Model/Tag.php';
require_once '../Model/File.php';

session_start();

if (isset($_POST["upload_btn"]))
{
    $filename = $_FILES["userFile"]["tmp_name"];
    $email = $_SESSION['email'];

    $targetPath = createCsv($filename);

    $fileModel = new File($email);
    $tagModel = new Tag($email);

    if ($_FILES["userFile"]["size"] > 0 && getFileType(basename( $_FILES['userFile']['name'] )) === 'csv')
    {
        $file = fopen($targetPath, "r");
        fgetcsv($file); //I don't save first line
        $tags = '';
        while (($getData = fgetcsv($file)) !== false)
        {
            foreach (getTag($getData[4]) as $tag)
            {
                if ($tag !== '')
                {
                    $tags .= ", $tag";
                }
            }

            if (getFileType($getData[3]) != 'null')
            {
                if(!$fileModel->insertRow([$getData[2], getFileName($getData[3]), getFilePath($getData[3]), getFileType($getData[3]), $getData[4]]))
                {
                    fclose($file);
                    echo alert('Invalid Format:Please Upload CSV File From CloudFind.','../upload.php');
                }
            }
        }
        $tags = substr($tags, 2);
        foreach (getTag($tags) as $tag)
        {
            $uses = substr_count($tags, $tag);
            $tagModel->insertRow([$tag, $uses]);
        }
        fclose($file);
        echo alert('CSV File has been successfully Imported.', '../index.php');
    } else {
        echo alert('Invalid File:Please Upload CSV File.', '../upload.php');
    }
}

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

function createCsv($filename)
{
    $targetPath = "../data/".$_SESSION['email'].'.csv';
    move_uploaded_file( $filename, $targetPath );
    return $targetPath;
}

function alert($message, $location)
{
    return "<script type=\"text/javascript\">
              alert(\"$message\");
              window.location = \"$location\"
            </script>";
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