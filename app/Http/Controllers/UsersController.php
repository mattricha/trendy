<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User as User;
use Request;

class UsersController extends Controller {

    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index() {
        $users = User::all();
        return $users;
    }

    /**
    * Store a newly created resource in storage.
    *
    * @return Response
    */
    public function store() {
        $user = User::create(Request::all());
        return $user;
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function update($id) {
        $user = User::find($id);
        $user->name = Request::input('name');
        $user->email = Request::input('email');
        $user->urlProfileImage = Request::input('urlProfileImage');
        $user->cart = Request::input('cart');
        $user->wishlist = Request::input('wishlist');
        $user->likes = Request::input('likes');
        $user->follow = Request::input('follow');
        $user->history = Request::input('history');
        $user->dateJoined = Request::input('dateJoined');
        $user->save();

        return $user;
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function destroy($id) {
        User::destroy($id);
    }

}
