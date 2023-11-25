<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return redirect()->route('posts.index');
})->middleware(['auth'])->name('dashboard');


Route::prefix('posts')->group(function () {
    Route::get('/', 'BlogPostController@index')->name('posts.index');
    Route::get('/create', 'BlogPostController@create')->name('posts.create');
    Route::get('/{id}', 'BlogPostController@show')->name('posts.show');
    Route::post('/store', 'BlogPostController@store')->name('posts.store');
    Route::get('/edit/{id}', 'BlogPostController@edit')->name('posts.edit');
    Route::put('/update/{id}', 'BlogPostController@update')->name('posts.update');
    Route::delete('/delete/{id}', 'BlogPostController@destroy')->name('posts.destroy');
});

require __DIR__.'/auth.php';
