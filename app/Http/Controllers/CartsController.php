<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\cart as Cart;
use Auth;
use Request;

class CartsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$carts = Cart::all();
		return $carts;
	}

	/**
	* Store a newly created resource in storage.
	*
	* @return Response
	*/
	public function store() {
		$cart = Cart::create(Request::all());
		return $cart;
	}

	/**
	* Update the specified resource in storage.
	*
	* @param  int  $id
	* @return Response
	*/
	public function update($id) {
		$cart = Cart::find($id);
		$cart->quantity = Request::input('quantity');
		$cart->save();

		return $cart;
	}

	/**
	* Remove the specified resource from storage.
	*
	* @param  int  $id
	* @return Response
	*/
	public function destroy($id) {
		Cart::destroy($id);
	}

	// add an article in user's cart
	public function addToCart(){
		$cart = Cart::create(Request::all());
		$cart->userID = Auth::user()->id;
		$cart->quantity = 1;
		$cart->save();
		return $cart;
	}

	// remove an article in user's cart
	public function removeFromCart($articleID){
		$cart = Cart::where('articleID', '=', $articleID)->where('userID', '=', Auth::user()->id)->first();
		Cart::destroy($cart->id);
	}
}
