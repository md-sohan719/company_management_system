<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Home\AboutController;
use App\Http\Controllers\Home\HomeSliderController;
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
    return view('frontend.index');
});

Route::get('/dashboard', function () {
    return view('backend.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Admin all Route
Route::controller(AdminController::class)->middleware('auth')->group(function () {
    Route::get('/logout', 'destroy')->name('admin.logout');
    Route::get('/admin/profile', 'profile')->name('admin.profile');
    Route::post('/admin/updateProfile', 'updateProfile')->name('admin.updateProfile');
    Route::get('/change/password', 'changePassword')->name('change.password');
    Route::post('/update/password', 'updatePassword')->name('update.password');
});

// Home Slide all Route
Route::controller(HomeSliderController::class)->middleware('auth')->group(function () {
    Route::get('/home/slide', 'HomeSlider')->name('home.slide');
    Route::post('/slider/update', 'UpdateSlide')->name('update.slider');
});

// Home Slide all Route
Route::controller(AboutController::class)->middleware('auth')->group(function () {
    Route::get('/about/page', 'AboutPage')->name('about.page');
    Route::post('/about/update', 'UpdateAbout')->name('update.about');
    Route::get('/home/about', 'HomeAbout')->name('home.about');
    Route::get('/about/multi/image', 'AboutMultiIMage')->name('about.multi.image');
    Route::post('/store/multi/image', 'StoreMultiIMage')->name('store.multi.image');
    Route::get('/all/multi/image', 'AllMultiIMage')->name('all.multi.image');
    Route::post('/update/multi/image', 'UpdateMultiIMage')->name('update.multi.image');
    Route::get('/delete/multi/image/{id}', 'DeleteMultiIMage')->name('delete.multi.image');
});

require __DIR__ . '/auth.php';
