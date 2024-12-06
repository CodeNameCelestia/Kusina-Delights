<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Log;


use App\Models\UserProfile;

use App\Models\Review;



class ProfileController extends Controller
{


    public function show()
    {
        $user = Auth::user();
        $profile = $user->profile; // Assuming a relationship exists: User -> Profile
        $reviews = Review::with('recipe')
            ->where('user_id', $user->id)
            ->latest()
            ->get();
    
        return Inertia::render('Chef/Profile', [
            'user' => [
                'name' => $user->name,
                'email' => $user->email,
                'date_joined' => $user->created_at->format('F j, Y'),
                'ProfileImage' => $profile->ProfileImage, // Assuming ProfileImage stores the path
            ],
            'profile' => [
                'introduction' => $profile->Introduction ?? 'No introduction set yet',
            ],
            'reviews' => $reviews->isEmpty()
                ? 'No reviewed recipe yet.'
                : $reviews->map(fn($review) => [
                    'title' => $review->recipe->RecipeTitle,
                    'stars' => $review->Star,
                    'comment' => $review->Review,
                    'RecipePhoto' => $review->recipe->RecipePhoto, // Assuming RecipePhoto stores the path
                    'recipe_id' => $review->recipe_id, // Add the recipe_id for each review
                ]),
        ]);
    }
    
    public function updateIntroduction(Request $request)
    {
        // Get the authenticated user
        $user = Auth::user();
        
        // Ensure the profile exists for the user (using the user's id)
        $profile = UserProfile::where('user_id', $user->id)->first();
        Log::info('Profile:', ['profile' => $profile]);
    
        // If the profile exists, update the Introduction
        if ($profile) {
            $profile->update([
                'Introduction' => $request->introduction ?: 'No introduction set yet',
            ]);
    
            return response()->json(['message' => 'Introduction updated successfully!']);
        }
        
        // If no profile exists, you can either create one or return an error
        return response()->json(['message' => 'Profile not found.'], 404);
    }
    
    
    
    
    

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
