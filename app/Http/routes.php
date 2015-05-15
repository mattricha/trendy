<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

Route::group(['middleware' => 'admin'], function(){
    Route::get('articleapp','ArticleAppController@index');
    Route::resource('api/articles','ArticlesController');
    Route::resource('api/images','ImagesController');
    Route::get('api/imageCount/{articleID}','ImagesController@imageCount');
    Route::resource('api/articletypes','ArticletypesController');
    Route::resource('api/articlesubtypes','ArticlesubtypesController');
    Route::resource('api/artists','ArtistsController');
    Route::resource('api/comments','CommentsController');
    Route::resource('api/saleshistory','SaleshistoryController');
    Route::resource('api/templates','TemplatesController');
    Route::resource('api/users','UsersController');
    Route::post('uploadArticle/{articleID}','UploadController@storeArticle');
    Route::post('uploadArtist/{artistID}/{index}','UploadController@storeArtist');
});

Route::get('/', 'HomeController@index');
Route::get('home', 'HomeController@index');
Route::get('home/articles', 'ArticlesController@homeArticles');
Route::get('home/articletypes', 'ArticletypesController@index');

Route::get('article/{articleID}', 'ArticlesController@articlePage');
Route::get('artist/{artistID}', 'ArtistsController@artistPage');


