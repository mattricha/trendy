<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Image;
use Auth;
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

    // get user profile page
    public function profilePage($sectionID){
        // active tabs
        $likeActive = false;
        $wishlistActive = false;
        $followingActive = false;
        $cartActive = false;
        if($sectionID == "main"){
            $likeActive = true;
        }
        else if($sectionID == "like"){
            $likeActive = true;
        }
        else if($sectionID == "follow"){
            $followingActive = true;
        }
        else if($sectionID == "wishlist"){
            $wishlistActive = true;
        }
        else if($sectionID == "cart"){
            $cartActive = true;
        }
        else{
            $likeActive = true;
        }
        return view('profile',['likeActive'=>$likeActive,'followingActive'=>$followingActive,'wishlistActive'=>$wishlistActive,'cartActive'=>$cartActive]);
    }

}
