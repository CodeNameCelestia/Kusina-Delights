<?php
namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class RecipeViewerController extends Controller
{
    public function show($id)
    {
        // Fetch the recipe by ID with reviews (and optionally, user data)
        $recipe = Recipe::with('reviews.user')->findOrFail($id);
        
        // Return the Inertia response with the recipe data
        return Inertia::render('Webpages/ViewRecipe', [
            'recipe' => $recipe,
        ]);
    }
    
    public function getReviews($id)
    {
        $reviews = Review::where('recipe_id', $id)->get(); // Get reviews for the recipe
        return response()->json($reviews);
    }

    public function storeReview(Request $request, $id)
    {
        $validated = $request->validate([
            'review' => 'nullable|string',
            'rating' => 'required|integer|min:1|max:5', // Rating is required and should be between 1 and 5
        ]);
    
        // Ensure the user is authenticated and get the current user ID
        $user = Auth::user();
    
        // Check if the user has already reviewed this recipe
        if (Review::where('user_id', $user->id)->where('recipe_id', $id)->exists()) {
            return redirect()->back()->withErrors('You have already reviewed this recipe.');
        }
    
        // Create review
        $review = Review::create([
            'user_id' => $user->id,
            'recipe_id' => $id,
            'Star' => $validated['rating'],
            'Review' => $validated['review'] ?? null, // Review can be nullable
        ]);
    
        // Return the new review data as JSON for front-end updates
        return response()->json($review, 201);
    }
}
