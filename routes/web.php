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

Route::get('appoint/inertia/users/index/{permalink}', [App\Http\Controllers\UserController::class, 'index'])
->name('appoint.inertiaIndex');

Route::post('appoint/inertia/users/index/confirm/{permalink}', [App\Http\Controllers\UserController::class, 'confirm'])
->name('appoint.inertiaConfirm');

Route::post('appoint/inertia/users/index/set/{permalink}', [App\Http\Controllers\UserController::class, 'set'])
->name('appoint.inertiaSet');

Route::post('appoint/inertia/users/index/deleteconf/{permalink}', [App\Http\Controllers\UserController::class, 'deleteconf'])
->name('appoint.inertiaDeleteconf');

Route::post('appoint/inertia/users/index/delete/{permalink}', [App\Http\Controllers\UserController::class, 'delete'])
->name('appoint.inertiaDelete');

Route::post('appoint/inertia/users/index/filter/{permalink}', [App\Http\Controllers\UserController::class, 'filter'])
->name('appoint.inertiaFilterAppoint');




//admin
Route::get('appoint/inertia/admins', [App\Http\Controllers\AdminController::class, 'adminlink'])
->name('admin.inertialink');

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


//ログアウト

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
