<template>
    <Layout>
      <div class="relative h-[998px] overflow-hidden">
        <!-- Blurred Background -->
        <div class="absolute inset-0 -m-[20px]">
          <div
            class="absolute inset-0 bg-cover bg-center"
            style="background-image: url('https://c.animaapp.com/9OBfntRB/img/sheelah-brennan-uaevmc51ttw-unsplash-1.png'); filter: brightness(0.3) blur(20px);"
          ></div>
        </div>
  
        <!-- Main Content -->
        <div class="flex items-center justify-center h-full relative px-12 sm:px-16 lg:px-20">
          <div class="bg-white w-full max-w-[1600px] p-12 sm:p-16 lg:p-20 rounded-2xl shadow-lg flex gap-12">
            <!-- Profile Card -->
            <div
              class="bg-yellow-300 w-full h-[80vh] sm:w-1/3 p-12 rounded-[2rem] shadow-[5px_5px_15px_rgba(0,0,0,0.5)] relative"
            >
              <div class="absolute top-6 right-6 text-black-100cursor-pointer">
                <a href="/profile_edit">
                  <i class="fas fa-pen text-4xl"></i>
                </a>
              </div>
              <div class="flex flex-col items-center">
                <img
                  :src="user.ProfileImage ? `/storage/${user.ProfileImage}` : 'https://via.placeholder.com/403x212'"
                  alt="Profile Image"
                  class="w-48 h-48 rounded-full object-cover shadow-md"
                />
                <p class="text-center mt-8 font-semibold text-2xl">{{ user.name }}</p>
                <div class="mt-10 border-t-4 border-black-100 w-full"></div>
                <div class="w-full mt-6 pl-6 text-left space-y-2">
                  <p class="text-small text-black">
                    <span class="font-medium font-semibold text-black">Email:</span> {{ user.email }}
                  </p>
                  <p class="text-small text-black">
                    <span class="font-medium font-semibold text-black">Date Joined:</span> {{ user.date_joined }}
                  </p>
                </div>
              </div>
              <DropdownLink
                    :href="route('logout')"
                    method="post"
                    as="button"
                    class="absolute bottom-6 left-1/2 transform -translate-x-1/2 bg-green-300 text-black py-2 px-10 rounded-2xl font-semibold shadow-[5px_5px_15px_rgba(0,0,0,0.3)] text-small"
                >
                    Log out
                </DropdownLink>

            </div>
  
            <!-- Bio and History Section -->
            <div class="flex flex-col w-full sm:w-2/3 gap-12">
              <!-- Bio Section -->
              <div
                class="bg-yellow-300 p-10 rounded-lg shadow-md relative rounded-[2.3rem] shadow-[5px_5px_15px_rgba(0,0,0,0.5)]"
              >
                <div class="absolute top-6 right-6 text-black-100 cursor-pointer" @click="toggleEdit">
                  <i class="fas fa-pen text-3xl"></i>
                </div>
                <h2 class="font-semibold text-2xl mb-4">Bio:</h2>
                <div v-if="isEditing">
                  <input
                    v-model="newIntroduction"
                    type="text"
                    class="border p-2 rounded-md w-full"
                    placeholder="Enter your introduction"
                  />
                  <button @click="saveIntroduction" class="bg-green-300 text-black p-2 rounded-md mt-2">Save</button>
                </div>
                <div v-else>
                  <p class="text-small italic text-black-100">
                    <span class="font-semibold "></span> {{ profile.introduction }}
                  </p>
                </div>
              </div>
  
              <!-- History Section -->
              <div class="bg-yellow-300 p-10 rounded-lg shadow-md rounded-[2.3rem] shadow-[5px_5px_15px_rgba(0,0,0,0.5)]">
                <h2 class="font-semibold text-3xl text-black-100 mb-8 border-b-2 border-black-100 pb-4">History:</h2>
                <ul class="space-y-8">
                  <li v-if="typeof reviews === 'string'" class="text-sm text-black-100">{{ reviews }}</li>
                  <li v-else v-for="(review, index) in reviews" :key="index" class="flex items-start gap-6 transition-transform transform hover:scale-105">
                    <!-- Recipe Image -->
                    <img
                      :src="review.RecipePhoto ? `/storage/${review.RecipePhoto}` : 'https://via.placeholder.com/403x212'"
                      alt="Recipe Image"
                      class="w-24 h-24 rounded-md object-cover shadow-md border-2 border-yellow-500"
                    />
                    <!-- Review Content -->
                    <div class="w-full">
                      <div class="flex justify-between mb-4">
                        <div class="w-2/4">
                          <div class="font-semibold text-lg text-black-100 mb-2">Recipe Title: {{ review.title }}</div>
                          <p class="text-black-100 italic text-small mb-4">Comment: {{ review.comment }}</p>
                        </div>
                        <div class="flex flex-col items-end w-2/4 gap-4">
                          <a
                            :href="`/api/recipes/${review.recipe_id}`"
                            class="px-6 py-2 bg-yellow-400 text-black-100 rounded-full shadow-lg hover:bg-yellow-500 transition-all duration-300 ease-in-out"
                          >
                            View Recipe
                          </a>
                          <div class="flex items-center gap-1 text-yellow-400">
                            <p class="text-black-100 text-sm">Star rating:</p>
                            <template v-for="star in 5">
                              <i
                                v-if="star <= review.stars"
                                class="fa fa-star w-5 h-5 text-yellow-500"
                                style="text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);"
                                aria-hidden="true"
                              ></i>
                              <i
                                v-else
                                class="fa fa-star w-5 h-5 text-black-100"
                                style="text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);"
                                aria-hidden="true"
                              ></i>
                            </template>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </Layout>
  </template>
  
  <script setup>
  import { reactive, ref } from "vue";
  import Layout from "@/Layouts/frontend.vue";
  import { usePage } from "@inertiajs/vue3";
  
  const { props } = usePage();
  const user = reactive(props.user);
  const profile = reactive(props.profile);
  const reviews = reactive(props.reviews);
  
  // Define states for editing introduction
  const isEditing = ref(false);
  const newIntroduction = ref(profile.introduction);
  
  // Method to toggle editing
  function toggleEdit() {
    isEditing.value = !isEditing.value;
  }
  
  // Method to save the introduction
  function saveIntroduction() {
    isEditing.value = false;
    // Save to backend
    updateIntroduction(newIntroduction.value);
  }
  
  // Method to call the backend API to save the introduction
  function updateIntroduction(introduction) {
    axios.post('/update-introduction', { introduction })
      .then(response => {
        profile.introduction = introduction;
      })
      .catch(error => {
        console.error(error);
      });
  }
  </script>
  