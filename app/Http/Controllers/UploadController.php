<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Image;
use Request;


class UploadController extends Controller {

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($articleID)
	{
		if (!empty( $_FILES )) {

		    $tempPath = $_FILES[ 'file' ][ 'tmp_name' ];
		    $fileName = basename($_FILES[ 'file' ][ 'name' ]);
		    $rootPublic = public_path();

		// save as original size

		    $uploadPath = $rootPublic . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'articles' . DIRECTORY_SEPARATOR . $articleID . DIRECTORY_SEPARATOR . $fileName;

		    $uploadDirectory = $rootPublic . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'articles' . DIRECTORY_SEPARATOR . $articleID;

		    if(!is_dir($uploadDirectory)){
		        mkdir($uploadDirectory);
		    }

		    Image::make($tempPath)->save($uploadPath);



		// save as 100x100 thumbnail

		    $uploadPath = $rootPublic . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'articles' . DIRECTORY_SEPARATOR . '100x100' . DIRECTORY_SEPARATOR . $articleID . DIRECTORY_SEPARATOR . $fileName;

		    $uploadDirectory = $rootPublic . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'articles' . DIRECTORY_SEPARATOR . '100x100' . DIRECTORY_SEPARATOR . $articleID;

		    if(!is_dir($uploadDirectory)){
		        mkdir($uploadDirectory);
		    }

		    Image::make($tempPath)->fit(100, 100)->save($uploadPath);



		// save as 200x200 thumbnail

		    $uploadPath = $rootPublic . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'articles' . DIRECTORY_SEPARATOR . '200x200' . DIRECTORY_SEPARATOR . $articleID . DIRECTORY_SEPARATOR . $fileName;

		    $uploadDirectory = $rootPublic . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'articles' . DIRECTORY_SEPARATOR . '200x200' . DIRECTORY_SEPARATOR . $articleID;

		    if(!is_dir($uploadDirectory)){
		        mkdir($uploadDirectory);
		    }

		    Image::make($tempPath)->fit(200, 200)->save($uploadPath);



		// save with max-width 500

		    $uploadPath = $rootPublic . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'articles' . DIRECTORY_SEPARATOR . '500W' . DIRECTORY_SEPARATOR . $articleID . DIRECTORY_SEPARATOR . $fileName;

		    $uploadDirectory = $rootPublic . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'articles' . DIRECTORY_SEPARATOR . '500W' . DIRECTORY_SEPARATOR . $articleID;

		    if(!is_dir($uploadDirectory)){
		        mkdir($uploadDirectory);
		    }

		    Image::make($tempPath)->resize(500, null, function ($constraint){
		    	$constraint->aspectRatio();
			})->save($uploadPath);



		    $answer = array( 'answer' => 'File transfer completed' );
		    $json = json_encode( $answer );
		    echo $json;
		} else {
		    echo 'No files';
		}

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
