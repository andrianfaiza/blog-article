<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard', function () {
    if (auth()->user()->hasRole('admin')) {
        return redirect()->route('admin.dashboard');
    }

    if (auth()->user()->hasRole('editor')){
        return redirect()->route('editor.dashboard');
    }

    if (auth()->user()->hasRole('user')) {
        return redirect()->route('user.dashboard');
    }

    abort(403);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'role:admin|editor'])->group(function () {
    Route::resource('artikel', ArtikelController::class);
});

// Route admin
Route::middleware(['auth', 'role:admin'])->group(function (){
    Route::get('admin/artikel/create', [ArtikelController::class, 'create'])->name('admin.create');
    Route::get('admin/artikel/create', [ArtikelController::class, 'create'])->name('admin.edit');
    Route::get('admin/dashboard', [ArtikelController::class, 'indexAdmin'])->name('admin.dashboard');
    Route::get('admin/myarticle', [ArtikelController::class, 'adminArtikel'])->name('admin.myartikel');
    Route::get('admin/users', [ArtikelController::class, 'userTable'])->name('admin.usertable');
    Route::delete('/admin/users/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    Route::put('/admin/users/{user}/role', [ArtikelController::class, 'updateRoleSwitch'])->name('admin.updateRoleSwitch');
    Route::get('admin/myarticle', [ArtikelController::class, 'adminArtikel'])->name('artikel.myartikel');
});

// Route editor
Route::middleware(['auth', 'role:editor'])->group(function(){
    Route::get('editor/dashboard', [ArtikelController::class, 'indexEditor'])->name('editor.dashboard');
    Route::get('editor/myarticle', [ArtikelController::class, 'editorArtikel'])->name('editor.myartikel');
    Route::get('/editor/artikel/{id}', [ArtikelController::class, 'show'])->name('editor.show');
    Route::get('/editor/showartikel/{id}', [ArtikelController::class, 'showEditor'])->name('editor.showuser');
    });
    
// Route useer 
Route::middleware(['auth', 'role:user'])->group(function(){
    Route::get('/user/artikel/{id}', [ArtikelController::class, 'showUser'])->name('artikel.showuser');
    Route::get('user/dashboard', [ArtikelController::class, 'indexUser'])->name('user.dashboard');
    Route::put('/users/{user}/role', [ArtikelController::class, 'updateRole'])->name('users.updateRole');
});

require __DIR__.'/auth.php';
