<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
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

Route::get('/', [ArticleController::class, 'list'])
    ->middleware('auth');
Route::get('/articles', [ArticleController::class, 'getAllArticles'])
    ->middleware('auth');
Route::post('/delete-article/{articleId}', [ArticleController::class, 'deleteArticle'])
    ->name('delete')
    ->middleware('auth');
