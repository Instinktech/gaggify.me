<?php
if (!array_key_exists('img', $_GET))
    return;

$image = $_GET['img'];
$dir = substr(substr($image,0,strpos($image,'.')),-2);
$relative = realpath(__DIR__).'/../bucket/original/'.$dir.'/'.$image;
if ( !file_exists($relative))
    echo 'yoo';

header('Content-Type: image/jpeg');
readfile($relative);
//$info = getimagesize($relative);

//echo "<pre>"; print_r($info); exit
?>