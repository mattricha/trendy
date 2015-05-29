<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\article as Article;
use App\image as Image;
use App\artist as Artist;
use App\articletype as Articletype;
use App\articlesubtype as Articlesubtype;
use Request;

class ArticlesController extends Controller {

    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index() {
        $articles = Article::all();
        return $articles;
    }

    /**
    * Store a newly created resource in storage.
    *
    * @return Response
    */
    public function store() {
        $article = Article::create(Request::all());
        return $article;
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function update($id) {
        $article = Article::find($id);
        $article->artistID = Request::input('artistID');
        $article->typeID = Request::input('typeID');
        $article->subtypeID = Request::input('subtypeID');
        $article->templateID = Request::input('templateID');
        $article->title = Request::input('title');
        $article->description = Request::input('description');
        $article->dimensions = Request::input('dimensions');
        $article->size = Request::input('size');
        $article->style = Request::input('style');
        $article->color = Request::input('color');
        $article->stock = Request::input('stock');
        $article->price = Request::input('price');
        $article->sale = Request::input('sale');
        $article->tags = Request::input('tags');
        $article->likes = Request::input('likes');
        $article->views = Request::input('views');
        $article->dateAdded = Request::input('dateAdded');
        $article->save();

        return $article;
    }

    public function show($id) {
        $article = Article::find($id);
        return $article;
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function destroy($id) {
        Article::destroy($id);
    }


    // HOME PAGE

    public function homeArticles(){
        $homeArticles = Article::join('images', 'articles.id', '=', 'images.articleID')->where('images.weight', '=', '1')->join('artists', 'articles.artistID', '=', 'artists.id')->join('articletypes', 'articles.typeID', '=', 'articletypes.id')->join('articlesubtypes', 'articles.subtypeID', '=', 'articlesubtypes.id')->select('articles.id as articleID', 'articles.title', 'articles.price', 'articles.likes', 'articles.views', 'articles.dateAdded', 'images.name as image_name', 'artists.name as artist_name', 'articletypes.name as articletype_name', 'articlesubtypes.name as articlesubtype_name')->get();

        return self::JSON($homeArticles);
    }


    // ARTICLE PAGE

    public function articlePage($id){
        $article = Article::find($id);
        $artist = Artist::where('id', $article->artistID)->select('name')->get();
        $images = Image::where('articleID', $id)->orderBy('weight', 'asc')->get();
        $type = Articletype::where('id', $article->typeID)->select('name')->get();
        $subtype = Articlesubtype::where('id', $article->subtypeID)->select('name')->get();
        $similarArticles = Article::join('images', 'articles.id', '=', 'images.articleID')->join('artists', 'articles.artistID', '=', 'artists.id')->where('articles.typeID', $article->typeID)->where('images.weight', '=', '1')->take(6)->select('articles.id as articleID', 'articles.title', 'images.name as image_name','artists.name as artist_name')->get();
        $sameArtistArticles = Article::join('images', 'articles.id', '=', 'images.articleID')->where('articles.artistID', $article->artistID)->where('images.weight', '=', '1')->take(6)->select('articles.id as articleID', 'articles.title', 'images.name as image_name')->get();

        // send image array to client side
        echo "<script> var articleImages = " . self::JSON($images) . ";</script>";

        return view('article',['article'=>$article,'images'=>$images,'artist'=>$artist[0]->name,'type'=>$type[0]->name,'subtype'=>$subtype[0]->name, 'similarArticles'=>$similarArticles,'sameArtistArticles'=>$sameArtistArticles]);
    }


    // BROWSE PAGE

    public function browse(){
        return view('browse');
    }

    // page number specified to avoid getting too many articles
    public function browseType($typeID, $page){
        /*
        $perPage = 12;
        $skip = $page * $perPage;
        $browseType = Article::where('articles.typeID', $typeID)->join('images', 'articles.id', '=', 'images.articleID')->where('images.weight', '=', '1')->join('artists', 'articles.artistID', '=', 'artists.id')->join('articletypes', 'articles.typeID', '=', 'articletypes.id')->join('articlesubtypes', 'articles.subtypeID', '=', 'articlesubtypes.id')->take($perPage)->skip($skip)->select('articles.id as articleID', 'articles.title', 'articles.price', 'articles.likes', 'articles.views', 'articles.dateAdded', 'images.name as image_name', 'artists.name as artist_name', 'articletypes.name as articletype_name', 'articlesubtypes.name as articlesubtype_name')->get();
        */
        $browseType = Article::where('articles.typeID', $typeID)->join('images', 'articles.id', '=', 'images.articleID')->where('images.weight', '=', '1')->join('artists', 'articles.artistID', '=', 'artists.id')->join('articletypes', 'articles.typeID', '=', 'articletypes.id')->join('articlesubtypes', 'articles.subtypeID', '=', 'articlesubtypes.id')->select('articles.id as articleID', 'articles.title', 'articles.price', 'articles.likes', 'articles.views', 'articles.dateAdded', 'images.name as image_name', 'artists.name as artist_name', 'articletypes.name as articletype_name', 'articlesubtypes.name as articlesubtype_name')->get();
        return self::JSON($browseType);
    }

    // page number specified to avoid getting too many articles
    public function browseSubtype($subtypeID, $page){
        /*
        $perPage = 12;
        $skip = $page * $perPage;
        $browseSubtype = Article::where('articles.subtypeID', $subtypeID)->join('images', 'articles.id', '=', 'images.articleID')->where('images.weight', '=', '1')->join('artists', 'articles.artistID', '=', 'artists.id')->join('articletypes', 'articles.typeID', '=', 'articletypes.id')->join('articlesubtypes', 'articles.subtypeID', '=', 'articlesubtypes.id')->take($perPage)->skip($skip)->select('articles.id as articleID', 'articles.title', 'articles.price', 'articles.likes', 'articles.views', 'articles.dateAdded', 'images.name as image_name', 'artists.name as artist_name', 'articletypes.name as articletype_name', 'articlesubtypes.name as articlesubtype_name')->get();
        */

        $browseSubtype = Article::where('articles.subtypeID', $subtypeID)->join('images', 'articles.id', '=', 'images.articleID')->where('images.weight', '=', '1')->join('artists', 'articles.artistID', '=', 'artists.id')->join('articletypes', 'articles.typeID', '=', 'articletypes.id')->join('articlesubtypes', 'articles.subtypeID', '=', 'articlesubtypes.id')->select('articles.id as articleID', 'articles.title', 'articles.price', 'articles.likes', 'articles.views', 'articles.dateAdded', 'images.name as image_name', 'artists.name as artist_name', 'articletypes.name as articletype_name', 'articlesubtypes.name as articlesubtype_name')->get();

        return self::JSON($browseSubtype);
    }

    // page number specified to avoid getting too many articles
    public function browseArticles($page){
        /*
        $perPage = 12;
        $skip = $page * $perPage;
        $browseArticles = Article::join('images', 'articles.id', '=', 'images.articleID')->where('images.weight', '=', '1')->join('artists', 'articles.artistID', '=', 'artists.id')->join('articletypes', 'articles.typeID', '=', 'articletypes.id')->join('articlesubtypes', 'articles.subtypeID', '=', 'articlesubtypes.id')->take($perPage)->skip($skip)->select('articles.id as articleID', 'articles.title', 'articles.price', 'articles.likes', 'articles.views', 'articles.dateAdded', 'images.name as image_name', 'artists.name as artist_name', 'articletypes.name as articletype_name', 'articlesubtypes.name as articlesubtype_name')->get();
        */
        $browseArticles = Article::join('images', 'articles.id', '=', 'images.articleID')->where('images.weight', '=', '1')->join('artists', 'articles.artistID', '=', 'artists.id')->join('articletypes', 'articles.typeID', '=', 'articletypes.id')->join('articlesubtypes', 'articles.subtypeID', '=', 'articlesubtypes.id')->select('articles.id as articleID', 'articles.title', 'articles.price', 'articles.likes', 'articles.views', 'articles.dateAdded', 'images.name as image_name', 'artists.name as artist_name', 'articletypes.name as articletype_name', 'articlesubtypes.name as articlesubtype_name')->get();
        return self::JSON($browseArticles);
    }

}
