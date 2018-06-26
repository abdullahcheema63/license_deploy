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

Route::get('/', function () {
    return redirect()->route('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/licensee','LicenseeController')->middleware('auth');
Route::post('/licensee/{id}/assign-inspector','LicenseeController@assignInspector')->name('licensee.assign-inspector')->middleware('auth');

Route::resource('/inspector','InspectorController')->middleware('auth');
Route::get('/inspector/{id}/view-licensees','InspectorController@viewLicensees')->name('inspector.view-licensees')->middleware('auth');

