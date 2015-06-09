<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\like as Like;
use App\article as Article;
use Auth;
use Request;


class LikesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$likes = Like::all();
		return $likes;
	}

	/**
	* Store a newly created resource in storage.
	*
	* @return Response
	*/
	public function store() {
		$like = Like::create(Request::all());
		return $like;
	}

	/**
	* Remove the specified resource from storage.
	*
	* @param  int  $id
	* @return Response
	*/
	public function destroy($id) {
		Like::destroy($id);
	}

	// add an article in user's likes
	public function addToLike(){
		$article = Article::find(Request::input('articleID'));
		$article->likes = $article->likes + 1;
		$article->save();
		$like = Like::create(Request::all());
		$like->userID = Auth::user()->id;
		$like->save();
		return $like;
	}

	// remove an article in user's likes
	public function removeFromLike(){
		$article = Article::find(Request::input('articleID'));
		$article->likes = $article->likes - 1;
		$article->save();
		$like = Like::where('articleID', '=', Request::input('articleID'))->where('userID', '=', Auth::user()->id)->first();
		Like::destroy($like->id);
	}

}
