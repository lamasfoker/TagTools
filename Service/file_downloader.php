<?php

$zipName = '../tmp/image.zip';
$zip = new ZipArchive;
$zip->open($zipName, ZipArchive::CREATE);

foreach ($_POST as $string_data)
{

    $name = substr($string_data, 0,strrpos($string_data, '&&'));
    $fileId = substr($string_data, strrpos($string_data, '&&')+2);

    file_put_contents("../tmp/$name", file_get_contents("https://docs.google.com/uc?id=$fileId&export=download"));
    $zip->addFile("../tmp/$name");
}

$zip->close();

header('Content-Type: application/zip');
header("Content-disposition: attachment; filename=$zipName");
readfile($zipName);
unlink($zipName);
