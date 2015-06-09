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

// admin routes
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

// logged in user routes
Route::group(['middleware' => 'auth'], function(){
    Route::get('user/profile/{sectionID}', 'UsersController@profilePage');
    Route::get('user/cart', 'ArticlesController@getCartArticles');
    Route::get('user/like', 'ArticlesController@getLikeArticles');
    Route::get('user/wishlist', 'ArticlesController@getWishlistArticles');
    Route::get('user/follow', 'ArtistsController@getFollowArtists');

    Route::post('user/follow/add', 'FollowsController@addToFollow');
    Route::post('user/cart/add', 'CartsController@addToCart');
    Route::post('user/cart/remove/{articleID}', 'CartsController@removeFromCart');
    Route::post('user/like/add', 'LikesController@addToLike');
    Route::post('user/wishlist/add', 'WishlistsController@addToWishlist');
    Route::post('user/follow/remove', 'FollowsController@removeFromFollow');
    Route::post('user/cart/remove', 'CartsController@removeFromCart');
    Route::post('user/like/remove', 'LikesController@removeFromLike');
    Route::post('user/wishlist/remove', 'WishlistsController@removeFromWishlist');
    Route::post('user/profile/picture','UploadController@storeUser');
});

// guest routes
Route::get('/', 'HomeController@index');
Route::get('home', 'HomeController@index');
Route::get('home/articles', 'ArticlesController@homeArticles');
Route::get('home/articletypes', 'ArticletypesController@index');

Route::get('article/{articleID}', 'ArticlesController@articlePage');
Route::get('artist/{artistID}', 'ArtistsController@artistPage');

Route::get('browse', 'ArticlesController@browse');
Route::get('browse/t/{typeID}', 'ArticlesController@browseType');
Route::get('browse/st/{subtypeID}', 'ArticlesController@browseSubtype');
Route::get('browse/type/{typeID}/{page}', 'ArticlesController@getBrowseType');
Route::get('browse/subtype/{subtypeID}/{page}', 'ArticlesController@getBrowseSubtype');
Route::get('browse/articles/{page}', 'ArticlesController@getBrowseArticles');
Route::get('browse/articletypes', 'ArticletypesController@index');
Route::get('browse/articlesubtypes', 'ArticlesubtypesController@index');



