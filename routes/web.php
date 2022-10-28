<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/auth', [MainController::class, 'auth'])->name('auth');

Auth::routes();

Route::get('/admin', [AdminController::class, 'index'])->name('admin');

// subjects
Route::get('/subjects', [AdminController::class, 'indexSubject'])->name('subject-index');
Route::post('/subjects', [AdminController::class, 'storeSubject'])->name('subject-store');
Route::post('/subjects/destroy', [AdminController::class, 'destroySubject'])->name('subject-destroy');
// Route::get('/subjects/view', [AdminController::class, 'viewSubject'])->name('subject-index');

// classes
Route::get('/classes', [AdminController::class, 'indexClass'])->name('class-index');
Route::post('/classes', [AdminController::class, 'storeClass'])->name('class-store');
Route::post('/classes/destroy', [AdminController::class, 'destroyClass'])->name('class-destroy');
// Route::get('/classes/view', [AdminController::class, 'viewClass'])->name('class-index');

// tags
Route::get('/tags', [AdminController::class, 'indexTag'])->name('tag-index');
Route::post('/tags', [AdminController::class, 'storeTag'])->name('tag-store');
Route::post('/tags/destroy', [AdminController::class, 'destroyTag'])->name('tag-destroy');
// Route::get('/tags/view', [AdminController::class, 'viewTag'])->name('tag-index');

// resources
Route::get('/resources/all', [AdminController::class, 'indexResource'])->name('resource-index');
Route::post('/resources/store', [AdminController::class, 'storeResource'])->name('resource-store');
Route::post('/resources/update/{id}', [AdminController::class, 'updateResource'])->name('resource-update');
Route::post('/resources/destroy', [AdminController::class, 'destroyResource'])->name('resource-destroy');




/**
 * Front end routes start from here
 */
// buying
Route::post('purchase', [MainController::class, 'purchaseFile'])->name('purchase-file');

//url after a purchase
Route::get('success', [MainController::class, 'afterPurchase'])->name('after-file');

Route::get('contact', [MainController::class, 'openContactPage'])->name('contact');
Route::get('about-us', [MainController::class, 'openAboutPage'])->name('about');

// open resource details
Route::get('file/{slug}', [MainController::class, 'viewFile'])->name('view-file');
// retrieve on condition
Route::get('{keyword}/{slug}', [MainController::class, 'allResources'])->name('all-resources');
// search results
Route::get('search', [MainController::class, 'searchResource'])->name('search');

// download file for free
Route::get('{slug}', [MainController::class, 'downloadFile'])->name('download-file');

//url after a purchase
Route::get('file/{slug}/success/{token}', [MainController::class, 'afterPurchase'])->name('after-purchase');

// verify code
Route::post('verify-code', [MainController::class, 'verifyCode'])->name('verify-code');

// logout
Route::get('logout', function (Request $request)
{
    Session::flush();

    Auth::logout();

    return redirect()->route('home');
})->name('log-out');
