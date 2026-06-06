<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
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
    Route::resource('articles', ArticleController::class);
});

// Route admin
Route::middleware(['auth', 'role:admin'])->group(function (){
    Route::get('admin/articles/create', [ArticleController::class, 'create'])->name('admin.create');
    Route::get('admin/articles/create', [ArticleController::class, 'create'])->name('admin.edit');
    Route::get('admin/dashboard', [ArticleController::class, 'indexAdmin'])->name('admin.dashboard');
    Route::get('admin/myarticles', [ArticleController::class, 'adminArtikel'])->name('admin.myarticles');
    Route::get('admin/users', [ArticleController::class, 'userTable'])->name('admin.usertable');
    Route::delete('/admin/users/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    Route::put('/admin/users/{user}/role', [ArticleController::class, 'updateRoleSwitch'])->name('admin.updateRoleSwitch');
    Route::get('admin/myarticles', [ArticleController::class, 'adminArtikel'])->name('articles.myarticles');
});

// Route editor
Route::middleware(['auth', 'role:editor'])->group(function(){
    Route::get('editor/dashboard', [ArticleController::class, 'indexEditor'])->name('editor.dashboard');
    Route::get('editor/myarticles', [ArticleController::class, 'editorArtikel'])->name('editor.myarticles');
    Route::get('/editor/articles/{id}', [ArticleController::class, 'show'])->name('editor.show');
    Route::get('/editor/showarticle/{id}', [ArticleController::class, 'showEditor'])->name('editor.showuser');
    });
    
// Route useer 
Route::middleware(['auth', 'role:user'])->group(function(){
    Route::get('/user/articles/{id}', [ArticleController::class, 'showUser'])->name('articles.showuser');
    Route::get('user/dashboard', [ArticleController::class, 'indexUser'])->name('user.dashboard');
    Route::put('/users/{user}/role', [ArticleController::class, 'updateRole'])->name('users.updateRole');
});

require __DIR__.'/auth.php';
