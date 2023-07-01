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
<!--            <div class="services" v-if="services && services.length > 0">-->
<!--                <h3>Services:</h3>-->
<!--                <ul>-->
<!--                    <li v-for="service in services" :key="service.id">-->
<!--                        <p><strong>Title:</strong> {{ service.title }}</p>-->
<!--                        <p><strong>Description:</strong> {{ service.description }}</p>-->
<!--                        <p><strong>Price:</strong> {{ service.price }}</p>-->
<!--                        <p><strong>Rating:</strong> {{ getServiceRating(service.id) }}</p>-->
<!--                    </li>-->
<!--                </ul>-->
<!--            </div>-->
            <div class="contracts" v-if="contracts && contracts.length > 0">
                <h3>Contracts:</h3>
                <ul>
                    <li v-for="contract in contracts" :key="contract.id">
                        <p><strong>Service Title:</strong> {{ contract.service_id.title }}</p>
                        <p><strong>Expert Name:</strong> {{ contract.service_id.expert_id }}</p>
                        <p><strong>Service Price:</strong> {{ contract.service_id.price }}$</p>
                        <p><strong>Department Name:</strong> {{ contract.user_id }}</p>
                    </li>
                </ul>
            </div>
            <div class="ratings" v-if="service_ratings && service_ratings.length > 0">
                <h3>Ratings:</h3>
                <ul>
                    <li v-for="ratings in service_ratings" :key="ratings.id">
                        <p><strong>Service Title:</strong> {{ service_ratings.service_id.title }}  {{ service_ratings.rating }}</p>
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
            contracts: [],
            services: [], // Add the "services" property
        };
    },
    mounted() {
        this.fetchUser();
        this.fetchContracts();
        this.fetchServices(); // Call the method to fetch services
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
        fetchContracts() {
            axios
                .get("/api/contracts")
                .then((response) => {
                    this.contracts = response.data.data;
                })
                .catch((error) => {
                    console.log(error);
                    this.error = true;
                });
        },
        fetchServices() {
            axios
                .get("/api/services")
                .then((response) => {
                    this.services = response.data.data;
                })
                .catch((error) => {
                    console.log(error);
                    this.error = true;
                });
        },
        getContractDetails(contractId) {
            const contract = this.contracts.find((c) => c.id === contractId);
            return contract ? contract.charge_id : "N/A";
        },
    },
};
</script>




<style scoped>
.user-profile {
    display: flex;
    justify-content: center;
    align-items: flex-start;
    flex-direction: column;
    min-height: 50vh;
    padding-top: 100px; /* Increase the padding-top value for a higher placement */
}

.card {
    max-width: 400px;
    width: 90%;
    margin: 0 auto; /* Center the card horizontally */
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
