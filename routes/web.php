<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ArticleStatusController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::get("/", HomeController::class)->name("home");

// Route::get("/categories", [CategoryController::class, "index"])->name('categories.index');
// Route::get('/categories/create', [CategoryController::class, "create"])->name('categories.create');
// Route::post('/categories', [CategoryController::class, "store"])->name("categories.store");
// Route::get('/categories/{category}/edit', [CategoryController::class, "edit"])->name("categories.edit");
// Route::put('/categories/{category}', [CategoryController::class, "update"])->name("categories.update");
// Route::delete("/categories/{category}", [CategoryController::class, "destroy"])->name("categories.destroy");
// Route::get("/categories/{category}", [CategoryController::class, "show"])->name("categories.show");
Route::controller(ArticleController::class)->group(function () {
    Route::get("/articles/table", 'table')->name('articles.table');
    Route::put('/articles/{article}/update-status', 'updateStatus')->name('articles.update-status');
});

Route::middleware('auth')->group(function () {
    Route::controller(CommentController::class)->group(function () {
        Route::post("/comments/{article}", 'store')->name('comments.store');
        Route::delete('/comments/{comment}', 'destroy')->name("comments.delete");
    });

    Route::controller(LikeController::class)->group(function () {
        Route::post("/like-comments/{comment}", 'likeComments')->name("comments.like");
        Route::post("/like-articles/{article}", 'likeArticles')->name("articles.like");
    });
});


Route::resource('categories', CategoryController::class);
Route::resource("tags", TagController::class);
Route::resource('articles', ArticleController::class);

require __DIR__ . "/auth.php";

Route::controller(UserController::class)->group(function () {
    Route::get("/users", 'index')->name("users.index");
    Route::get("/{user}", "show")->name("users.show");
    Route::get("/edit/{user}", "edit")->name("users.edit");
    Route::put("/{user}", "update")->name("users.update");
});

Route::controller(ChangePasswordController::class)->group(function () {
    Route::get("/account/password-edit", [ChangePasswordController::class, 'edit'])->name('change-password.edit');
    Route::put("/account/password-edit", [ChangePasswordController::class, 'update'])->name('change-password');
})->middleware('auth');

Route::post("/roles/assign/{user}", [RoleController::class, 'assign'])
    ->middleware(['auth', 'verified', 'only.admin'])->name("roles.assign");
