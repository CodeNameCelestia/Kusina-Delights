<template>
  <Layout>
    <div
      class="relative h-[362px] overflow-hidden"
      @mouseenter="showGlow = true"
      @mouseleave="showGlow = false"
    >
      <!-- Hero Section Background -->
      <div
        class="absolute inset-0 bg-cover bg-center"
        style="background-image: url('https://c.animaapp.com/IjUIznOY/img/hero-image-1.png'); filter: brightness(0.5);"
      ></div>

      <!-- Cursor Glow -->
      <div
        v-if="showGlow"
        class="absolute pointer-events-none w-[100px] h-[100px] bg-yellow-300 opacity-70 rounded-full blur-3xl"
        :style="{
          transform: `translate(${cursorX - 50}px, ${cursorY - 50}px)`, // Center the glow
          transition: 'transform 50ms linear', // Smooth transition for small movements
        }"
      ></div>

      <!-- Content -->
      <div
        class="flex items-center justify-center h-full relative z-10"
        @mousemove="updateCursorPosition"
      >
        <p
          class="text-white text-center px-4 text-large font-bold drop-shadow-xl"
        >
          Discover and savor the rich flavors of Filipino snack culture at Kusina
          Delights!
        </p>
      </div>
    </div>

      <!-- Famous Filipino Delights Section -->
  <div class="mt-10 mb-10">
    <p class="text-black-100 text-center text-large font-bold drop-shadow-xl mb-4">
      Famous Filipino Delights
    </p>
    <div class="flex flex-wrap justify-center gap-10">
      <div 
        v-for="(recipe, index) in famousDelights" 
        :key="index" 
        class="max-w-[403px] bg-white rounded-[40px] shadow-lg overflow-hidden flex flex-col transform transition-transform duration-300 hover:scale-105 hover:shadow-xl"
      >
      <!-- Fixed image size -->
      <div class="relative w-full h-[250px]">
        <img
          :src="recipe.RecipePhoto ? `/storage/${recipe.RecipePhoto}` : 'https://via.placeholder.com/403x212'"
          class="absolute inset-0 w-full h-full object-cover"
          :alt="recipe.RecipeTitle"
        />
      </div>
        <!-- Adjusted padding and layout for better spacing -->
        <div class="p-4 flex flex-col flex-grow">
          <div>
            <h2 class="text-large font-semibold text-gray-800">{{ recipe.RecipeTitle }}</h2>
            <p class="text-gray-400 text-small">Chef: {{ recipe.chef?.user?.name || 'Unknown Chef' }}</p>
            <p class="mt-2 text-gray-600 text-small line-clamp-3 text-justify">{{ recipe.Description }}</p>
          </div>
          <!-- Pinned button to the bottom using margin-top auto -->
          <div class="mt-auto flex items-center justify-between pt-4">
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
                <template v-else>
                  <span class="text-gray-500 text-[15px] italic">Not reviewed yet</span>
                </template>
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

      <div v-for="(recipe, index) in recentRecipes" :key="index" class="bg-gray-100 shadow-lg rounded-tr-[40px] rounded-br-[40px] rounded-tl-[40px] rounded-bl-[40px] flex items-center w-[98%] max-w-screen-xl mb-10 transform transition-transform duration-300 hover:scale-105 hover:shadow-xl">
        <div class="w-[40vh] h-[350px] overflow-hidden rounded-tl-[40px] rounded-bl-[40px]">
        <img
          :src="recipe.RecipePhoto ? `/storage/${recipe.RecipePhoto}` : 'https://via.placeholder.com/403x212'"
          class="w-full h-full object-cover"
          :alt="recipe.RecipeTitle"
        >
      </div>
          <div class="flex-1 p-[1vh] rounded-r-lg bg-gray-100">
              <h3 class="text-large font-bold mt-4 mb-4 ml-10 text-black-100">{{ recipe.RecipeTitle }}</h3>
              <p class="text-gray-400 text-small mb-4 ml-10"> Chef: {{ recipe.chef?.user?.name || 'Unknown Chef' }}</p>
              <p class="text-gray-600 text-small py-1 ml-10 pr-4 text-justify">{{ recipe.Description }}</p>
              <div class="flex items-center justify-between mt-6 ml-10">
                  <a :href="`api/recipes/${recipe.RecipeID}`">
                      <button class="bg-yellow-300 text-black-100 font-bold py-1 px-4 rounded-full text-small font-semibold hover:bg-yellow-500 focus:outline-none focus:ring focus:ring-yellow-300">
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
import { ref } from 'vue'; // Import ref to use reactive variables

// Reactive state for cursor glow effect
const showGlow = ref(false);
const cursorX = ref(0);
const cursorY = ref(0);

// Update cursor position dynamically
const updateCursorPosition = (event) => {
  cursorX.value = event.clientX - 0; // Offset to center the glow
  cursorY.value = event.clientY - 150; // Offset to center the glow
};

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
