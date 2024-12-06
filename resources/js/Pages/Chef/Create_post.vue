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
        <div class="flex items-center justify-center h-full relative px-10 sm:px-12 lg:px-16">
          <div class="bg-white w-full max-w-[200vh] p-12 sm:p-16 lg:p-20 rounded-2xl shadow-lg">
            <h1 class="text-center text-large font-bold mb-10">Create Posts</h1>
  
            <form class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
              <!-- Recipe Title -->
              <div class="col-span-1">
                <label class="block text-lg font-semibold mb-2">Recipe Title*</label>
                <input
                  type="text"
                  class="w-full border border-gray-300 shadow-sm rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-yellow-500"
                  required
                />
              </div>
  
              <!-- Description -->
              <div class="col-span-1">
                <label class="block text-lg font-semibold mb-2">Description</label>
                <input
                  type="text"
                  class="w-full border border-gray-300 shadow-sm rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-yellow-500"
                />
              </div>
  
              <!-- Ingredients -->
              <div class="col-span-1">
                <label class="block text-lg font-semibold mb-2">Ingredients</label>
                <input
                  type="text"
                  class="w-full border border-gray-300 shadow-sm rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-yellow-500"
                />
              </div>
  
              <!-- Video Link -->
              <div class="col-span-1">
                <label class="block text-lg font-semibold mb-2">Video Link</label>
                <input
                  type="text"
                  class="w-full border border-gray-300 shadow-sm rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-yellow-500"
                />
              </div>
  
              <!-- Instructions -->
              <div class="col-span-1">
                <label class="block text-lg font-semibold mb-2">Instructions</label>
                <input
                  type="text"
                  class="w-full border border-gray-300 shadow-sm rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-yellow-500"
                />
              </div>
  
              <!-- Recipe Photo -->
              <div class="col-span-1">
                <label class="block text-lg font-semibold mb-2">Recipe Photo</label>
                <div
                  class="w-full border border-dashed border-gray-300 rounded-md p-6 text-center text-lg text-gray-500"
                >
                  Drag & Drop your files or <span class="text-orange-500 cursor-pointer">Browse</span>
                </div>
              </div>
  
              <!-- Preparation Time -->
              <div class="col-span-1">
                <label class="block text-lg font-semibold mb-2">Preparation Time (minutes)</label>
                <input
                  type="number"
                  class="w-full border border-gray-300 shadow-sm rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-yellow-500"
                />
              </div>
  
              <!-- Cooking Time -->
              <div class="col-span-1">
                <label class="block text-lg font-semibold mb-2">Cooking Time (minutes)</label>
                <input
                  type="number"
                  class="w-full border border-gray-300 shadow-sm rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-yellow-500"
                />
              </div>
  
              <!-- Difficulty -->
              <div class="col-span-1">
                <label class="block text-lg font-semibold mb-2">Difficulty</label>
                <select
                  class="w-full border border-gray-300 shadow-sm rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-yellow-500"
                >
                  <option>Select an option</option>
                  <option>Easy</option>
                  <option>Medium</option>
                  <option>Hard</option>
                </select>
              </div>
  
              <!-- Servings -->
              <div class="col-span-1">
                <label class="block text-lg font-semibold mb-2">Servings</label>
                <input
                  type="number"
                  class="w-full border border-gray-300 shadow-sm rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-yellow-500"
                />
              </div>
  
              <!-- Buttons -->
              <div class="col-span-3 flex justify-center mt-6">
                <a href="/dashboard">
                  <button
                    type="submit"
                    class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-3 px-8 rounded-md shadow-md mr-6"
                  >
                    Create
                  </button>
                </a>
  
                <a href="/dashboard">
                  <button
                    type="button"
                    class="bg-white border border-gray-300 text-gray-700 font-semibold py-3 px-8 rounded-md shadow-md"
                  >
                    Cancel
                  </button>
                </a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </Layout>
  </template>
  
  <script setup>
  import Layout from "@/Layouts/frontend.vue";
  </script>
  