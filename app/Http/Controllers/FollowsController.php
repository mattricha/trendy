<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\follow as Follow;
use Auth;
use Request;


class FollowsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$follows = Follow::all();
		return $follows;
	}

	/**
	* Store a newly created resource in storage.
	*
	* @return Response
	*/
	public function store() {
		$follow = Follow::create(Request::all());
		return $follow;
	}

	/**
	* Remove the specified resource from storage.
	*
	* @param  int  $id
	* @return Response
	*/
	public function destroy($id) {
		Follow::destroy($id);
	}

	// add an artist in user's follows
	public function addToFollow(){
		$follow = Follow::create(Request::all());
		$follow->userID = Auth::user()->id;
		$follow->save();
		return $follow;
	}

	// remove an artist in user's follows
	public function removeFromFollow(){
		$follow = Follow::where('artistID', '=', Request::input('artistID'))->where('userID', '=', Auth::user()->id)->first();
		Follow::destroy($follow->id);
	}
}
