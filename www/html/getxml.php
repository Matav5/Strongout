<?php
include __DIR__."/../inc/dirs.php";
$name = @$_GET['name'];

$file = "$WORKOUT/$name.xml";
// error_log($file);
header("Content-type: text/xml;");
if (file_exists($file))
    readfile($file);