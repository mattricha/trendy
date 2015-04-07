<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Saleshistory;
use Request;

class SaleshistoryController extends Controller {

    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index() {
        $sales = Saleshistory::all();
        return $sales;
    }

    /**
    * Store a newly created resource in storage.
    *
    * @return Response
    */
    public function store() {
        $sale = Saleshistory::create(Request::all());
        return $sale;
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function update($id) {
        $sale = Saleshistory::find($id);
        $sale->articleID = Request::input('articleID');
        $sale->userID = Request::input('userID');
        $sale->artistID = Request::input('artistID');
        $sale->typeID = Request::input('typeID');
        $sale->subtypeID = Request::input('subtypeID');
        $sale->templateID = Request::input('templateID');
        $sale->title = Request::input('title');
        $sale->dimensions = Request::input('dimensions');
        $sale->size = Request::input('size');
        $sale->style = Request::input('style');
        $sale->color = Request::input('color');
        $sale->quantity = Request::input('quantity');
        $sale->price = Request::input('price');
        $sale->discount = Request::input('discount');
        $sale->originalPrice = Request::input('originalPrice');
        $sale->dateSold = Request::input('dateSold');
        $sale->save();

        return $sale;
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function destroy($id) {
        Saleshistory::destroy($id);
    }

}
