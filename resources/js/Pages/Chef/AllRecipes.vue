<template>
    <Layout>
      <div class="relative h-[998px] overflow-hidden">
        <!-- Wrapper for the blurred background with padding to avoid blurred borders -->
        <div class="absolute inset-0 -m-[20px]">
          <div
            class="absolute inset-0 bg-cover bg-center"
            style="background-image: url('https://c.animaapp.com/9OBfntRB/img/sheelah-brennan-uaevmc51ttw-unsplash-1.png'); filter: brightness(0.3) blur(20px);"
          ></div>
        </div>
  
        <!-- Main content -->
        <div class="flex items-center justify-center h-full relative">
          <div class="bg-white w-[200vh] p-12 rounded-3xl shadow-2xl">
            <h1 class="text-center text-large font-bold mb-10">All Recipes</h1>
  
            <!-- Recipes List -->
            <div class="flex flex-col gap-8 w-full">
              <ul class="space-y-8">
                <li v-if="recipes.length === 0" class="text-sm text-black-100">No recipes found.</li>
                <li v-else v-for="(recipe, index) in recipes" :key="index" class="flex items-start gap-6 transition-transform transform hover:scale-105">
                  <img
                    :src="recipe.RecipePhoto ? `/storage/${recipe.RecipePhoto}` : 'https://via.placeholder.com/403x212'"
                    alt="Recipe Image"
                    class="w-24 h-24 rounded-md object-cover shadow-md border-2 border-yellow-500"
                  />
                  <div class="w-full">
                    <div class="flex justify-between mb-4">
                      <div class="w-2/4">
                        <div class="font-semibold text-lg text-black-100 mb-2">{{ recipe.RecipeTitle }}</div>
                        <p class="text-black-100 italic text-small mb-4">Created on: {{ recipe.formatted_date }}</p>
  
                        <p class="text-black-100 font-semibold">Average Rating:</p>
                        <div class="flex">
                          <template v-if="recipe.average_rating && recipe.average_rating > 0">
                            <template v-for="star in 5" :key="star">
                              <i :class="star <= Math.round(recipe.average_rating) ? 'text-yellow-500' : 'text-gray-300'">
                                ★
                              </i>
                            </template>
                          </template>
                          <template v-else>
                            <span class="text-gray-500">Not reviewed yet</span>
                          </template>
                        </div>
                      </div>
                      <div class="flex flex-col items-end w-2/4 gap-4">
                        <a
                          :href="`/chef/dashboard/recipes/${recipe.RecipeID}/edit`"
                          class="px-6 py-2 bg-yellow-400 text-black-100 rounded-full shadow-lg hover:bg-yellow-500 transition-all duration-300 ease-in-out"
                        >
                          Edit Recipe
                        </a>
                        <button
                          @click="deleteRecipe(recipe.RecipeID)"
                          class="px-6 py-2 bg-red-400 text-white rounded-full shadow-lg hover:bg-red-500 transition-all duration-300 ease-in-out"
                        >
                          Delete Recipe
                        </button>
                      </div>
                    </div>
                  </div>
                </li>
              </ul>
            </div>

            <!-- Back Button -->
            <button
                @click="goBack"
                class="text-normal border-4 border-black-100 bg-yellow-300 hover:bg-yellow-500 text-black font-semibold py-2 px-5 rounded-xl shadow-lg mx-auto block"
                >
                Go Back
            </button>

          </div>


          
        </div>
      </div>
    </Layout>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  import Layout from "@/Layouts/frontend.vue";
  
  // Define the props that will be passed from the Laravel controller to the Vue component
  defineProps({
    recipes: Array,  // List of recipes for the current chef
  });
  
  // Function to handle recipe deletion
  const deleteRecipe = async (recipeId) => {
    try {
      if (confirm('Are you sure you want to delete this recipe?')) {
        const response = await axios.delete(`/chef/dashboard/recipes/${recipeId}`);
        if (response.status === 200) {
          // Remove the recipe from the UI after deletion
          const index = recipes.findIndex(recipe => recipe.RecipeID === recipeId);
          if (index !== -1) {
            recipes.splice(index, 1);
          }
          alert('Recipe deleted successfully.');
        }
      }
    } catch (error) {
      console.error(error);
    }
  };
  
  // Function to handle the back button click
  const goBack = () => {
    window.history.back();
  };
  </script>
  