<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Articlesubtype;
use Request;

class ArticlesubtypesController extends Controller {

    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index() {
        $articlesubtypes = Articlesubtype::all();
        return $articlesubtypes;
    }

    /**
    * Store a newly created resource in storage.
    *
    * @return Response
    */
    public function store() {
        $articlesubtype = Articlesubtype::create(Request::all());
        return $articlesubtype;
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function update($id) {
        $articlesubtype = Articlesubtype::find($id);
        $articlesubtype->typeID = Request::input('typeID');
        $articlesubtype->name = Request::input('name');
        $articlesubtype->save();
        return $articlesubtype;
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function destroy($id) {
        Articlesubtype::destroy($id);
    }

}
