<template>
  <Layout>
    <div class="relative h-[998px] overflow-hidden">
      <div class="absolute inset-0 -m-[20px]">
        <div
          class="absolute inset-0 bg-cover bg-center"
          style="background-image: url('https://c.animaapp.com/9OBfntRB/img/sheelah-brennan-uaevmc51ttw-unsplash-1.png'); filter: brightness(0.3) blur(20px);"
        ></div>
      </div>

      <div class="flex items-center justify-center h-full relative px-10 sm:px-12 lg:px-16">
        <div class="bg-white w-full max-w-[200vh] p-12 sm:p-16 lg:p-20 rounded-2xl shadow-lg">
          <h1 class="text-center text-large font-bold mb-10">Edit Recipe</h1>

          <form class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8" @submit.prevent="submitForm">
            <!-- Recipe Title -->
            <div class="col-span-1">
              <label class="block text-lg font-semibold mb-2">Recipe Title*</label>
              <input
                v-model="form.RecipeTitle"
                type="text"
                class="w-full border border-gray-300 shadow-sm rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-yellow-500"
                required
              />
            </div>

            <!-- Description -->
            <div class="col-span-1">
              <label class="block text-lg font-semibold mb-2">Description</label>
              <textarea
                v-model="form.Description"
                class="w-full border border-gray-300 shadow-sm rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-yellow-500"
              ></textarea>
            </div>

            <!-- Ingredients -->
            <div class="col-span-1">
              <label class="block text-lg font-semibold mb-2">Ingredients</label>
              <textarea
                v-model="form.Ingredients"
                class="w-full border border-gray-300 shadow-sm rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-yellow-500"
              ></textarea>
            </div>

            <!-- Instructions -->
            <div class="col-span-1">
              <label class="block text-lg font-semibold mb-2">Instructions</label>
              <textarea
                v-model="form.Instructions"
                class="w-full border border-gray-300 shadow-sm rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-yellow-500"
              ></textarea>
            </div>

            <!-- Recipe Photo -->
            <div class="col-span-1">
              <label class="block text-lg font-semibold mb-2">Recipe Photo</label>
              <input
                ref="fileInput"
                type="file"
                accept="image/*"
                @change="handleFileChange"
                class="w-full text-gray-700"
              />
              <img v-if="imagePreview" :src="imagePreview" alt="Preview" class="mt-4 w-full h-40 object-cover" />
            </div>

            <!-- Additional Fields -->
            <div class="col-span-1">
              <label class="block text-lg font-semibold mb-2">Preparation Time (minutes)</label>
              <input
                v-model="form.Preparation"
                type="number"
                class="w-full border border-gray-300 shadow-sm rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-yellow-500"
              />
            </div>

            <div class="col-span-1">
              <label class="block text-lg font-semibold mb-2">Cooking Time (minutes)</label>
              <input
                v-model="form.CookingTime"
                type="number"
                class="w-full border border-gray-300 shadow-sm rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-yellow-500"
              />
            </div>

            <div class="col-span-1">
              <label class="block text-lg font-semibold mb-2">Difficulty</label>
              <select
                v-model="form.Difficulty"
                class="w-full border border-gray-300 shadow-sm rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-yellow-500"
              >
                <option disabled value="">Select Difficulty</option>
                <option>Easy</option>
                <option>Medium</option>
                <option>Hard</option>
              </select>
            </div>

            <div class="col-span-1">
              <label class="block text-lg font-semibold mb-2">Servings</label>
              <input
                v-model="form.Servings"
                type="number"
                class="w-full border border-gray-300 shadow-sm rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-yellow-500"
              />
            </div>

            <!-- Buttons -->
            <div class="col-span-3 flex justify-center mt-6">
              <button
                type="submit"
                class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-3 px-8 rounded-md shadow-md"
              >
                Update
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </Layout>
</template>

<script setup>
import Layout from "@/Layouts/frontend.vue";
import { ref } from "vue";
import { usePage } from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/inertia';

// Props passed from the controller
const props = defineProps({
  recipe: Object,
});

// Initialize the form with recipe data
const form = ref({ ...props.recipe });
const imagePreview = ref(props.recipe.RecipePhoto ? `/storage/${props.recipe.RecipePhoto}` : null);

const handleFileChange = (event) => {
  const file = event.target.files[0];
  if (file) {
    form.value.RecipePhoto = file;
    imagePreview.value = URL.createObjectURL(file);
  }
};

const submitForm = async () => {
  try {
    // Create a FormData object to send the data
    const formData = new FormData();
    
    // Loop through each form field and append to the FormData object
    for (const [key, value] of Object.entries(form.value)) {
      if (value !== undefined && value !== null) {
        formData.append(key, value);
      }
    }

    // Send the form data to the backend for updating the recipe
    await Inertia.put(`/chef/dashboard/recipes/${props.recipe.RecipeID}/update`, formData, {
      preserveState: true, // Preserve form state after submission
      onFinish: () => {
        // Handle after the form submission (optional, for example, show a success message)
      },
    });
  } catch (error) {
    console.error('Error updating recipe:', error);
  }
};

</script>

<style scoped>
/* Add your custom styles here */
</style>
