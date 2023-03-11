<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Home\AboutController;
use App\Http\Controllers\Home\BlogCategoryController;
use App\Http\Controllers\Home\BlogController;
use App\Http\Controllers\Home\ContactController;
use App\Http\Controllers\Home\FooterController;
use App\Http\Controllers\Home\HomeSliderController;
use App\Http\Controllers\Home\PortfolioController;
use App\Models\Portfolio;
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
    Route::get('/about/multi/image', 'AboutMultiIMage')->name('about.multi.image');
    Route::post('/store/multi/image', 'StoreMultiIMage')->name('store.multi.image');
    Route::get('/all/multi/image', 'AllMultiIMage')->name('all.multi.image');
    Route::post('/update/multi/image', 'UpdateMultiIMage')->name('update.multi.image');
    Route::get('/delete/multi/image/{id}', 'DeleteMultiIMage')->name('delete.multi.image');
});

// Home Slide frontend all Route
Route::controller(AboutController::class)->group(function () {
    Route::get('/home/about', 'HomeAbout')->name('home.about');
});

// portfolio all Route
Route::controller(PortfolioController::class)->middleware('auth')->group(function () {
    Route::get('/all/portfolio', 'AllPortfolio')->name('all.portfolio');
    Route::get('/add/portfolio', 'AddPortfolio')->name('add.portfolio');
    Route::post('/store/portfolio', 'StorePortfolio')->name('store.portfolio');
    Route::get('/edit/portfolio/{id}', 'EditPortfolio')->name('edit.portfolio');
    Route::post('/update/portfolio', 'UpdatePortfolio')->name('update.portfolio');
    Route::get('/delete/portfolio/{id}', 'DeletePortfolio')->name('delete.portfolio');
});

// portfolio frontend all Route
Route::controller(PortfolioController::class)->group(function () {
    Route::get('/portfolio/details/{id}', 'PortfolioDetails')->name('portfolio.details');
});

// blog category all Route
Route::controller(BlogCategoryController::class)->middleware('auth')->group(function () {
    Route::get('/all/blog/category', 'AllBlogCategory')->name('all.blog.category');
    Route::post('/store/blog/category', 'StoreBlogCategory')->name('store.blog.category');
    Route::get('/delete/blog/category/{id}', 'DeleteBlogCategory')->name('delete.blog.category');
    Route::post('/update/blog/category', 'UpdateBlogCategory')->name('update.blog.category');
});

// blog all Route
Route::controller(BlogController::class)->middleware('auth')->group(function () {
    Route::get('/all/blog', 'AllBlog')->name('all.blog');
    Route::get('/add/blog', 'AddBlog')->name('add.blog');
    Route::post('/store/blog', 'StoreBlog')->name('store.blog');
    Route::get('/edit/blog/{id}', 'EditBlog')->name('edit.blog');
    Route::post('/update/blog', 'UpdateBlog')->name('update.blog');
    Route::get('/delete/blog/{id}', 'DeleteBlog')->name('delete.blog');
});

// blog frontend all Route
Route::controller(BlogController::class)->group(function () {
    Route::get('/blog/details/{id}', 'BlogDetails')->name('blog.details');
    Route::get('/category/blog/{id}', 'CategoryBlog')->name('category.blog');
    Route::get('/blog', 'HomeBlog')->name('home.blog');
});

// footer all Route
Route::controller(FooterController::class)->middleware('auth')->group(function () {
    Route::get('/footer/setup', 'FooterSetup')->name('footer.setup');
    Route::post('/update/footer', 'UpdateFooter')->name('update.footer');
});

// contact all Route
Route::controller(ContactController::class)->group(function () {
    Route::get('/contact', 'Contact')->name('contact.me');
    Route::post('/store/message', 'StoreMessage')->name('store.message');
});

// contact all Route
Route::controller(ContactController::class)->middleware('auth')->group(function () {
    Route::get('/contact/message', 'ContactMessage')->name('contact.message');
    Route::get('/delete/message/{id}', 'DeleteMessage')->name('delete.message');
});

require __DIR__ . '/auth.php';
