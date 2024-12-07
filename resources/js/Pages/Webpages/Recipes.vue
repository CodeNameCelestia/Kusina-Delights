<template>
    <Layout>
      <div class="relative h-[362px]">
        <!-- Hero Section -->
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('https://c.animaapp.com/IjUIznOY/img/hero-image-1.png'); filter: brightness(0.5);"></div>
        <div class="flex items-center justify-center h-full relative">
          <p class="text-white text-center px-4 text-large font-bold drop-shadow-xl white-shadow">
            Discover and savor the rich flavors of Filipino snack culture at Kusina Delights!
          </p>
        </div>
      </div>
  
      <!-- Famous Filipino Delights Section -->
      <div class="mt-10 mb-10">
        <p class="text-black-100 text-center text-large font-bold drop-shadow-xl mb-4">
          Famous Filipino Delights
        </p>
        <div class="flex flex-wrap justify-center gap-10">
          <div v-for="(recipe, index) in famousDelights" :key="index" class="max-w-[403px] bg-white rounded-tr-[40px] rounded-tl-[50px] shadow-lg overflow-hidden flex flex-col">
            <img class="w-[50vh] h-[212px] overflow-hidden" :src="recipe.RecipePhoto ? `/storage/${recipe.RecipePhoto}` : 'https://via.placeholder.com/403x212'" :alt="recipe.RecipeTitle">
            <div class="p-4 flex flex-col justify-between h-[262px]">
              <div>
                <h2 class="text-large font-semibold text-gray-800">{{ recipe.RecipeTitle }}</h2>
                <p class="mt-2 text-gray-600 text-small">{{ recipe.Description }}</p>
              </div>
              <div class="mt-4 flex items-center justify-between">
                <a :href="`api/recipes/${recipe.RecipeID}`">
                  <button class="bg-yellow-300 text-black-100 font-bold py-1 px-4 rounded-full text-small font-semibold hover:bg-yellow-500 focus:outline-none focus:ring focus:ring-yellow-300">
                    View Recipe
                  </button>
                </a>
                <div class="flex items-center">
                  <span class="text-gray-600 text-normal mr-1">
                    <div v-if="recipe.reviews_count > 0" class="flex">
                      <template v-for="n in Math.round(recipe.reviews_avg_star) || 0">
                        <svg class="w-5 h-5 text-yellow-500 animate-shine" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" stroke="currentColor">
                          <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                        </svg>
                      </template>
                      <template v-for="n in (5 - Math.round(recipe.reviews_avg_star) || 0)">
                        <svg class="w-5 h-5 text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" stroke="currentColor">
                          <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                        </svg>
                      </template>
                    </div>
                    <span v-else class="text-gray-600">Not reviewed yet</span>
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  
      <!-- Recent Recipes Section -->
      <h2 class="text-5xl font-bold mb-8 text-center">Recent Recipes</h2>
      <div class=" flex flex-col items-center mb-10">

        <div v-for="(recipe, index) in recentRecipes" :key="index" class="bg-gray-50 rounded-lg flex items-center w-[98%] max-w-screen-xl mb-10">
            <img :src="recipe.RecipePhoto ? `/storage/${recipe.RecipePhoto}` : 'https://via.placeholder.com/403x212'" :alt="recipe.RecipeTitle" class="w-[45vh] h-[45vh] rounded-l-lg object-cover">
            <div class="flex-1 p-[2.2vh]   rounded-r-lg" style="background-color: rgba(255, 204, 0, 0.4);">
                <h3 class="text-large font-bold mt-4 mb-4 ml-10 text-black-100">{{ recipe.RecipeTitle }}</h3>
                <p class="text-gray-600 text-normal py-12 ml-10">{{ recipe.Description }}</p>
                <div class="flex items-center justify-between mt-6 ml-10">
                    <a :href="`api/recipes/${recipe.RecipeID}`">
                        <button class="bg-yellow-300 text-black-100 font-bold py-1 px-4 rounded-r-lg text-small font-semibold hover:bg-yellow-500 focus:outline-none focus:ring focus:ring-yellow-300">
                            View Recipe
                        </button>
                    </a>
                </div>
            </div>
        </div>



      </div>
    </Layout>
  </template>
  
  <script setup>
  import Layout from '../../Layouts/frontend.vue';
  
  // Define props for famousDelights and recentRecipes
  defineProps({
    famousDelights: Array,
    recentRecipes: Array,
  });
  </script>
  
  <style scoped>
  @keyframes shine {
    0% { opacity: 0.8; transform: scale(1); }
    50% { opacity: 1; transform: scale(1.2); }
    100% { opacity: 0.8; transform: scale(1); }
  }
  
  .animate-shine {
    animation: shine 2s infinite ease-in-out;
  }
  </style>
  