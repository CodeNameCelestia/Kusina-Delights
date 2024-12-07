<template>
    <Layout>
        <!-- Background Image -->
        <div class="relative h-[362px]">
            <div class="absolute inset-0 bg-cover bg-center" :style="{ backgroundImage: 'url(\'/storage/' + recipe.RecipePhoto + '\')', filter: 'brightness(0.7)' }"></div>
            <div class="flex items-center justify-center h-full relative">
                <p class="text-white text-center px-4 text-large font-bold drop-shadow-xl white-shadow">
                    {{ recipe.RecipeTitle }}
                </p>
                <!-- View Count -->
                <div class="absolute bottom-4 right-4 text-white text-lg bg-black opacity-70 px-4 py-2 rounded-full">
                    Views: {{ viewCount }}
                </div>
            </div>
        </div>


        

        <!-- Recipe Details Section -->
        <div class="mx-auto text-left max-w-4xl my-4 text-small text-black-100 space-y-2">
            <!-- Ingredients -->
            <div>
                <p class="text-small font-bold">Ingredients</p>

                <ul class="list-disc pl-5">
                    <li v-for="(ingredient, index) in recipe.Ingredients.split('\n')" :key="index">
                        {{ ingredient.trim() }}
                    </li>
                </ul>
            </div>
            <br>
            <!-- Instructions -->
            <div>
                <p class="text-small font-bold">How To Prepare</p>
   
                <ol class="list-decimal pl-5 space-y-2">
                    <li v-for="(step, index) in recipe.Instructions.split('\n')" :key="index">
                        {{ step.trim() }}
                    </li>
                </ol>
            </div>
            <br>
            <!-- Additional Information -->
            <div>
                <p class="font-bold space-y-2">Additional Information:</p>
                <p><strong>Preparation Time:</strong> {{ recipe.Preparation || 'N/A' }} minutes</p>
                <p><strong>Cooking Time:</strong> {{ recipe.CookingTime || 'N/A' }} minutes</p>
                <p><strong>Difficulty:</strong> {{ recipe.Difficulty || 'N/A' }}</p>
                <p><strong>Servings:</strong> {{ recipe.Servings || 'N/A' }}</p>
            </div>
            <br>
            <!-- Description -->
            <div>
                <p class="font-bold">Description</p>
                <p>{{ recipe.Description }}</p>
            </div>
        </div>

        <!-- Reviews Section -->
        <div class="p-6 bg-gray-100 rounded-lg max-w-6xl mx-auto space-y-4 mt-8">
            <h2 class="text-2xl font-bold">Reviews</h2>

            <!-- Check if there are no reviews -->
            <div v-if="recipe.reviews.length === 0" class="bg-white p-4 text-center text-gray-600 font-semibold">
                No reviews yet.
            </div>

            <!-- Individual reviews will be dynamically added here -->
            <div v-else class="bg-gray-200 rounded-lg p-4 space-y-4">
                <div v-for="(review, index) in recipe.reviews" :key="index" class="bg-white rounded-lg p-4 flex justify-between items-start shadow-sm">
                    <div>
                        <p class="flex items-center text-gray-700 font-bold">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" class="text-gray-500">
                                <circle cx="12" cy="8" r="4" class="fill-current text-gray-600" />
                                <path d="M12 14c-4 0-6 2-6 3v1h12v-1c0-1-2-3-6-3z" class="fill-current text-gray-600" />
                            </svg>
                            {{ review.user.name || 'Anonymous' }}
                        </p>
                        <p class="text-gray-600 mt-1"><i>{{ review.Review }}</i></p>
                    </div>
                    <div class="flex items-center">
                        <!-- Stylish Star SVG icons with hover effect -->
                        <svg v-for="star in 5" :key="star" :class="{
                            'fill-yellow-500': review.Star >= star,
                            'fill-gray-300': review.Star < star,
                            'cursor-pointer': true,
                            'hover:fill-yellow-400': true,
                            'transition-colors': true
                        }" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                            <path :d="review.Star >= star ? 
                            'M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z' : 
                            'M12 15.4l3.76 2.28-1-4.17 3.27-2.84-4.28-.38L12 4.75l-1.75 5.68-4.28.38 3.27 2.84-1 4.17z'" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Add Review Section -->
            <h3 class="text-xl font-bold mt-6">Write a Review</h3>
            <div class="bg-gray-200 rounded-lg p-4 space-y-3">
                <textarea v-model="reviewText" placeholder="Review*" class="w-full p-3 bg-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-300 resize-none text-small"></textarea>

                <div class="flex items-center space-x-4">
                    <input type="text" v-model="username" placeholder="Username*" class="w-1/2 p-3 bg-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-300 text-small" />
                    <div class="flex items-center space-x-2">
                        <label class="text-gray-700 font-semibold">Rate</label>
                        <div class="flex items-center space-x-1 text-2xl">
                            <svg v-for="star in 5" :key="star" @click="setRating(star)" :class="{
                                'fill-yellow-500': rating >= star,
                                'fill-gray-300': rating < star,
                                'cursor-pointer': true,
                                'hover:fill-yellow-400': true,
                                'transition-colors': true
                            }" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                <path :d="rating >= star ? 
                                'M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z' : 
                                'M12 15.4l3.76 2.28-1-4.17 3.27-2.84-4.28-.38L12 4.75l-1.75 5.68-4.28.38 3.27 2.84-1 4.17z'" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="flex justify-start space-x-2 mt-4">
                    <button @click="submitReview" class="bg-green-400 text-white font-semibold py-2 px-36 rounded-2xl hover:bg-green-500 text-small">Submit Review</button>
                    <button class="bg-red-400 text-white font-semibold py-2 px-28 rounded-2xl hover:bg-red-500 text-small">Cancel</button>
                </div>
            </div>

        </div>
    </Layout>
</template>


<script>
import Layout from '../../Layouts/frontend.vue';

export default {
    components: {
        Layout,
    },
    props: {
        recipe: Object, // Received from the controller
        viewCount: Number, 
    },
    data() {
        return {
            rating: 0,
            reviewText: '', // Store the review text
            username: '', // Store the username if necessary (not used in backend for this case)
        };
    },
    mounted() {
        // Debugging: Check if view_count is received properly
        console.log("Received view count:", this.viewCount);
    },
    methods: {
        setRating(star) {
            this.rating = star;
        },
        async submitReview() {
            try {
                // Make the POST request to store the review
                const response = await axios.post(`/api/recipes/${this.recipe.RecipeID}/reviews`, {
                    rating: this.rating,
                    review: this.reviewText,
                });

                // Optionally, you can update the reviews list or show a success message here
                this.recipe.reviews.push(response.data); // Add the new review to the recipe's reviews
                this.reviewText = ''; // Reset review text
                this.rating = 0; // Reset rating
            } catch (error) {
                console.error('Error submitting review:', error);
            }
        },
    },
};


</script>

<style scoped>
/* Optional styling adjustments */
</style>
