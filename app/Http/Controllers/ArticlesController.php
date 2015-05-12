<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\article as Article;
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

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function destroy($id) {
        Article::destroy($id);
    }

    public function homeArticles(){
        $homeArticles = Article::join('Images', 'Articles.id', '=', 'Images.articleID')->where('Images.weight', '=', '1')->join('Artists', 'Articles.artistID', '=', 'Artists.id')->join('Articletypes', 'Articles.typeID', '=', 'Articletypes.id')->join('Articlesubtypes', 'Articles.subtypeID', '=', 'Articlesubtypes.id')->select('Articles.id as articleID', 'Articles.title', 'Articles.price', 'Articles.likes', 'Articles.views', 'Articles.dateAdded', 'Images.name as image_name', 'Artists.name as artist_name', 'Articletypes.name as articletype_name', 'Articlesubtypes.name as articlesubtype_name')->get();

        return $homeArticles;
    }

}
