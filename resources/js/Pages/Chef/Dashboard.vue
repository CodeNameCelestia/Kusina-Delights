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
          <h1 class="text-center text-large font-bold mb-10">Dashboard</h1>
          <div class="flex gap-12">
            <!-- Profile Card -->
            <div
              class="bg-yellow-300 w-1/3 p-10 rounded-[2rem] shadow-[5px_5px_10px_rgba(0,0,0,0.5)] relative"
            >
              <div class="absolute top-6 right-6 text-gray-600 cursor-pointer">
                <i class="fas fa-pen text-2xl"></i>
              </div>
              <div class="flex flex-col items-center">
                <div
                  class="w-32 h-32 bg-gray-200 rounded-full flex items-center justify-center shadow-md"
                >
                  <i class="fas fa-user text-6xl text-gray-500"></i>
                </div>
                <div class="mt-8 border-t border-black w-full"></div>
                <p class="text-center mt-4 font-semibold text-large">Code_Celestia</p>
                <div class="w-full text-left mt-4 pl-4">
                  <p class="text-normal font-medium">Email:</p>
                  <p class="text-normal font-medium">Date Joined:</p>
                </div>
              </div>
              <button
                class="absolute bottom-6 left-1/2 transform -translate-x-1/2 bg-green-300 text-black-100 py-4 px-10 rounded-2xl font-semibold shadow-[5px_5px_10px_rgba(0,0,0,0.3)] text-normal"
              >
                Log out
              </button>
            </div>

            <!-- Stats Section -->
            <div class="flex flex-col gap-8 w-1/3">
              <div class="bg-gray-100 p-8 rounded-xl shadow-lg">
                <p class="text-normal text-gray-500">Total Viewers</p>
                <p class="text-large font-bold">18,000 viewers</p>
              </div>
              <div class="bg-gray-100 p-8 rounded-xl shadow-lg">
                <p class="text-normal text-gray-500">Recipes</p>
                <p class="text-large font-bold">1 Recipe</p>
                <!-- New Post Button -->
                <a href="/create_post">
                  <button
                    class="mt-4 border-4 border-black-100 bg-yellow-300 hover:bg-yellow-500 text-black font-semibold py-2 px-8 rounded-xl shadow-md"
                  >
                    Recipe
                  </button>
                </a>
              </div>
              <div class="bg-gray-100 p-8 rounded-xl shadow-lg">
                <p class="text-normal text-gray-500">Income</p>
                <p class="text-large font-bold">₱ 10.00</p>
              </div>
            </div>

            <!-- Chart Section -->
            <div
              class="bg-gray-100 p-8 rounded-xl shadow-lg w-1/3 flex flex-col"
            >
              <p class="text-normal text-black-100 font-semibold mb-4 border-b pb-2">Viewer Growth</p>
              <img
                src="https://placehold.co/300x200"
                alt="Chart"
                class="mt-4 rounded-lg"
              />
            </div>
          </div>

          <!-- View Recipes Button -->
          <div class="flex justify-center mt-12">
            <button
              class="text-normal border-4 border-black-100 bg-yellow-300 hover:bg-yellow-500 text-black font-semibold py-4 px-16 rounded-xl shadow-lg"
            >
              View Recipes
            </button>
          </div>
        </div>
      </div>
    </div>
  </Layout>
</template>

<script setup>
import Layout from "@/Layouts/frontend.vue";
</script>
