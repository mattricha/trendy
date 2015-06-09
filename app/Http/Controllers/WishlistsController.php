<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\wishlist as Wishlist;
use Auth;
use Request;


class WishlistsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$wishlists = Wishlist::all();
		return $wishlists;
	}

	/**
	* Store a newly created resource in storage.
	*
	* @return Response
	*/
	public function store() {
		$wishlist = Wishlist::create(Request::all());
		return $wishlist;
	}

	/**
	* Remove the specified resource from storage.
	*
	* @param  int  $id
	* @return Response
	*/
	public function destroy($id) {
		Wishlist::destroy($id);
	}

	// add an article in user's wishlist
	public function addToWishlist(){
		$wishlist = Wishlist::create(Request::all());
		$wishlist->userID = Auth::user()->id;
		$wishlist->save();
		return $wishlist;
	}

	// remove an article in user's wishlist
	public function removeFromWishlist(){
		$wishlist = Wishlist::where('articleID', '=', Request::input('articleID'))->where('userID', '=', Auth::user()->id)->first();
		Wishlist::destroy($wishlist->id);
	}

}
