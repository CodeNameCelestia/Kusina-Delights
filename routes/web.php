<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\RecipeViewerController;

use App\Http\Controllers\ReviewController;
use App\Models\Recipe;
use Illuminate\Support\Facades\Auth;

use Illuminate\Foundation\Application;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    $recipes = Recipe::withCount('reviews')
        ->withAvg('reviews', 'Star')
        ->take(3)
        ->get()
        ->map(function ($recipe) {
            return [
                'RecipeID' => $recipe->RecipeID,
                'RecipeTitle' => $recipe->RecipeTitle,
                'Description' => $recipe->Description,
                'RecipePhoto' => $recipe->RecipePhoto,
                'averageStars' => $recipe->reviews_avg_star,
                'reviewCount' => $recipe->reviews_count,
            ];
        });

    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
        'recipes' => $recipes,
        'auth' => ['user' => Auth::user()],
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('users', UserController::class);



Route::get('/storage/{file}', function ($file) {
    return response()->file(storage_path("app/public/{$file}"));
})->name('storage');


Route::resource('users', UserController::class);
Route::resource('recipes', RecipeController::class);
Route::resource('reviews', ReviewController::class);


Route::get('/1', [RecipeController::class, 'recipeFilter']);



Route::get('/2', function () {
    return Inertia::render('Webpages/AboutUs');  // Path relative to 'resources/js/Pages/'
});





Route::get('/3', function () {
    return Inertia::render('Webpages/sample');  // Path relative to 'resources/js/Pages/'
});

Route::get('api/recipes/{id}', [RecipeViewerController::class, 'show']);
Route::get('api/recipes/{id}/reviews', [RecipeViewerController::class, 'getReviews']);
Route::post('api/recipes/{id}/reviews', [RecipeViewerController::class, 'storeReview']);
Route::get('api/recipes', [RecipeController::class, 'search']);

Route::get('/1', [RecipeController::class, 'recipeFilter']);







require __DIR__.'/auth.php';