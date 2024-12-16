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
    <div class="bg-yellow-300 w-64 min-h-screen bg-white shadow-md">
      <div class="flex items-center px-6 py-4">
        <!-- Logo Image -->
        <img :src="logoPath" alt="Logo" class="h-14" />
        <h1 class="ml-3 text-lg font-bold">Kusina Delights</h1>
      </div>
      <nav class="mt-6 space-y-1">
        <!-- Dashboard Link -->
        <a
          href="/dashboard"
          :class="[
            'flex items-center px-6 py-3 space-x-4 font-semibold transition-colors duration-200',
            isActive('/dashboard') ? 'bg-yellow-200 text-gray-900' : 'hover:bg-gray-100 text-gray-600'
          ]"
        >
          
          <span class="text-sm leading-tight">Dashboard</span>
          <i class="fas fa-home text-lg"></i>
        </a>

        <!-- Recipes Link -->
        <a
          href="/recipes"
          :class="[
            'flex items-center px-6 py-3 space-x-4 font-semibold transition-colors duration-200',
            isActive('/recipes') ? 'bg-yellow-200 text-gray-900' : 'hover:bg-gray-100 text-gray-600'
          ]"
        >
          
          <span class="text-sm leading-tight">Recipes</span>
          <i class="fas fa-clipboard text-lg"></i>
        </a>

        <!-- Reviews Link -->
        <a
          href="/reviews"
          :class="[
            'flex items-center px-6 py-3 space-x-4 font-semibold transition-colors duration-200',
            isActive('/reviews') ? 'bg-yellow-200 text-gray-900' : 'hover:bg-gray-100 text-gray-600'
          ]"
        >
          
          <span class="text-sm leading-tight">Reviews</span>
          <i class="fas fa-star text-lg"></i>
        </a>

        <!-- Users Link -->
        <a
          href="/users"
          :class="[
            'flex items-center px-6 py-3 space-x-4 font-semibold transition-colors duration-200',
            isActive('/users') ? 'bg-yellow-200 text-gray-900' : 'hover:bg-gray-100 text-gray-600'
          ]"
        >
          
          <span class="text-sm leading-tight">Users</span>
          <i class="fas fa-users text-lg"></i>
        </a>
      </nav>
    </div>
  </div>
</template>


