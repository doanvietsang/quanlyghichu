<?php


   header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.basename('data/'.$_GET['name']));
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize('data/'.$_GET['name']));
    readfile('data/'.$_GET['name']);
    exit;
?>
