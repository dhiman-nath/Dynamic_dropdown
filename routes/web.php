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

use App\Http\Controllers\CountryController;
// use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', function () {
    return view('dashboard');
});

Route::resource('employees', 'EmployeeController');



Route::get('/verify', 'PhoneVerifyController@verify');
Route::post('/verify', 'PhoneVerifyController@verifySubmit')->name('verify.submit');

Route::get('/home', 'HomeController@index')->name('home')->middleware('mobile');

Route::get('/auth/verify', function () {
    return view('auth/verify');
})->name('auth.verify');

Route::get('/master','AdminController@index');

// Route::get('/dropdown', function () {
//     return view('Dropdown.index');
// });

Route::get('/dropdown', 'CountryController@index');
Route::get('/getCities/{id}', 'CountryController@getCities')->name('getCities');
Route::get('/getAreas/{id}', 'CountryController@getAreas')->name('getAreas');