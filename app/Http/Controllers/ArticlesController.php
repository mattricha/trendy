<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Article;
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
 $article->title = Request::input('title');
 $article->artist = Request::input('artist');
 $article->origin = Request::input('origin');
 $article->description = Request::input('description');
 $article->dimensions = Request::input('dimensions');
 $article->color = Request::input('color');
 $article->stock = Request::input('stock');
 $article->price = Request::input('price');
 $article->sale = Request::input('sale');
 $article->tags = Request::input('tags');
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

}
