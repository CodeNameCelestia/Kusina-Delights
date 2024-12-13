<template>
  <Layout>
    <div class="flex justify-between items-center mb-4">
      <h2 class="text-2xl font-semibold text-gray-700">User List</h2>
      <InertiaLink
        :href="'/users/create'"
        class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded-lg"
      >
        New User
      </InertiaLink>
    </div>

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
      <div class="p-4 border-t">
        <!-- Column Headers -->
        <div class="flex mb-2 font-semibold text-gray-700">
          <div class="flex-1">Name</div>
          <div class="flex-1">Email</div>
          <div class="flex-1 text-center">Actions</div>
        </div>

        <!-- Loop through users -->
        <div
          v-for="user in users"
          :key="user.id"
          class="flex justify-between items-center py-3 border-b hover:bg-gray-50"
        >
          <div class="flex-1">
            <p class="text-lg font-medium">{{ user.name }}</p>
          </div>
          <div class="flex-1">
            <p class="text-sm text-gray-500">{{ user.email }}</p>
          </div>
          <div class="flex-1 text-center space-x-2">
            <InertiaLink
              :href="'/users/' + user.id"
              class="text-green-500 hover:text-green-700"
            >
              Show
            </InertiaLink>
            <InertiaLink
              :href="'/users/' + user.id + '/edit'"
              class="text-blue-500 hover:text-blue-700"
            >
              Edit
            </InertiaLink>
            <button
              @click="submitDelete(user.id)"
              class="text-red-500 hover:text-red-700"
            >
              Delete
            </button>
          </div>
        </div>
      </div>
    </div>
  </Layout>
</template>

<script setup>
import { defineProps } from 'vue';
import { InertiaLink } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';
import Layout from '../../Layouts/backend.vue';
import Swal from 'sweetalert2'; // Import SweetAlert2

const props = defineProps({
  users: Array,
});

const submitDelete = async (userId) => {
  // SweetAlert2 confirmation dialog
  const result = await Swal.fire({
    title: 'Are you sure?',
    text: 'You won\'t be able to revert this!',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Yes, delete it!',
    cancelButtonText: 'No, cancel!',
    background: 'rgba(255, 255, 255, 1)', // White background for clarity
    confirmButtonColor: 'rgba(204, 162, 35, 1)', // Golden Yellow for confirm button
    cancelButtonColor: 'rgba(54, 69, 79, 1)', // Charcoal Gray for cancel button to provide contrast
    iconColor: 'rgba(255, 219, 99, 1)', // Golden yellow for icon color for consistency
  });

  // If confirmed, proceed with the deletion
  if (result.isConfirmed) {
    Inertia.delete(`/users/${userId}`);
    Swal.fire({
      title: 'Deleted!',
      text: 'User has been deleted.',
      icon: 'success',
      confirmButtonText: 'Okay',
    });
  } else {
    Swal.fire({
      title: 'Cancelled',
      text: 'User deletion was cancelled.',
      icon: 'info',
      confirmButtonText: 'Okay',
    });
  }
};
</script>

