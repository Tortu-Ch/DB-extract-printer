<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes();


Route::group(['middleware' => 'auth', 'prefix' => '/'], function () {
    Route::get('', 'HomeController@index')->name('index');
    Route::get('/dashboard', [HomeController::class, 'index']);
    Route::resource('database', 'User\DatabaseController');
    Route::get('printer/{ids}/{paperId}', 'User\PrinterController@index')->name('printer');
});

Route::group(['middleware' => ['role:admin']], function() {
    Route::resources([
        'permissions' => 'Admin\PermissionController',
        'roles' => 'Admin\RoleController',
        'users' => 'Admin\UserController'
    ]);
});
