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

//php artisan rout:list = ukaze vsetky zaregistrovane routy

Route::get('/','PagesController@home');
 
Route::resource('provozna','ProvoznaController'); //->middleware('can:update,provozna');

Route::resource('nabidka','NabidkaController');

Route::resource('polozka','PolozkaController');

//Aby editovanie nabidky smerovalo na dovre miesto, ak chceme editovat
//nabidku tak v realite musime updateovat obsah nabidka_polozka
//teda spojit/rozpojit nabidky s polozkami 
Route::patch('nabidka_polozka','NabidkaPolozkaController@update');
Route::resource('nabidka_polozka','NabidkaPolozkaController');


Route::post('objednavka/create','ObjednavkaController@create');
Route::resource('objednavka','ObjednavkaController');

Route::patch('objednavka_polozka','ObjednavkaPolozkaController@update');
Route::resource('objednavka_polozka','ObjednavkaPolozkaController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/', 'HomeController@index')->name('home');
Route::resource('users','UserController');

Route::get('/plan','ObjednavkaController@plan');
Route::post('/stav','ObjednavkaController@stav');

Route::post('/show_status', "ObjednavkaController@show_status");
