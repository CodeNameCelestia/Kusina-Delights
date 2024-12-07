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
})->name('home');




#Storage
Route::get('/storage/{file}', function ($file) {
    return response()->file(storage_path("app/public/{$file}"));
})->name('storage');


# Crud for admin and backend shiz
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::resource('users', UserController::class);
Route::resource('recipes', RecipeController::class);
Route::resource('reviews', ReviewController::class);


# Views and filters for front end
Route::get('/allrecipes', [RecipeController::class, 'recipeFilter']);
Route::get('/aboutus', function () {
    return Inertia::render('Webpages/AboutUs');  // Path relative to 'resources/js/Pages/'
});
Route::get('api/recipes/{id}', [RecipeViewerController::class, 'show']);
Route::get('api/recipes/{id}/reviews', [RecipeViewerController::class, 'getReviews']);
Route::post('api/recipes/{id}/reviews', [RecipeViewerController::class, 'storeReview']);
Route::get('api/recipes', [RecipeController::class, 'search']);




Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
Route::post('/update-introduction', [ProfileController::class, 'updateIntroduction'])->name('update.introduction');




#Samples
Route::get('/1', function () {
    return Inertia::render('Chef/Profile');  // Path relative to 'resources/js/Pages/'
});

Route::get('/2', function () {
    return Inertia::render('Chef/Profile_edit');  // Path relative to 'resources/js/Pages/'
});

Route::get('/3', function () {
    return Inertia::render('Chef/Dashboard');  // Path relative to 'resources/js/Pages/'
});

Route::get('/4', function () {
    return Inertia::render('Chef/Create_post');  // Path relative to 'resources/js/Pages/'
});


require __DIR__.'/auth.php';