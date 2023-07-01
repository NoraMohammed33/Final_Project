<template>
    <div class="expert-profile">
        <template v-if="expert">
            <div class="card">
                <h2>{{ expert.user.name }}</h2>
                <div class="expert-info">
                    <div class="expert-image">
                        <img :src="expert.user.image" alt="User Image">
                    </div>
                    <div class="expert-details">
                        <p><strong>Email:</strong> {{ expert.user.email }}</p>
                        <p><strong>Bio:</strong> {{ expert.bio }}</p>
                        <h3>Department:</h3>
                        <p>{{ expert.department.name }}</p>
                        <h3>Services</h3>
                        <ul>
                            <li v-for="service in expert.services" :key="service.id">
                               <p> {{ service.title }} - ${{ service.price }}</p>
                                Rating:{{  }}
                            </li>
                        </ul>
                    </div>
                    <div class="contracts" v-if="contracts && contracts.length > 0">
                        <h3>Contracts:</h3>
                        <ul>
                            <li v-for="contract in contracts" :key="contract.id">
                                <p><strong>Service Title:</strong> {{ contract.service_id.title }}</p>
                                <p><strong>User Name:</strong> {{ contract.service_id.user_id }}</p>
                                <p><strong>Service Price:</strong> {{ contract.service_id.price }}$</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </template>
        <template v-else>
            <p v-if="error">Failed to fetch expert data.</p>
            <p v-else>Loading expert profile...</p>
        </template>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            expert: null,
            error: false,
            contracts: [],
        };
    },
    mounted() {
        this.fetchExpert();
        this.fetchContracts();
    },
    methods: {
        fetchExpert() {
            const expertId = this.$route.params.id;
            axios
                .get(`/api/experts/${expertId}`)
                .then((response) => {
                    this.expert = response.data.expert;
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
    },
};
</script>

<style scoped>
.expert-profile {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.card {
    width: 100%;
    max-width: 400px;
    padding: 20px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.expert-info {
    display: flex;
    flex-wrap: wrap;
    margin-top: 20px;
}

.expert-info .expert-image {
    flex: 0 0 120px;
    margin-right: 20px;
}

.expert-info .expert-image img {
    width: 100%;
    height: auto;
    border-radius: 5px;
}

.expert-info .expert-details {
    flex: 1;
}

.expert-details h3 {
    margin-top: 10px;
}

@media (max-width: 480px) {
    .expert-info .expert-image {
        flex: 0 0 100%;
        margin-right: 0;
        margin-bottom: 20px;
    }

    .expert-info .expert-details {
        flex: 1;
    }
}
</style>
