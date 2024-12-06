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
        <div class="flex items-center justify-center h-full relative px-12 sm:px-16 lg:px-20">
          <div class="bg-white w-full max-w-[1600px] p-12 sm:p-16 lg:p-20 rounded-2xl shadow-lg flex gap-12">
            <!-- Profile Card -->
            <div
              class="bg-yellow-300 w-full h-[585px] sm:w-1/3 p-12 rounded-[2rem] shadow-[5px_5px_15px_rgba(0,0,0,0.5)] relative"
            >
              <div class="absolute top-6 right-6 text-gray-600 cursor-pointer">
                <a href="/profile">
                  <i class="fas fa-pen text-4xl"></i>
                </a>
              </div>
              <div class="flex flex-col items-center">
                <div
                  class="w-48 h-48 bg-gray-200 rounded-full flex items-center justify-center shadow-md"
                >
                  <i class="fas fa-user text-8xl text-gray-500"></i>
                </div>
                <div class="mt-10 border-t-4 border-black w-full"></div>
                <p class="text-center mt-8 font-semibold text-2xl">Code_Celestia</p>
                <div class="w-full text-left mt-6 pl-6">
                  <p class="text-normal font-medium">Email:</p>
                  <p class="text-normal font-medium">Date Joined:</p>
                </div>
              </div>
              <button
                class="absolute bottom-6 left-1/2 transform -translate-x-1/2 bg-green-300 text-black py-2 px-16 rounded-2xl font-semibold shadow-[5px_5px_15px_rgba(0,0,0,0.3)] text-normal"
              >
                Log out
              </button>
            </div>
  
            <!-- Bio and History Section -->
            <div class="flex flex-col w-full sm:w-2/3 gap-12">
              <!-- Account Section -->
              <div
                class="bg-yellow-300 p-12 h-[585px] rounded-lg shadow-md relative rounded-[2.3rem] shadow-[5px_5px_15px_rgba(0,0,0,0.5)]"
              >
                <div class="absolute top-6 right-6 text-gray-600 cursor-pointer">
                  <i class="fas fa-pen text-3xl"></i>
                </div>
                <h2 class="font-semibold text-large mb-6">Account:</h2>
  
                <!-- Username -->
                <p class="text-lg font-semibold mb-1">Username:</p>
                <input
                  type="text"
                  class="text-small w-4/5 border border-gray-300 p-2 rounded-2xl mb-6 focus:outline-none focus:ring-2 focus:ring-yellow-500"
                  placeholder="Enter username"
                />
  
                <!-- Email -->
                <p class="text-lg font-semibold mb-1">Email:</p>
                <input
                  type="email"
                  class="text-small w-4/5 border border-gray-300 p-2 rounded-2xl mb-6 focus:outline-none focus:ring-2 focus:ring-yellow-500"
                  placeholder="Enter email"
                />
  
                <!-- Password -->
                <p class="text-lg font-semibold mb-1">Password:</p>
                <input
                  type="password"
                  class="text-small w-4/5 border border-gray-300 p-2 rounded-2xl mb-6 focus:outline-none focus:ring-2 focus:ring-yellow-500"
                  placeholder="Enter password"
                />
  
                <!-- Confirm Password -->
                <p class="text-lg font-semibold mb-1">Confirm Password:</p>
                <input
                  type="password"
                  class="text-small w-4/5 border border-gray-300 p-2 rounded-2xl mb-6 focus:outline-none focus:ring-2 focus:ring-yellow-500"
                  placeholder="Confirm password"
                />
              </div>
            </div>
          </div>
        </div>
      </div>
    </Layout>
  </template>
  
  <script setup>
  import Layout from "@/Layouts/frontend.vue";
  </script>
  