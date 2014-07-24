<?php
header('Content-type: ' . $file['Manual']['type']);
if(!isset($inpage)) header('Content-Disposition: attachment; filename="'.$file['Manual']['name'].'"');
echo $content_for_layout;
die();
?>