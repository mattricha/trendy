<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\artist as Artist;
use App\article as Article;
use App\image as Image;
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

    public function artistPage($id){
        $artist = Artist::find($id);
        $articles = Article::join('images', 'articles.id', '=', 'images.articleID')->where('articles.artistID', '=', $id)->where('images.weight', '=', '1')->select('articles.id as articleID', 'articles.title', 'images.name as image_name')->get();
        return view('artist',['artist'=>$artist,'articles'=>$articles]);
    }

}
