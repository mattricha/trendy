<?php

    $articleID = $_GET['article'];

    $listDirectory = dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'articles' . DIRECTORY_SEPARATOR . $articleID;

    $imgCode = '';

    if ($handle = opendir($listDirectory)) {
        while (false !== ($entry = readdir($handle))) {
            if ($entry != "." && $entry != "..") {
                $imgCode = '<img src="/img/articles/'. $articleID . '/' . $entry . '">';
                echo htmlentities($imgCode);
            }
        }
        closedir($handle);
    }

?>
