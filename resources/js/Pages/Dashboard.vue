<script setup>
import Layout from '../Layouts/backend.vue';
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { Chart } from 'chart.js';

// Reactive variables for the statistics
const totalUsers = ref(0); // Changed from totalViews
const totalPosts = ref(0);
const totalReviews = ref(0);
const totalChefs = ref(0);

// Reactive variable for the users per day of the week
const usersPerDay = ref([]);

// Fetch statistics from the backend
const fetchDashboardData = async () => {
    try {
        const response = await axios.get('/dashboard-data');
        totalUsers.value = response.data.totalUsers;
        totalPosts.value = response.data.totalPosts;
        totalReviews.value = response.data.totalReviews;
        totalChefs.value = response.data.totalChefs;

        // Fetch the users per day of the week data
        usersPerDay.value = response.data.usersPerDay; // Assuming this is an array of user counts for each day
        drawChart();
    } catch (error) {
        console.error('Error fetching dashboard data:', error);
    }
};

// Function to draw the chart
const drawChart = () => {
    const ctx = document.getElementById('usersChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'], // Days of the week
            datasets: [{
                label: 'Total Users per Day',
                data: usersPerDay.value, // Data fetched from backend
                backgroundColor: 'rgba(255, 159, 64, 0.2)', // Bar color
                borderColor: 'rgba(255, 159, 64, 1)',
                borderWidth: 1,
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
};

onMounted(() => {
    fetchDashboardData();
});
</script>

<template>
    <Layout>
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-2 gap-6 mb-6">
            <!-- Total Users -->
            <div class="p-6 bg-white rounded-lg shadow-lg overflow-hidden flex flex-col transform transition-transform duration-300 hover:scale-105 hover:shadow-xl">
                <p class="text-sm text-gray-500">Total Users</p>
                <p class="text-2xl font-bold text-gray-800">{{ totalUsers }}</p>
            </div>

            <!-- Posts -->
            <div class="p-6 bg-white rounded-lg shadow-lg overflow-hidden flex flex-col transform transition-transform duration-300 hover:scale-105 hover:shadow-xl">
                <p class="text-sm text-gray-500">Total Recipes</p>
                <p class="text-2xl font-bold text-gray-800">{{ totalPosts }}</p>
            </div>

            <!-- Reviews -->
            <div class="p-6 bg-white rounded-lg shadow-lg overflow-hidden flex flex-col transform transition-transform duration-300 hover:scale-105 hover:shadow-xl">
                <p class="text-sm text-gray-500">Total Reviews</p>
                <p class="text-2xl font-bold text-gray-800">{{ totalReviews }}</p>
            </div>

            <!-- Chefs -->
            <div class="p-6 bg-white rounded-lg shadow-lg overflow-hidden flex flex-col transform transition-transform duration-300 hover:scale-105 hover:shadow-xl">
                <p class="text-sm text-gray-500">Total Chefs</p>
                <p class="text-2xl font-bold text-gray-800">{{ totalChefs }}</p>
            </div>
        </div>

        <!-- Graph (Chart.js) -->
        <div class="p-6 bg-white rounded-lg shadow-lg mt-6">
            <h3 class="text-lg font-semibold text-gray-800">Users Per Day of the Week</h3>
            <canvas id="usersChart" height="200"></canvas>
        </div>
    </Layout>
</template>
