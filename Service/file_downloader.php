<?php

$zipName = 'image.zip';
$zip = new ZipArchive;
$zip->open("../tmp/$zipName", ZipArchive::CREATE);

foreach ($_POST as $string_data)
{

    $img = substr($string_data, 0,strrpos($string_data, '&&'));
    $fileId = substr($string_data, strrpos($string_data, '&&')+2);
    //to bust the download check in the tmp folder if the file is downloaded yet
    file_put_contents("../tmp/$fileId", file_get_contents("https://docs.google.com/uc?id=$fileId&export=download"));
    $zip->addFile("../tmp/$fileId", $img);
}

$zip->close();

header('Content-Type: application/zip');
header("Content-disposition: attachment; filename=$zipName");
readfile("../tmp/$zipName");
unlink("../tmp/$zipName");
