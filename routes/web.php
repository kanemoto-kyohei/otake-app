<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
//top
Route::get('appoint/inertia/top', function () {
    return Inertia::render('Top',[
    ]);
})->name('top');
//user
//ルーティングは完全修飾でかく。ここのメソッドを指定したいときは配列の二番目に書く
Route::get('appoint/inertia/users', [App\Http\Controllers\UserController::class, 'link']);

Route::post('appoint/inertia/users/linkconfirm', [App\Http\Controllers\UserController::class, 'linkconfirm'])
->name('appoint.inertiaLinkconfirm');

Route::get('appoint/inertia/users/index/{user_permalink}', [App\Http\Controllers\UserController::class, 'index'])
->name('appoint.inertiaIndex');

Route::post('appoint/inertia/users/index/confirm', [App\Http\Controllers\UserController::class, 'confirm'])
->name('appoint.inertiaConfirm');

Route::post('appoint/inertia/users/index/set', [App\Http\Controllers\UserController::class, 'set'])
->name('appoint.inertiaSet');

Route::post('appoint/inertia/users/index/deleteconf', [App\Http\Controllers\UserController::class, 'deleteconf'])
->name('appoint.inertiaDeleteconf');

Route::post('appoint/inertia/users/index/delete', [App\Http\Controllers\UserController::class, 'delete'])
->name('appoint.inertiaDelete');



//admin
Route::get('appoint/inertia/admins', [App\Http\Controllers\AdminController::class, 'adminlink']);

Route::post('appoint/inertia/linkset', [App\Http\Controllers\AdminController::class, 'linkset'])
->name('admin.inertiaLink');

Route::post('appoint/inertia/save', [App\Http\Controllers\AdminController::class, 'save'])
->name('admin.inertiaSave');

Route::get('appoint/inertia/admin/index/{permalink}', [App\Http\Controllers\AdminController::class, 'adminindex'])
->name('admin.inertiaIndex');

Route::post('appoint/inertia/admin/index/reset', [App\Http\Controllers\AdminController::class, 'reset'])
->name('admin.inertiaReset');


//user
Route::get('/', function () {
    return Inertia::render('MyTop', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});



Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
//以下top画面
Route::get('appoint/top', function () {
    return view('appoint.top');
})->name('appoint.top');

//ユーザ画面
Route::post('/appoint', \App\Http\Controllers\Appoint\LinkController::class)
->name('appoint.link');

Route::post('/appoint/link', \App\Http\Controllers\Appoint\LinkConfirmController::class)
->name('appoint.linkconfirm');

Route::get('/appoint/{user_permalink}', \App\Http\Controllers\Appoint\IndexController::class)
->name('appoint.index');

Route::post('/appoint/confirm/{user_permalink}', \App\Http\Controllers\Appoint\ConfirmController::class)
->name('confirm.index');

Route::post('/appoint/set/{user_permalink}', \App\Http\Controllers\Appoint\SetController::class)
->name('set.index');

Route::post('/appoint/deleteconf/{user_permalink}/{appointId}', \App\Http\Controllers\Appoint\DeleteConfController::class)
->name('deleteconf.index');

Route::delete('/appoint/delete/{user_permalink}', \App\Http\Controllers\Appoint\DeleteController::class)
->name('delete.index');


//以下管理者のルート
Route::post('/appoint/admin/link', function () {
    return view('admin.link');
})->name('admin.link');

Route::post('/appoint/admin/linkset', \App\Http\Controllers\Admin\LinkSetController::class)
->name('admin.linkset');

Route::post('/appoint/admin/save/{permalink}', \App\Http\Controllers\Admin\SettingSaveController::class)
->name('admin.save');

Route::post('/appoint/admin/reset/{permalink}', \App\Http\Controllers\Admin\ResetController::class)
->name('admin.reset');

Route::get('/appoint/admin/{permalink}', \App\Http\Controllers\Admin\AdminIndexController::class)
->name('admin.index');

Route::get('/appoint/admin/dash/{permalink}', \App\Http\Controllers\Admin\AdminController::class)
->name('admin.dashboard');

//ログアウト
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
