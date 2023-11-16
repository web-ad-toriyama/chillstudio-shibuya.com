<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\NoticeController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\LogController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Category1Controller;
use App\Http\Controllers\Category2Controller;
use App\Http\Controllers\Category3Controller;
use App\Http\Controllers\Category4Controller;
use App\Http\Controllers\Category5Controller;
use App\Http\Controllers\Category6Controller;
use App\Http\Controllers\Category7Controller;
use App\Http\Controllers\Category8Controller;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\IndexController as OfficialIndexController;
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

// オフィシャル
Route::get(config('custom.page.index.url'), [OfficialIndexController::class, 'index'])->name(config('custom.page.index.route'));
Route::get(config('custom.page.category1.url'), [Category1Controller::class, 'index'])->name(config('custom.page.category1.route'));
Route::get(config('custom.page.category2.url'), [Category2Controller::class, 'index'])->name(config('custom.page.category2.route'));
Route::get(config('custom.page.category3.url'), [Category3Controller::class, 'index'])->name(config('custom.page.category3.route'));
Route::get(config('custom.page.category3.url').'/detail/{id}', [Category3Controller::class, 'detail'])->name(config('custom.page.category3.route').'.detail')->where('id', '[0-9]+');
Route::get(config('custom.page.category4.url'), [Category4Controller::class, 'index'])->name(config('custom.page.category4.route'));
Route::get(config('custom.page.category5.url'), [Category5Controller::class, 'index'])->name(config('custom.page.category5.route'));
//Route::get(config('custom.page.category6.url'), [Category6Controller::class, 'index'])->name(config('custom.page.category6.route'));
//Route::get(config('custom.page.category6.url').'/detail/{id}', [Category6Controller::class, 'detail'])->name(config('custom.page.category6.route').'.detail')->where('id', '[0-9]+');
Route::get(config('custom.page.category7.url'), [Category7Controller::class, 'index'])->name(config('custom.page.category7.route'));
Route::get(config('custom.page.category8.url'), [Category8Controller::class, 'index'])->name(config('custom.page.category8.route'));
Route::get(config('custom.page.contact.url'), [ContactController::class, 'index'])->name(config('custom.page.contact.route'));
Route::post(config('custom.page.contact_confirm.url'), [ContactController::class, 'confirm'])->name(config('custom.page.contact_confirm.route'));
Route::post(config('custom.page.contact_send.url'), [ContactController::class, 'send'])->name(config('custom.page.contact_send.route'));
Route::get(config('custom.page.contact_confirm.url'), [ContactController::class, 'error']);
Route::get(config('custom.page.contact_send.url'), [ContactController::class, 'error']);


// 認証
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'postLogin']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// 管理画面
Route::name('wb-admin.')->prefix('wb-admin')->middleware('auth')->group(function () {
    Route::get('/', [IndexController::class, 'index'])->name('dashboard');
    // 運営部からのお知らせ
    Route::get('/notice', [NoticeController::class, 'index'])->name('notice.index');
    // 投稿機能
    Route::get('/post', [PostController::class, 'index'])->name('post.index');
    Route::post('/post', [PostController::class, 'postIndex']);
    Route::get('/post/add', [PostController::class, 'add'])->name('post.add');
    Route::post('/post/add', [PostController::class, 'postAdd']);
    Route::get('/post/edit/{id}', [PostController::class, 'edit'])->name('post.edit');
    Route::post('/post/edit/{id}', [PostController::class, 'postEdit']);
    Route::get('/post/display/{id}', [PostController::class, 'display'])->name('post.display');
    // お知らせ機能
    Route::get('/news', [NewsController::class, 'index'])->name('news.index');
    Route::post('/news', [NewsController::class, 'postIndex']);
    Route::get('/news/add', [NewsController::class, 'add'])->name('news.add');
    Route::post('/news/add', [NewsController::class, 'postAdd']);
    Route::get('/news/edit/{id}', [NewsController::class, 'edit'])->name('news.edit');
    Route::post('/news/edit/{id}', [NewsController::class, 'postEdit']);
    Route::get('/news/display/{id}', [NewsController::class, 'display'])->name('news.display');
    // 基本情報設定
    Route::get('/company', [CompanyController::class, 'index'])->name('company.index');
    Route::get('/company/edit', [CompanyController::class, 'edit'])->name('company.edit');
    Route::post('/company/edit', [CompanyController::class, 'postEdit']);
    // ページ情報設定
    Route::get('/page', [PageController::class, 'index'])->name('page.index');
    Route::post('/page/edits', [PageController::class, 'postIndex'])->name('page.postIndex');
    Route::get('/page/edit/{id?}', [PageController::class, 'edit'])->name('page.edit');
    Route::post('/page/edit/{id?}', [PageController::class, 'postEdit'])->name('page.postEdit');
    Route::get('/page/edits', [PageController::class, 'error']);
    // 基本情報設定
    Route::get('/contact', [AdminContactController::class, 'index'])->name('contact.index');
    Route::post('/contact', [AdminContactController::class, 'postIndex']);
    Route::get('/contact/add', [AdminContactController::class, 'add'])->name('contact.add');
    Route::post('/contact/add', [AdminContactController::class, 'postAdd'])->name('contact.postAdd');
    Route::get('/contact/edit/{id}', [AdminContactController::class, 'edit'])->name('contact.edit');
    Route::post('/contact/edit/{id}', [AdminContactController::class, 'postEdit'])->name('contact.postEdit');
    Route::get('/contact/display/{id}', [AdminContactController::class, 'display'])->name('contact.display');
    Route::get('/contact/sort', [AdminContactController::class, 'sort'])->name('contact.sort');
    Route::post('/contact/sort', [AdminContactController::class, 'postSort']);
    // お問合せログ
    Route::get('/log', [LogController::class, 'index'])->name('log.index');
});

// ファイルマネージャー
// Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
