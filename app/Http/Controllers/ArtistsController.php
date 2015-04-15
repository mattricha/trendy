<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Artist;
use Request;

class ArtistsController extends Controller {

    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index() {
        $artists = Artist::all();
        return $artists;
    }

    /**
    * Store a newly created resource in storage.
    *
    * @return Response
    */
    public function store() {
        $artist = Artist::create(Request::all());
        return $artist;
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function update($id) {
        $artist = Artist::find($id);
        $artist->name = Request::input('name');
        $artist->email = Request::input('email');
        $artist->company = Request::input('company');
        $artist->description = Request::input('description');
        $artist->urlPortfolio = Request::input('urlPortfolio');
        $artist->dateJoined = Request::input('dateJoined');
        $artist->save();

        return $artist;
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function destroy($id) {
        Artist::destroy($id);
    }
}
