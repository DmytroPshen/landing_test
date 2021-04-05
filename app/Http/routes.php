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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::group(['middleware'=>'web'], function (){

    Route::match(['get','post'],'/',['uses'=>'IndexController@execute','as'=>'home']);
    Route::get('/page/{alias}',['uses'=>'PageController@execute','as'=>'page']);

    Route::auth();
});

//admin
Route::group(['prefix'=>'admin','middleware'=>'auth', function(){

    //admin
    Route::get('/', function (){

    });

    //admin/pages
    Route::group(['prefix'=>'pages', function(){

        //admin/pages
        Route::get('/',['uses'=>'PagesController@execute','as'=>'pages']);

        //admin/pages/add
        Route::match(['get','post'],'/add',['uses'=>'PagesAddController@execute','as'=>'pagesAdd']);
        //admin/edit/2
        Route::match(['get','post','delete'],'/edit/{page}',['uses'=>'PagesEditController@execute','as'=>'pagesEdit']);
    }]);

    Route::group(['prefix'=>'portfolios'],function(){

        //admin/portfolio
        Route::get('/',['uses'=>'PortfolioController@execute','as'=>'portfolio']);

        //admin/portfolio/add
        Route::match(['get','post'],'/add',['uses'=>'PortfolioAddController@execute','as'=>'portfolioAdd']);
        //admin/edit/2
        Route::match(['get','post','delete'],'/edit/{portfolio}',['uses'=>'PortfolioEditController@execute','as'=>'portfolioEdit']);
    });
}]);
