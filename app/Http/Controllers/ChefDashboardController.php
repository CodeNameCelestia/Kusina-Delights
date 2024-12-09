<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;

use App\Models\Chef;
use App\Models\Recipe;
use App\Models\Review;
use App\Models\RecipeView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ChefDashboardController extends Controller
{
    public function index()
    {
        $chef = Auth::user()->chef;
        $profile = $chef->user->profile ?? null;
        
        Log::debug('Profile:', ['profile' => $profile]);
        
        if (!$profile) {
            return abort(404, 'Profile not found');
        }
        
        $recipes = $chef->recipes;
        
        foreach ($recipes as $recipe) {
            $recipe->average_rating = $recipe->reviews()->avg('Star');
            $recipe->formatted_date = $recipe->created_at->format('F j, Y');
        }
        
        $totalViews = RecipeView::whereIn('recipe_id', $recipes->pluck('RecipeID'))->count();
        $totalIncome = $chef->Income;
        
        return inertia('Chef/Dashboard', [
            'chef' => $chef,
            'profile' => ['profile' => $profile, 'user' => $chef->user],
            'recipes' => $recipes,
            'totalViews' => $totalViews,
            'totalIncome' => $totalIncome,
        ]);
    }

    public function create()
    {
        return inertia('Chef/Create_post');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'RecipeTitle' => 'required|string|max:255',
            'Description' => 'nullable|string',
            'Ingredients' => 'nullable|string',
            'RecipePhoto' => 'nullable|image|max:10240',
            'Preparation' => 'nullable|integer',
            'CookingTime' => 'nullable|integer',
            'Difficulty' => 'nullable|string',
            'Servings' => 'nullable|integer',
        ]);
    
        $chef = Auth::user()->chef;
    
        if (!$chef) {
            return response()->json(['message' => 'Chef not found'], 403);
        }
    
        $recipe = new Recipe();
        $recipe->chef_id = $chef->ChefID;
        $recipe->RecipeTitle = $validated['RecipeTitle'];
        $recipe->Description = $validated['Description'];
        $recipe->Ingredients = $validated['Ingredients'];
        $recipe->VideoLink = $request->VideoLink;
        $recipe->Instructions = $request->Instructions;
        $recipe->Preparation = $request->Preparation;
        $recipe->CookingTime = $request->CookingTime;
        $recipe->Difficulty = $request->Difficulty;
        $recipe->Servings = $request->Servings;
    
        if ($request->hasFile('RecipePhoto')) {
            $path = $request->file('RecipePhoto')->store('recipes', 'public');
            $recipe->RecipePhoto = $path;
        }
    
        $recipe->save();
    
        return response()->json(['message' => 'Recipe created successfully']);
    }

    public function edit($id)
    {
        $chef = Auth::user()->chef;
        $recipe = Recipe::where('chef_id', $chef->ChefID)->findOrFail($id);
    
        return inertia('Chef/Edit_post', [
            'recipe' => $recipe,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'RecipeTitle' => 'required|string|max:255',
            'Description' => 'nullable|string',
            'Ingredients' => 'nullable|string',
            'RecipePhoto' => 'nullable|image|max:10240',
            'Preparation' => 'nullable|integer',
            'CookingTime' => 'nullable|integer',
            'Difficulty' => 'nullable|string',
            'Servings' => 'nullable|integer',
        ]);
        
        $chef = Auth::user()->chef;
        
        if (!$chef) {
            return response()->json(['message' => 'Chef not found'], 403);
        }
        
        $recipe = Recipe::find($id);
        
        if (!$recipe) {
            return response()->json(['message' => 'Recipe not found'], 404);
        }
    
        if ($recipe->chef_id !== $chef->ChefID) {
            return response()->json(['message' => 'Unauthorized to update this recipe'], 403);
        }
    
        $recipe->RecipeTitle = $validated['RecipeTitle'];
        $recipe->Description = $validated['Description'];
        $recipe->Ingredients = $validated['Ingredients'];
        $recipe->VideoLink = $request->VideoLink;
        $recipe->Instructions = $request->Instructions;
        $recipe->Preparation = $request->Preparation;
        $recipe->CookingTime = $request->CookingTime;
        $recipe->Difficulty = $request->Difficulty;
        $recipe->Servings = $request->Servings;
    
        if ($request->hasFile('RecipePhoto')) {
            if ($recipe->RecipePhoto) {
                Storage::disk('public')->delete($recipe->RecipePhoto);
            }
            $path = $request->file('RecipePhoto')->store('recipes', 'public');
            $recipe->RecipePhoto = $path;
        }
    
        $recipe->save();
        
        return response()->json(['message' => 'Recipe updated successfully']);
    }

    public function destroy($id)
    {
        try {
            // Fetch the chef and the recipe they own
            $chef = Auth::user()->chef;
            $recipe = Recipe::where('chef_id', $chef->ChefID)->findOrFail($id);
            
            // Log the recipe information
            Log::info("Attempting to delete recipe with ID: $id", ['recipe' => $recipe]);
    
            // Delete associated image file from storage
            if ($recipe->RecipePhoto) {
                Log::info("Deleting recipe photo: " . $recipe->RecipePhoto);
                Storage::disk('public')->delete($recipe->RecipePhoto);
            }
    
            // Delete the recipe
            $recipe->delete();
            
            // Log success message
            Log::info("Recipe with ID: $id deleted successfully.");
    
            return response()->json(['message' => 'Recipe deleted successfully']);
        } catch (\Exception $e) {
            // Log error if something goes wrong
            Log::error("Error deleting recipe with ID: $id", ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Failed to delete recipe'], 500);
        }
    }

    public function showAllRecipes()
{
    $chef = Auth::user()->chef;
    
    // Fetch recipes associated with the chef
    $recipes = $chef->recipes;
    
    // Fetch additional data if necessary, such as average rating for each recipe
    foreach ($recipes as $recipe) {
        $recipe->average_rating = $recipe->reviews()->avg('Star');
        $recipe->formatted_date = $recipe->created_at->format('F j, Y');
    }

    return inertia('Chef/AllRecipes', [
        'chef' => $chef,
        'recipes' => $recipes,
    ]);
}

}
