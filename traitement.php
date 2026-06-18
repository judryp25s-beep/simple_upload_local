<?php
    include "debug.php";
    include_once "inc.php";
    //var_dump($_FILES);
    $file = $_FILES["upload"];
    $upload_dir = "/opt/lampp/htdocs/htdocs_/upload_test/";
    $allowed_types = null;
    // $allowed_types = ['image/jpeg', 'image/png', 'application/pdf'];
    $max_size = 10000;
upload_files($file, $upload_dir, $allowed_types, $max_size);
?>
<br>
<a href="index.php">Revenir</a>