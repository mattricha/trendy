<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\articletype as Articletype;
use Request;

class ArticletypesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		$articletypes = Articletype::all();
		return $articletypes;
	}

	/**
	* Store a newly created resource in storage.
	*
	* @return Response
	*/
	public function store() {
		$articletype = Articletype::create(Request::all());
		return $articletype;
	}

	/**
	* Update the specified resource in storage.
	*
	* @param  int  $id
	* @return Response
	*/
	public function update($id) {
		$articletype = Articletype::find($id);
		$articletype->name = Request::input('name');
		$articletype->save();

		return $articletype;
	}

	/**
	* Remove the specified resource from storage.
	*
	* @param  int  $id
	* @return Response
	*/
	public function destroy($id) {
		Articletype::destroy($id);
	}

}
