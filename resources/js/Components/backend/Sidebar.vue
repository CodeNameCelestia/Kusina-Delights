<script setup>
import { usePage } from '@inertiajs/inertia-vue3'
const logoPath = '/storage/logo3.png' // Adjust this to the correct path for the logo

// Extract the `url` from the `usePage()` hook
const { url } = usePage()

// Safely extract the path from the `url` object
const currentUrl = typeof url === 'string' ? url : (url?.path || '')

// Helper function to check if the current URL starts with a specific base path
const isActive = (basePath) => currentUrl.startsWith(basePath)
</script>

<template>
  <div class="sidebar">
    <div class="w-64 min-h-screen bg-yellow-300 shadow-lg border-r border-gray-100">
      <div class="flex items-center px-6 py-6 border-b border-gray-100">
        <img :src="logoPath" alt="Logo" class="h-10 w-auto object-contain" />
        <h1 class="ml-3 text-lg font-bold text-gray-800">Kusina Delights</h1>
      </div>
      <nav class="mt-8 px-3">
        <a
          href="/dashboard"
          :class="[
            'flex items-center justify-between px-4 py-3 rounded-lg mb-2 transition-all duration-200 ease-in-out',
            isActive('/dashboard') 
              ? 'bg-yellow-100 text-yellow-800 font-medium shadow-sm' 
              : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'
          ]"
        >
          <div class="flex items-center space-x-3">
            <i class="fas fa-home text-lg"></i>
            <span class="text-sm">Dashboard</span>
          </div>
        </a>

        <a
          href="/recipes"
          :class="[
            'flex items-center justify-between px-4 py-3 rounded-lg mb-2 transition-all duration-200 ease-in-out',
            isActive('/recipes') 
              ? 'bg-yellow-100 text-yellow-800 font-medium shadow-sm' 
              : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'
          ]"
        >
          <div class="flex items-center space-x-3">
            <i class="fas fa-clipboard text-lg"></i>
            <span class="text-sm">Recipes</span>
          </div>
        </a>

        <a
          href="/reviews"
          :class="[
            'flex items-center justify-between px-4 py-3 rounded-lg mb-2 transition-all duration-200 ease-in-out',
            isActive('/reviews') 
              ? 'bg-yellow-100 text-yellow-800 font-medium shadow-sm' 
              : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'
          ]"
        >
          <div class="flex items-center space-x-3">
            <i class="fas fa-star text-lg"></i>
            <span class="text-sm">Reviews</span>
          </div>
        </a>

        <a
          href="/users"
          :class="[
            'flex items-center justify-between px-4 py-3 rounded-lg mb-2 transition-all duration-200 ease-in-out',
            isActive('/users') 
              ? 'bg-yellow-100 text-yellow-800 font-medium shadow-sm' 
              : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'
          ]"
        >
          <div class="flex items-center space-x-3">
            <i class="fas fa-users text-lg"></i>
            <span class="text-sm">Users</span>
          </div>
        </a>
      </nav>
    </div>
  </div>
</template>


