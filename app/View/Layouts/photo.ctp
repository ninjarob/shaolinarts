<?php
header('Content-type: ' . $file['Photo']['type']);
if(!isset($inpage)) header('Content-Disposition: attachment; filename="'.$file['Photo']['id'].'"');
echo $content_for_layout;
die();
?>