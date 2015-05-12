<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Comment as Comment;
use Request;

class CommentsController extends Controller {

    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index() {
        $comments = Comment::all();
        return $comments;
    }

    /**
    * Store a newly created resource in storage.
    *
    * @return Response
    */
    public function store() {
        $comment = Comment::create(Request::all());
        return $comment;
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function update($id) {
        $comment = Comment::find($id);
        $comment->articleID = Request::input('articleID');
        $comment->userID = Request::input('userID');
        $comment->likes = Request::input('likes');
        $comment->comment = Request::input('comment');
        $comment->save();

        return $comment;
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function destroy($id) {
        Comment::destroy($id);
    }

}
