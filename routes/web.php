<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {

Route::group(['namespace' => 'Admin'],function(){

    Route::get('second','SecondController@showString0') ->middleware('auth');
    Route::get('second1','SecondController@showString1') ;



});

Route::get('login', function () {
    return 'يرجى تسجيل الدخول';
}) -> name('login');


Route::get('/', function () {
    return view('welcome');
});

Route::get('index','Front\UserController@getIndex');

Route::get('/test2/{id}', function ($id) {
    return $id;
}) -> name('a');

Route::get('/landing', function () {
    return view('landing');
});

Route::get('/test3/{id?}', function ($id) {
    return 'welcome'.' '.$id;
})->name('b');


Route::resource('news','NewsController');

Auth::routes(['verify'=>true]);

Route::get('/home', 'HomeController@index')->name('home') ->middleware('verified');


Route::get('fillable','CrudController@getOffers');


Route::group(['prefix' => 'offers'],function(){
   // Route::get('store','CrudController@store');




    Route::get('create','CrudController@create');
   Route::post('store','CrudController@store') ->name('offers.store');

   Route::get('edit/{offer_id}','CrudController@editOffer');
   Route::post('update/{offer_id}','CrudController@Updateoffer') ->name('offers.update');



   Route::get('all','CrudController@getAllOffers');
});
    Route::get('youtube','CrudController@getVideo');
});




