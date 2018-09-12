<?php
$zipname = 'xml.zip';
$zip = new ZipArchive;
$zip->open($zipname, ZipArchive::CREATE);

foreach ($_POST as $string_data) {

    $xml = new SimpleXMLElement('<xml/>');

    $name = substr($string_data, 0,strrpos($string_data, '.'));
    $tags = substr($string_data, strrpos($string_data, '&&')+2);
    $list = $xml->addChild( 'list');
    $index=1;
    foreach (explode(', ', $tags) as $tag) {
        if ($tag !== '') {
            $list->addChild("tag-$index", $tag);
            $index++;
        } else {
            $list->addChild("tag-0", 'null');
        }
    }
    $xml->asXML('/tmp/'.$name.'.xml');
    $zip->addFile('/tmp/'.$name.'.xml');
}

$zip->close();

header('Content-Type: application/zip');
header('Content-disposition: attachment; filename='.$zipname);
readfile($zipname);
unlink($zipname);