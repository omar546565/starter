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

define('PAGINATION_COUNT',3);
Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {

Route::group(['namespace' => 'Admin'],function(){

    Route::get('second','SecondController@showString0') ->middleware('auth');
    Route::get('second1','SecondController@showString1') ;



});

Route::get('login', function () {
    return 'يرجى تسجيل الدخول';
}) -> name('login');


Route::get('/23', function () {

    return view('welcome');
});

Route::get('index','Front\UserController@getIndex');

Route::get('/test2/{id}', function ($id) {
    return $id;
}) -> name('a');

Route::get('/landing', function () {


    $connection = new BulkGate\Message\Connection('19137', 'vg1nFNyxsf0W6vRV1XJ47hwgdzA3U1mi5ZYHMaH7tQ8OVWjTUI');

    $sender = new BulkGate\Sms\Sender($connection);
    $message = new BulkGate\Sms\Message('905528492990', 'تجريب الرسائل');

    $sender->send($message);

    return view('landing');
});

Route::get('/test3/{id?}', function ($id) {
    return 'welcome'.' '.$id;
})->name('b');


Route::resource('news','NewsController');

Auth::routes(['verify'=>true]);

Route::get('/home', 'HomeController@index')->name('home') ->middleware('verified');
Route::get('/home22/{id}', 'HomeController@index22')->name('home22') ->middleware('verified');
Route::get('/invoice', 'HomeController@invoice') ;
Route::get('/generate_pdf', 'HomeController@generate_pdf') ;
Route::get('/export', 'NewsController@export')->name('home2') ;


Route::get('fillable','CrudController@getOffers');


Route::group(['prefix' => 'offers'],function(){
   // Route::get('store','CrudController@store');




    Route::get('create','CrudController@create');
   Route::post('store','CrudController@store') ->name('offers.store');
   Route::post('nameconfirm','OffreController@nameconfirm') ->name('name.confirm');

   Route::get('edit/{offer_id}','CrudController@editOffer');
   Route::post('update/{offer_id}','CrudController@Updateoffer') ->name('offers.update');
   Route::get('delete/{offer_id}','CrudController@delete') ->name('offers.delete');

   Route::get('all','CrudController@getAllOffers') -> name('offers.all');

   Route::get('get-all-inactive-offer','CrudController@getAllInactiveOffers') ;
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

Route::get('hospitals','Relation\RelationsController@hospitals')-> name ('hospitals.all');




Route::get('doctors/{hospital_id}','Relation\RelationsController@doctors')-> name('hospital.doctors');



Route::get('hospitals/{hospital_id}','Relation\RelationsController@deleteHospital')-> name('hospital.delete');

Route::get('hospitals_has_doctors','Relation\RelationsController@hospitalsHasDoctor');

Route::get('hospitals_has_doctors_male','Relation\RelationsController@hospitalsHasOnlyMaleDoctors');

Route::get('hospitals_not_has_doctors','Relation\RelationsController@hospitalsNotHasDoctors');


Route::get('doctors/services/{doctor_id}','Relation\RelationsController@getDoctorServicesById')-> name('doctor.services');
Route::post('saveServices-to-doctor','Relation\RelationsController@saveServicesToDoctors')-> name('save.doctor.services');



##################### End one to many relationship #################




#################### Begin many to many routs ####################
Route::get('doctors-services','Relation\RelationsController@getDoctorServices');
Route::get('service-doctors','Relation\RelationsController@getServiceDoctors');
#################### End many to many routs ####################

#################### Begin has one  through  ####################

Route::get('has-one-through','Relation\RelationsController@getPatientDoctor');

Route::get('has-many-through','Relation\RelationsController@getCountryDoctor');


#################### End has one  through  ####################


################Begin accessors and  mutators #########


Route::get('accessors','Relation\RelationsController@getDoctors');//get data



################End  accessors and  mutators #########
