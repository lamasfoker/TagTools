<?php
$zipName = '../tmp/xml.zip';
$zip = new ZipArchive;
$zip->open($zipName, ZipArchive::CREATE);

foreach ($_POST as $string_data)
{

    $xml = new SimpleXMLElement('<xml/>');

    $fileName = substr($string_data, 0,strrpos($string_data, '.')).'.xml';
    $tags = substr($string_data, strrpos($string_data, '&&')+2);
    $list = $xml->addChild( 'list');
    $index=1;
    foreach (explode(', ', $tags) as $tag)
    {
        if ($tag !== '')
        {
            $list->addChild("tag-$index", $tag);
            $index++;
        } else {
            $list->addChild("tag-0", 'null');
        }
    }
    $xml->asXML("/tmp/$fileName");
    $zip->addFile("/tmp/$fileName");
}

$zip->close();

header('Content-Type: application/zip');
header("Content-disposition: attachment; filename=$zipName");
readfile($zipName);
unlink($zipName);