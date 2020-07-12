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
   Route::get('delete/{offer_id}','CrudController@delete') ->name('offers.delete');



   Route::get('all','CrudController@getAllOffers') -> name('offers.all');
});


    Route::get('youtube','CrudController@getVideo') ->middleware('auth');
});


##############begin ajax ########
Route::group(['prefix' => 'ajax-offers'],function(){

    Route::get('create','OffreController@create');
    Route::post('store','OffreController@store') -> name('ajax.offers.store');
    Route::get('all','OffreController@all') -> name('ajax.offers.all');
    Route::post('delete','OffreController@delete') -> name('ajax.offers.delete');
    Route::get('edit/{offer_id}','OffreController@edit') ->name('ajax.offers.edit');
    Route::post('update','OffreController@Update') ->name('ajax.offers.update');
});


##############begin ajax ###########


############begin Authentication && Guards ########
Route::group(['middleware' => 'CheckAge', 'namesapce'=> 'Auth'],function(){
Route::get('adults','Auth\CustomAuthController@adualt')-> name ('adults');

});


Route::get('site','Auth\CustomAuthController@site')->middleware('auth:web')-> name ('site');
Route::get('admin','Auth\CustomAuthController@admin')->middleware('auth:admin')-> name ('admin');

Route::get('admin/login','Auth\CustomAuthController@adminLogin')-> name ('admin.login');
Route::post('admin/login','Auth\CustomAuthController@checkAdminlogin')-> name ('save.admin.login');

############end Authentication && Guards ########

################### Begin relations routs ####################
Route::get('has-one','Relation\RelationsController@hasOneRelation');

Route::get('has-one-reserve','Relation\RelationsController@hasOneRelationReverse');

Route::get('get-user-has-phone','Relation\RelationsController@getUserHasPhone');

Route::get('get-user-not-has-phone','Relation\RelationsController@getUserNotHasPhone');

Route::get('get-user-not-has-phone-with-condition','Relation\RelationsController@getUserHasPhoneWithCondition');
#################### Begin one to many relationship #################
Route::get('hospital-has-many','Relation\RelationsController@getHospitalDoctors');

Route::get('hospitals','Relation\RelationsController@hospitals');
Route::get('doctors/{hospital_id}','Relation\RelationsController@doctors')-> name('hospital.doctors');







##################### End one to many relationship #################




#################### Begin relations routs ####################
