<template>
  <header class="bg-white text-black-100 font-sans shadow-md">
    <div class="bg-yellow-300 h-[30px]"></div>
    <div class="container mx-auto px-4 flex justify-between items-center h-[113px]">
      <a href="/" class="flex items-center space-x-4 text-normal white-shadow">
        <img :src="logo" alt="Logo" class="h-20" />
        <span>Kusina Delights</span>
      </a>

      <nav class="hidden md:flex space-x-6 font-bold text-normal">
        <a href="/" class="hover:text-gray-500">Home</a>
        <a href="/1" class="hover:text-gray-500">Recipes</a>
        <a href="/2" class="hover:text-gray-500">About Us</a>
      </nav>

      <div class="flex flex-col items-end space-y-2">
        <!-- Authenticated user dropdown -->
        <div v-if="$page.props.auth.user" class="relative">
          <button 
            @click="toggleUserDropdown" 
            class="flex items-center space-x-2 text-sm font-bold text-small hover:text-gray-500 focus:outline-none"
          >
            <span>Hello, {{ $page.props.auth.user.name }}</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
          </button>

          <!-- User Dropdown Menu -->
          <div 
            v-if="userDropdownOpen" 
            class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded shadow-lg z-50"
          >
            <a href="/dashboard" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Dashboard</a>
            <button 
              @click="logout" 
              class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
            >
              Logout
            </button>
          </div>
        </div>

        <!-- Login/Sign Up links for unauthenticated users -->
        <div v-else class="flex space-x-4 text-sm font-bold text-small">
          <a href="/login" class="hover:text-gray-500">Login</a>
          <span>|</span>
          <a href="/register" class="hover:text-gray-500">Sign Up</a>
        </div>

        <!-- Recipe Search Bar -->
        <div class="relative flex items-center bg-gray-100 border border-gray-300 rounded-3xl px-2 py-2">
          <input
            v-model="searchQuery"
            @input="fetchRecipes"
            @focus="toggleRecipeDropdown(true)"
            type="text"
            placeholder="Search recipes..."
            class="text-small px-2 w-40 bg-transparent outline-none focus:outline-none focus:ring-0 border-none placeholder-gray-500"
          />
          <button class="text-gray-600 px-4">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5">
              <circle cx="10" cy="10" r="6" stroke="currentColor" stroke-width="2" />
              <line x1="16" y1="16" x2="21" y2="21" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
            </svg>
          </button>

          <!-- Recipe Dropdown Menu -->
          <div
            v-if="recipes.length && recipeDropdownOpen"
            class="absolute mt-32 w-[30vh] bg-white border border-gray-200 rounded shadow-lg z-50"
          >
            <a
              v-for="recipe in filteredRecipes"
              :key="recipe.RecipeID"
              :href="`/api/recipes/${recipe.RecipeID}`"
              class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 flex items-center space-x-4"
            >
              <!-- Display the recipe photo if it exists -->
              <img v-if="recipe.RecipePhoto" :src="recipe.RecipePhoto" alt="Recipe Image" class="h-10 w-10 object-cover rounded-full" />
              <span>{{ recipe.RecipeTitle }}</span>
            </a>
          </div>

        </div>
      </div>
    </div>
  </header>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      logo: '/storage/logo3.png', // Adjust this based on your public path
      searchQuery: '',
      recipes: [],
      userDropdownOpen: false,
      recipeDropdownOpen: false,
    };
  },
  computed: {
    filteredRecipes() {
      return this.recipes.filter((recipe) =>
        recipe.RecipeTitle.toLowerCase().includes(this.searchQuery.toLowerCase())
      );
    },
  },
  watch: {
    searchQuery(newQuery) {
      // If the search query is empty, clear recipes and close dropdown
      if (newQuery.trim() === '') {
        this.recipes = [];
        this.toggleRecipeDropdown(false);
      } else {
        this.fetchRecipes(newQuery); // Fetch recipes if search query is not empty
      }
    },
  },
  methods: {
    toggleUserDropdown() {
      this.userDropdownOpen = !this.userDropdownOpen;
    },
    toggleRecipeDropdown(state) {
      this.recipeDropdownOpen = state;
    },
    logout() {
      // Send a POST request to the Laravel logout route
      this.$inertia.post('/logout');
    },
    async fetchRecipes(query) {
      try {
        const { data } = await axios.get('/api/recipes', {
          params: { search: query },
        });
        this.recipes = data;
        this.toggleRecipeDropdown(data.length > 0); // Open dropdown if there are recipes
      } catch (error) {
        console.error('Error fetching recipes:', error);
        this.toggleRecipeDropdown(false); // Close the dropdown if there's an error
      }
    },
  },
};
</script>



<style scoped>
.recipe-image {
  width: 40px;
  height: 40px;
  object-fit: cover;
  border-radius: 50%;
  margin-right: 10px;
}
</style>