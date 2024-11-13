<?php

use App\Http\Controllers\AppsController;
use App\Http\Controllers\MapUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('pages/home');
})->name('home');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/user-dashboard', function () {
        return view('pages/user-dashboard');
    })->name('user.dashboard');
    Route::get('/user/apps', [MapUserController::class, 'indexUser'])->name('user.apps');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware(['admin'])->group(function () {
        Route::get('/admin-dashboard', function () {
            return view('pages/admin-dashboard');
        })->name('admin.dashboard');
        Route::get('/admin/apps', [AppsController::class, 'index'])->name('admin.apps-read');
        Route::get('/admin/apps-search', [AppsController::class, 'search'])->name('admin.apps-search');
        Route::get('/admin/apps-create', [AppsController::class, 'create'])->name('admin.apps-create');
        Route::post('/admin/apps-store', [AppsController::class, 'store'])->name('admin.apps-store');
        Route::get('/admin/apps-edit/{id}', [AppsController::class, 'edit'])->name('admin.apps-edit');
        Route::patch('/admin/apps-update/{id}', [AppsController::class, 'update'])->name('admin.apps-update');
        Route::delete('/admin/apps-destroy/{id}', [AppsController::class, 'destroy'])->name('admin.apps-destroy');

        Route::get('/admin/user-app-view', [MapUserController::class, 'getUserAppView'])->name('admin.user-app-view');


        Route::get('/admin/map-apps-user', [MapUserController::class, 'index'])->name('admin.map-apps-user');
        Route::get('/admin/map-apps-user-search', [MapUserController::class, 'search'])->name('admin.map-apps-user-search');
        Route::get('/admin/map-apps-user-create', [MapUserController::class, 'create'])->name('admin.map-apps-user-create');
        Route::post('/admin/map-apps-user-store', [MapUserController::class, 'store'])->name('admin.map-apps-user-store');
        Route::get('/admin/map-apps-user-edit/{id}', [MapUserController::class, 'edit'])->name('admin.map-apps-user-edit');
        Route::patch('/admin/map-apps-user-update/{id}', [MapUserController::class, 'update'])->name('admin.map-apps-user-update');
        Route::delete('/admin/map-apps-user-destroy/{id}', [MapUserController::class, 'destroy'])->name('admin.map-apps-user-destroy');

        Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users-read');
        Route::get('/admin/users-search', [UserController::class, 'search'])->name('admin.users-search');
        Route::get('/admin/users-create', [UserController::class, 'create'])->name('admin.users-create');
        Route::post('/admin/users-store', [UserController::class, 'store'])->name('admin.users-store');
        Route::get('/admin/users-edit/{id}', [UserController::class, 'edit'])->name('admin.users-edit');
        Route::patch('/admin/users-update/{id}', [UserController::class, 'update'])->name('admin.users-update');
        Route::delete('/admin/users-destroy/{id}', [UserController::class, 'destroy'])->name('admin.users-destroy');



    });
});

require __DIR__.'/auth.php';
