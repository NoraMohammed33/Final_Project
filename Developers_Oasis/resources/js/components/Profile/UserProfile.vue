<template>
    <div class="user-profile">
        <div class="card" v-if="user && expert && expert.department && service && serviceRating">
            <h2>{{ user.name }}</h2>
            <div class="user-info">
                <div class="user-image">
                    <img :src="user.image" alt="User Image">
                </div>
                <div class="user-details">
                    <p><strong>Email:</strong> {{ user.email }}</p>
                    <p><strong>Department:</strong> {{ expert.department.name }}</p>
                    <p><strong>Bio:</strong> {{ expert.bio }}</p>
                    <p><strong>Service:</strong> {{ service.title }}</p>
                    <p><strong>Service Rating:</strong> {{ serviceRating.rating }}</p>
                </div>
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
            expert: null,
            service: null,
            serviceRating: null,
            error: false,
        };
    },
    mounted() {
        this.fetchUser();
    },
    methods: {
        fetchUser() {
            axios
                .get("/api/user/profile")
                .then((response) => {
                    this.user = response.data;
                    const expertId = this.user.expert_id; // Make sure the expert_id property exists
                    console.log("expertId:", expertId); // Log the value of expertId
                    console.log("this.user:", this.user); // Log the value of this.user
                    this.fetchExpert(expertId);
                })
                .catch((error) => {
                    console.log(error);
                    this.error = true;
                });
        },


        fetchExpert(expertId) {
            axios
                .get(`/api/experts/${expertId}`)
                .then((response) => {
                    this.expert = response.data;
                    this.fetchService(this.expert.service_id);
                })
                .catch((error) => {
                    console.log(error);
                    this.error = true;
                });
        },
        fetchService(serviceId) {
            axios
                .get(`/api/services/${serviceId}`)
                .then((response) => {
                    this.service = response.data;
                    this.fetchServiceRating(this.service.id);
                })
                .catch((error) => {
                    console.log(error);
                    this.error = true;
                });
        },
        fetchServiceRating(serviceId) {
            axios
                .get(`/api/service-ratings?service_id=${serviceId}`)
                .then((response) => {
                    this.serviceRating = response.data;
                })
                .catch((error) => {
                    console.log(error);
                    this.error = true;
                });
        },
    },
};
</script>

<style scoped>
.user-profile {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    height: 100vh;
}

.user-info {
    margin-top: 20px;
}

.user-info p {
    margin-bottom: 10px;
}

.user-info strong {
    font-weight: bold;
}

.error-message {
    color: red;
    margin-top: 20px;
}
</style>
