<template>
    <div class="user-profile">
        <div class="card" v-if="user">
            <h2>{{ user.name }}</h2>
            <div class="user-info">
                <div class="user-image">
                    <img :src="user.image" alt="User Image">
                </div>
                <div class="user-details">
                    <p><strong>Email:</strong> {{ user.email }}</p>
                </div>
            </div>
            <div class="services" v-if="services && services.length > 0">
                <h3>Services:</h3>
                <ul>
                    <li v-for="service in services" :key="service.id">
                        <p><strong>Title:</strong> {{ service.title }}</p>
                        <p><strong>Description:</strong> {{ service.description }}</p>
                        <p><strong>Price:</strong> {{ service.price }}</p>
                        <p><strong>Rating:</strong> {{ getServiceRating(service.id) }}</p>
                    </li>
                </ul>
            </div>
        </div>
        <div class="error-message" v-else>
            Oops! Something went wrong. Please try again later.
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            user: null,
            error: false,
            services: [],
        };
    },
    mounted() {
        this.fetchUser();
        this.fetchServices();
    },
    methods: {
        fetchUser() {
            axios
                .get("/api/user/profile")
                .then((response) => {
                    this.user = response.data;
                })
                .catch((error) => {
                    console.log(error);
                    this.error = true;
                });
        },
        fetchServices() {
            axios
                .get("/api/user/services")
                .then((response) => {
                    console.log(response.data.data); // Log the response data
                    this.services = response.data.data; // Update this line
                })
                .catch((error) => {
                    console.log(error);
                    this.error = true;
                });
        },
        getServiceRating(serviceId) {
            const service = this.services.find((s) => s.id === serviceId);
            return service ? service.rating : "N/A";
        },
    },
};
</script>

<style scoped>
.user-profile {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    padding: 20px;
    margin-top: -100px; /* Add this line */
}

.card {
    max-width: 400px;
    width: 100%;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.error-message {
    color: red;
    margin-top: 20px;
}
</style>
