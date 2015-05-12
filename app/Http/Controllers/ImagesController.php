<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\image as Image;
use Request;

class ImagesController extends Controller {

    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index() {
        $images = Image::all();
        return $images;
    }

    /**
    * Store a newly created resource in storage.
    *
    * @return Response
    */
    public function store() {
        $image = Image::create(Request::all());
        return $image;
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function update($id) {
        $image = Image::find($id);
        $image->articleID = Request::input('articleID');
        $image->weight = Request::input('weight');
        $image->name = Request::input('name');
        $image->visible = Request::input('visible');
        $image->save();
        return $image;
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function destroy($id) {
        Image::destroy($id);
    }

    public function show($id){
        $images = Image::where('articleID', $id)->orderBy('weight', 'asc')->get();
        return $images;
    }

    public function imageCount($articleID){
        $count = Image::where('articleID', $articleID)->count()->get();
        return $count;
    }

}
