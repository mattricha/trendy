<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\template as Template;
use Request;


class TemplatesController extends Controller {

    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index() {
        $templates = Template::all();
        return $templates;
    }

    /**
    * Store a newly created resource in storage.
    *
    * @return Response
    */
    public function store() {
        $template = Template::create(Request::all());
        return $template;
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function update($id) {
        $template = Template::find($id);
        $template->artistID = Request::input('artistID');
        $template->name = Request::input('name');
        $template->description = Request::input('description');
        $template->url = Request::input('url');
        $template->url100x100 = Request::input('url100x100');
        $template->url200x200 = Request::input('url200x200');
        $template->url500W = Request::input('url500W');
        $template->save();

        return $template;
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function destroy($id) {
        Template::destroy($id);
    }

}
