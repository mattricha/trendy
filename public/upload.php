<?php

if (!empty( $_FILES )) {

    $articleID = $_GET['article'];

    $tempPath = $_FILES[ 'file' ][ 'tmp_name' ];

    $uploadPath = dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'articles' . DIRECTORY_SEPARATOR . $articleID . DIRECTORY_SEPARATOR . $_FILES[ 'file' ][ 'name' ];

    $uploadDirectory = dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'articles' . DIRECTORY_SEPARATOR . $articleID;

    if(!is_dir($uploadDirectory)){
        mkdir($uploadDirectory);
    }

    move_uploaded_file( $tempPath, $uploadPath );

    $answer = array( 'answer' => 'File transfer completed' );
    $json = json_encode( $answer );
    echo $json;
} else {
    echo 'No files';
}
?>
